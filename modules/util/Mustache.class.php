<?php


namespace util;


/**
 * Class Mustache.
 *
 * This is a simple Mustache template implementation,
 * See https://mustache.github.io/ for the specification.
 *
 * This implementation has the following advantages:
 * - no temporary files
 * - no require calls or includes
 * - no eval calls
 * - no weird ob_start calls
 *
 * But this implementation is probably slower than "Bog the cow's" implementation:
 * https://github.com/bobthecow/mustache.php
 *
 * But for some situations (i.e. for statifying CMS) this is not a problem ;)
 *
 * Features:
 * - Simple values
 * - Comments
 * - Blocks (normal and negating blocks)
 * - Lists with arrays and objects
 * - Wrapper functions
 * - Partials (you need to define a partial loader)
 * - Delimiter change
 * - no dot notation on property names
 *
 * Have a look for an example at the end of this file.
 *
 * Author: Jan Dankert
 * License: GPL v3.
 *
 * @package cms\mustache
 */
class Mustache
{
    /**
     * Open Tag.
     * @var string
     */
    public $openTag = '{{';

    /**
     * Closing tag.
     * @var string
     */
    public $closeTag = '}}';

    /**
     * Escape function, feel free to set it to a function of your own.
     * @var \Closure
     */
    public $escape;

    /**
     * Partial loader. If you want to use partials, you have to define a partial loader in this member.
     * @var \Closure
     */
    public $partialLoader;

    /**
     * Root block.
     * @var MustacheBlock
     */
    private $root;


    /**
     * Creates a new Mustache parser with a given source.
     *
     * @param $source
     */
    public function __construct( $source=null ) {

        $escape = static function( $text) {

         	if   ( is_scalar($text))
            	return htmlentities( $text);
         	else
         	 	return false;
        };
        $this->escape = $escape;

        if  ( $source )
            $this->parse($source);
    }


    /**
     * Render the template.
     *
     * @param $data data
     * @return string
     */
    public function render( $data ) {

        return $this->root->render( $data );
    }

    /**
     * Parsing the source.
     *
     * @param $source
     */
    public function parse($source)
    {
        $tagList = array();
        $pos = 0;

	 	$nextOpenTag = $this->openTag;
	 	$nextClosTag = $this->closeTag;

        while (true) {

         	$openTag = $nextOpenTag;
         	$closTag = $nextClosTag;

            // searching for:  {{#name}}
            //                 +----->+
            $begin = strpos($source, $openTag, $pos);
            if   ( $begin === FALSE )
                break;

            $end = strpos($source, $closTag, $begin + strlen($openTag));
            if   ( $end === FALSE )
                break;

            // Example     {{#name}}
            // Looking for   +---+
            $tagText = substr($source, $begin + strlen($openTag), $end - $begin - strlen($openTag));

            $line = substr_count($source, "\n", 0, $begin) + 1;
            $column = $begin - strrpos(substr($source, 0, $begin), "\n") + ($line==1?1:0);

            $tag = new MustacheTag($tagText, $begin, $end+strlen($closTag) , $line, $column);

            if ( $tag->type == MustacheTag::DELIM_CHANGE ) {
            	$parts = explode(' ',$tag->propertyName);
			 	if   ( sizeof($parts ) >= 2 ) {
			  		$nextOpenTag =        $parts[0];
			  		$nextClosTag = substr($parts[1],0,-1);
			 	}
			 	$source        = substr_replace($source,'',$begin,$end-$begin+strlen($closTag));
			 	// Delimiter-Tag is not added to the taglist, we don't need it.
				$pos = $begin;
			}
            elseif ( $tag->type == MustacheTag::PARTIAL ) {
                if   ( !is_callable($this->partialLoader) )
                    throw new \RuntimeException('No loader is defined, unable to inject a partial at '.$tag->__toString() );

                $loader        = $this->partialLoader;
                $partialSource = $loader( $tag->propertyName );
                $source        = substr_replace($source,$partialSource,$begin,$end-$begin+strlen($closTag));
                // Partial-Tag is not added to the taglist, we don't need it.
			 	$pos = $begin;
            }
            else {
                // All other tags are added to our list.
                $tagList[] = $tag;
				$pos = $end + strlen($closTag);
            }


            //$source = substr($source,0,$begin-1).substr($source,$end+1);
        }

        //echo '<pre>'; echo var_dump($this); echo '</pre';

        $this->parseStripTags( $source, $tagList );
    }


    /**
     * @param $source
     * @param $tagList
     */
    private function parseStripTags($source, $tagList)
    {
        $newTagList = array();
        $removedBytes = 0;

        /** @var MustacheTag $tag */
        foreach($tagList as $tag ) {

            $tagLength = $tag ->end - $tag->position;

            $tag->position -= $removedBytes;
            $tag->end = $tag->position;

            $source = substr_replace($source,'',$tag->position,$tagLength);
            $newTagList[] = $tag;

            $removedBytes += $tagLength;
        }

        $this->root = $this->parseBlock($newTagList,$source);
    }

    /**
     * @param $tagList
     * @param $source
     * @return MustacheBlock
     */
    public function parseBlock($tagList, $source ) {

        $block = new MustacheBlock(null);
        $indent = 0;
        $subtagList = array();
        $removedChars = 0;
        $openTag = null;

        /** @var MustacheTag $tag */
        foreach($tagList as $tag ) {

            if   ( $tag->kind == MustacheTag::OPEN ) {
                if   ( $indent == 0 )
                    $openTag = $tag;
                $indent++;
            }
            elseif   ( $tag->kind == MustacheTag::CLOSE ) {
                $indent--;
                if   ( $indent < 0) {
                    throw new \RuntimeException('Superfluous closing tag: '.$tag->__toString() );
                }
                if   ( $indent == 0 ) {
                    if   ( !empty($tag->propertyName) && $tag->propertyName != $openTag->propertyName )
                        throw new \RuntimeException('Start tag: '.$openTag->__toString().' does not match the closing tag: '.$tag->__toString() );

                    $subSourceLength = $tag->position-$openTag->position;
                    $subsource = substr($source,$openTag->position-$removedChars,$subSourceLength);

                    $source = substr_replace($source,'',$openTag->position-$removedChars,$subSourceLength);
                    $openTag->position -= $removedChars;
                    $removedChars += $subSourceLength;

                    // Append new subblock.
                    $subBlock = $this->parseBlock($subtagList,$subsource);
                    $subtagList = array(); // resetting...
                    $subBlock->tag = $openTag;

                    $block->nodes[] = $subBlock;
                }
            } else {
                if   ( $indent == 0) {
                    // This tag belongs to this block.
                    $tag->position -= $removedChars;

                    switch( $tag->type ) {
                        case MustacheTag::COMMENT;
                            $node = new MustacheComment($tag);
                            break;
                        case MustacheTag::UNESCAPED;
                            $node = new MustacheValue($tag);
                            $node->escape = null;
                            break;
                        case MustacheTag::VARIABLE;
                            $node = new MustacheValue($tag);
                            $node->escape = $this->escape;
                            break;
                        default:
                            throw new \RuntimeException('Unsupported tag: '.$tag->__toString() );
                    }
                    $block->nodes[] = $node;

                } else {
                    // This is a tag of a subblock
                    $tag->position -= $openTag->position;
                    $subtagList[] = $tag;
                }
            }
        }

        if   ( $indent > 0) {
            throw new \RuntimeException('Missing closing tag for: '.$openTag->__toString() );
        }

        $block->source = $source;
        return $block;
    }

}

class MustacheTag
{
    public $type;
    public $kind;
    public $propertyName;

    public $position;
    public $end;

    private $sourceLine;
    private $sourceColumn;

    const SIMPLE = 0;
    const OPEN = 1;
    const CLOSE = 2;

    const CLOSING = '/';
    const NEGATION = '^';
    const SECTION = '#';
    const COMMENT = '!';
    const PARTIAL = '>';
    const PARENT = '<';
    const DELIM_CHANGE = '=';
    const UNESCAPED_2 = '{';
    const UNESCAPED = '&';
    const PRAGMA = '%';
    const BLOCK_VAR = '$';

    const VARIABLE = '';

    private $VALID_TYPES = array(
        self::CLOSING, self::NEGATION, self::SECTION, self::COMMENT, self::PARTIAL, self::PARENT, self::DELIM_CHANGE, self::UNESCAPED_2, self::UNESCAPED, self::PRAGMA, self::BLOCK_VAR
    );

    public function __construct($tagText, $position, $end, $line, $column)
    {
        $this->sourceLine = $line;
        $this->sourceColumn = $column;
        $this->position = $position;
        $this->end = $end;

        $this->parseTag($tagText);
    }

    /**
     * Textual representation of a Mustache tag, suitable for error reporting.
     * @return string
     */
    public function __toString()
    {
        return 'tag "'.$this->type . $this->propertyName.'" (@ pos ' . $this->sourceLine . ':' . $this->sourceColumn . ') ';
    }

    private function parseTag($tagText)
    {
        $t = substr($tagText, 0, 1);
        if (in_array($t, $this->VALID_TYPES)) {
            $this->type = $t;
            $property = substr($tagText, 1);
            $this->propertyName = trim($property);
            if   ( $t == self::SECTION || $t == self::NEGATION )
                $this->kind = self::OPEN;
            elseif   ( $t == self::CLOSING )
                $this->kind = self::CLOSE;
            else
                $this->kind = self::SIMPLE;
        } else {
            $this->type = self::VARIABLE;
            $this->propertyName = trim($tagText);
            $this->kind = self::SIMPLE;
        }

    }
}

class MustacheNode {

    public $type;

    /**
     * @var MustacheTag
     */
    public $tag;

    public function __construct( $tag )
    {
        $this->tag = $tag;
    }

    public function render( $data ) {
        return '';
    }

    public function getValue( $data ) {

        if  ( !is_object($this->tag))
            return false; // on root-block, there is no tag.

        $value = $data;

		// Evaluate "dot notation"
		foreach( explode('.',$this->tag->propertyName ) as $key )
	  	{
	   		if   ( is_array($value) && isset($value[$key]) ) {
			 	$value = $value[$key];
			 	continue;
			}
			$value = false; // Key does not exist, so there is no value.
		}


	 	if   ( is_object($value))
        {
            if   ($value instanceof \Closure)
                ; // anonymous functions
            else
                $value = get_object_vars($value);
        }

        return $value;
    }
}


class MustacheBlock extends MustacheNode {

    /**
     * @var String
     */
    public $source;

    /**
     * @var MustacheNode
     */
    public $nodes = array();

    /**
     * Should this block be rendered?
     *
     * @param $data data
     * @return bool
     */
    public function isRendered( $data ) {

        if  ( !is_object($this->tag))
            return true; // on root-block, there is no tag.

        $propIsTrue = (boolean) $this->getValue( $data );

        if  ( $this->tag->type == MustacheTag::NEGATION )
            $propIsTrue = ! $propIsTrue;

        return $propIsTrue;
    }

    public function render($data)
    {
        if ( $this->isRendered($data ) ) {

            $values = $this->getValue($data);
            if   ( !is_array($values) || !isset($values[0]) )
                $values = array( $values);

            $sumOutput = '';
            foreach( $values as $value) {

                $data = array_merge($data,(array) $value );
                $output = $this->source;
                $insertedBytes = 0;


                /** @var MustacheNode $node */
                foreach($this->nodes as $node) {

                    if   ( $node instanceof MustacheBlock )
                        $o = $node->render( $data);
                    else
                    {
                        $o = $node->render($data);
                        if   ( is_callable($value) )
                            $o = $value( $o );
                    }

                    $value = $this->getValue($data);
                    if   ( is_callable($value) )
                        $o = $value($o);

                    $output = substr_replace($output, $o, $node->tag->position+$insertedBytes, 0);
                    $insertedBytes += strlen($o);
                }
                $sumOutput .= $output;
            }

            return $sumOutput;
        }
        else {
            return '';
        }

    }
}

class MustacheValue extends MustacheNode {

    /**
     * escaping function.
     */
    public $escape;

    public function render($data)
    {
        $value = $this->getValue($data);

        if   ( is_callable( $this->escape)) {

            $escape = $this->escape;
            $value = $escape($value);
        }

        return $value;
    }
}

class MustacheComment extends MustacheNode {

    public function render($data)
    {
        return '';
    }
}


/*
 * Example.
 *
 * Uncomment the following for a working example.
 */

/*
error_reporting(E_ALL);
ini_set('display_errors', 1);

$source = <<<SRC
Hello {{planet}}, {{& planet }}.{{! Simple example with a simple property }}

{{#test}}
Yes, this is a {{test}}. {{! yes, it is}}
{{/test}}
{{^test}}
No, this is not a {{test}}. {{ ! will not be displayed, because test is not false }}
{{/test}}

{{#car}}
My Car is {{color}}. {{! this is a property of the array car }}
It drives on {{& planet }}.{{! this property is inherited from the upper context }}
{{/}}

{{#house}}
My House is {{size}}. {{! this property is read from an object }}
{{/}} {{! short closing tags are allowed }}

Some names:
{{#names}}
my name is {{ name }}.{{! yes, spaces are allowed}}
{{/names}}

{{#empty}}
this is not displayed {{! because the list is empty }}
{{/empty}}

{{#upper}}
Hello again, {{planet}}. {{!displayed in uppercase}}
{{/}}

<h1>Partials</h1>
{{> mycoolpartial}}

<h1>Changing Delimiters</h1>
Default: {{name}}
{{=$( )=}}
Bash-Style: $(name)
Default should not work here: {{name}}

$(={{ }}=)
Default again: {{name}}

<h1>Dot notation</h1>
this will not work: {{building}}
but this is the color of the roof: {{building.roof.color}}


SRC;

$m = new Mustache();
$m->partialLoader = function($name) {
 return "\nThis is a partial named ".$name.". It may include variables, like the name '{{name}}'.\n\n";
};
$m->parse( $source );

echo 'Object: <pre><code>'; print_r($m); echo '</code></pre>';

$data = array(
    'planet'  => '<b>world</b>',
    'test'  => 'Test',
    'name'  => 'Mallory',
    'car'   => array('color'=>'red'),
    'house' => (object) array('size'=>'big' ),
    'names' => array(
        array('name'=>'Alice'),
        array('name'=>'Bob')
    ),
    'empty' => array(),
    'upper' => static function($text) { return strtoupper($text); },
    'building' => array('roof'=>array('color'=>'gray'))

);

echo '<pre>'.$m->render( $data ).'</pre>';
*/