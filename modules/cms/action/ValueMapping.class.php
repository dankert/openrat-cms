<?php

namespace cms\action;

use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Project;
use DateTime;
use logger\Logger;
use util\exception\ValidationException;

/**
 * UI-Mapping for Values.
 */
trait ValueMapping
{
	protected function outputValue( $element, $value )
	{
		$output  = [];
		$content = '';

		switch( $element->typeid) {

			case Element::ELEMENT_TYPE_DATETIME:
				$output['items'] = $element->getSelectItems();
				$output['date']=date('Y-m-d\TH:i'  ,$value->date );
				break;
			case Element::ELEMENT_TYPE_DATE:
				$output['items'] = $element->getSelectItems();
				$output['date']=date('Y-m-d',$value->date );
				break;
			case Element::ELEMENT_TYPE_TIME:
				$output['items'] = $element->getSelectItems();
				$output['date']=date('H:i'  ,$value->date );
				break;
			case Element::ELEMENT_TYPE_WEEK:
				$output['items'] = $element->getSelectItems();
				$output['date']=date('Y-\WW',$value->date );
				break;
			case Element::ELEMENT_TYPE_MONTH:
				$output['items'] = $element->getSelectItems();
				$output['date']=date('Y-m'  ,$value->date );
				break;

			case Element::ELEMENT_TYPE_LINK:
				$project = new Project($this->page->projectid);
				$output['rootfolderid'] = $project->getRootObjectId();

				// Ermitteln, welche Objekttypen verlinkt werden d�rfen.
				$type = $element->subtype;

				if (substr($type, 0, 5) == 'image')
					$type = 'file';

				if (!in_array($type, array('file', 'page', 'link', 'folder')))
					$types = array('file', 'page', 'link'); // Fallback: Der Link kann auf Seiten,Dateien und Verknüpfungen zeigen
				else
					$types = array($type); // gewünschten Typ verwenden

				$oid = $value->linkToObjectId;
				$name = '';

				if ($oid) {
					$o = new BaseObject($oid);
					$o->load();
					$name = $o->filename;
				}

				$output['objects'] = array();
				$output['linkobjectid']= $oid;
				$content = $oid;
				$output['linkname']= $name;

				$output['types'] = implode(',', $types);

				break;

			case Element::ELEMENT_TYPE_SELECT:
			case Element::ELEMENT_TYPE_SELECTS:
				$output['items'] = $element->getSelectItems();
				$content = $value->text;
				break;

			case Element::ELEMENT_TYPE_INSERT:
				// Auswahl ueber alle Elementtypen
				$objects = array();
				//Änderung der möglichen Types
				$types = array('file', 'page', 'link');
				$objects[0] = \cms\base\Language::lang('LIST_ENTRY_EMPTY'); // Wert "nicht ausgewählt"

				$project = new Project($this->page->projectid);
				$folder = new Folder($project->getRootObjectId());
				$folder->load();

				//Auch Dateien dazu
				foreach ($project->getAllObjectIds($types) as $id) {
					$f = new Folder($id);
					$f->load();

					$objects[$id] = \cms\base\Language::lang($f->getType()) . ': ';
					$objects[$id] .= implode(' &raquo; ', $f->parentObjectNames(false, true));
				}

				foreach ($project->getAllFolders() as $id) {
					$f = new Folder($id);
					$f->load();

					$objects[$id] = \cms\base\Language::lang($f->getType()) . ': ';
					$objects[$id] .= implode(' &raquo; ', $f->parentObjectNames(false, true));
				}

				asort($objects); // Sortieren

				$output['objects'] = $objects;
				$content = $value->linkToObjectId;

				break;

			case Element::ELEMENT_TYPE_NUMBER:
				$output['items'] = $element->getSelectItems();
				$content = $value->number / pow(10, $element->decimals);
				break;

			case Element::ELEMENT_TYPE_RANGE:
				$content = $value->number / pow(10, $element->decimals);
				break;

			case Element::ELEMENT_TYPE_CHECKBOX:
				$content = $value->number;
				break;

			case Element::ELEMENT_TYPE_LONGTEXT:
				if ($requestFormat = $this->request->getText('format'))
					// Individual format from request.
					$format = $requestFormat;
				elseif ($value->format != null)
					$format = $value->format;
				else
					// There is no saved value. Get the format from the template element.
					$format = $element->format;

				$output['format'] = $format;
				$output['editor'] = Element::getAvailableFormats()[$format];

				$content = $this->linkifyOIDs($value->text);
				break;

			case Element::ELEMENT_TYPE_TEXT:
			case Element::ELEMENT_TYPE_DATA:
			case Element::ELEMENT_TYPE_URL:
			case Element::ELEMENT_TYPE_TEL:
			case Element::ELEMENT_TYPE_EMAIL:
			case Element::ELEMENT_TYPE_PASSWORD:

				$output['items'] = $element->getSelectItems();
				$content = $value->text;
				break;

			case Element::ELEMENT_TYPE_COLOR:

				Logger::debug( 'Farbe aus DB: '.dechex($value->number));
				$content = $this->colorNum2hex( $value->number );
				break;

			case Element::ELEMENT_TYPE_COORD:
				$lat  = $value->number >> 32;
				$long = $value->number << 32 >> 32;

				$content = abs($lat).'°'.($lat<0?'S':'N').' '.abs($long).'°'.($long<0?'W':'E');
				break;

			default:
				throw new \InvalidArgumentException("Unsupported element type: ".$element->typeid);

		}
		$output['value'] = $content;

		return $output;
	}


	protected function parseToValue( $element, $value, $input)
	{
		switch ($element->typeid) {

			case Element::ELEMENT_TYPE_TEXT:
			case Element::ELEMENT_TYPE_EMAIL:
			case Element::ELEMENT_TYPE_URL:
			case Element::ELEMENT_TYPE_TEL:
			case Element::ELEMENT_TYPE_DATA:
			case Element::ELEMENT_TYPE_PASSWORD:

				$value->text = $input;
				break;

			case Element::ELEMENT_TYPE_COLOR:
				$value->number = $this->colorHex2Num( $input );
				break;

			case Element::ELEMENT_TYPE_COORD:

				$inputLatLongList = explode(' ',$input);

				if   ( sizeof($inputLatLongList) != 2 )
					throw new \InvalidArgumentException();

				$inputLatLongList = array_map( function ($value) {
					if   (in_array(substr($value,-1,1),['W','S']))
						return abs(intval($value))*-1;
					elseif   (in_array(substr($value,-1,1),['E','N']))
						return abs(intval($value));
					else
						return intval($value);
				},$inputLatLongList);

				list($lat,$long) = $inputLatLongList;

				$value->number = $lat << 32 | $long;
				break;

			case Element::ELEMENT_TYPE_LONGTEXT:
				$value->text   = $this->compactOIDs($input);
				break;

			case Element::ELEMENT_TYPE_DATETIME:
				// 'datetime-local': YYY-MM-DDTHH:mm
				$dateTime = DateTime::createFromFormat("!Y-m-d\TG:i", $input);
				if   ( $dateTime !== false )
					$value->date = $dateTime->getTimestamp();
				else
					$value->date = null;
				break;

			case Element::ELEMENT_TYPE_DATE:
				// 'date': YYYY-MM-DD
				$dateTime = DateTime::createFromFormat("!Y-m-d", $input);
				if   ( $dateTime !== false )
					$value->date = $dateTime->getTimestamp();
				else
					$value->date = null;
				break;

			case Element::ELEMENT_TYPE_TIME:
				$dateTime = DateTime::createFromFormat("!H:i", $input);
				if   ( $dateTime !== false )
					$value->date = $dateTime->getTimestamp();
				else
					$value->date = null;
				break;

			case Element::ELEMENT_TYPE_WEEK:
				// week format: YYYY-'W'W
				// unable to parse the week number from a date string :(
				$weekDate = $input;
				if   ( strlen($weekDate)==8) {
					$dateTime = (new DateTime)->setTimestamp(0)->setISODate(
						intval(substr($weekDate, 0, 4)),
						intval(substr($weekDate, 6, 2))
					);
					$value->date = $dateTime->getTimestamp();
				}
				else
					$value->date = null;
				break;

			case Element::ELEMENT_TYPE_MONTH:
				$dateTime = DateTime::createFromFormat("!Y-m", $input);
				if   ( $dateTime !== false )
					$value->date = $dateTime->getTimestamp();
				else
					$value->date = null;
				break;

			case Element::ELEMENT_TYPE_SELECT:
			case Element::ELEMENT_TYPE_SELECTS:
				$value->text = $input;
				break;
			case Element::ELEMENT_TYPE_CHECKBOX:
				$value->number = $input?1:0;
				break;
			case Element::ELEMENT_TYPE_LINK:
			case Element::ELEMENT_TYPE_INSERT:
				$value->linkToObjectId = intval($input);
				break;

			case Element::ELEMENT_TYPE_NUMBER:
			case Element::ELEMENT_TYPE_RANGE:
				$value->number = $input * pow(10, $element->decimals);
				break;
			default:
				throw new \LogicException('Unknown element type: ' . $element->getTypeName());
		}

	}

	/**
	 * hex2rgb
	 *
	 * @param  mixed $hex
	 *
	 * @return int
	 */
	protected function colorHex2Num($hex)
	{
		$hex = str_replace('#', '', $hex);

		if   ( strlen($hex) != 3 && strlen($hex) != 6 )
			throw new \InvalidArgumentException("Hex color '".$hex."' is not valid.");

		$hexColors = str_split($hex, strlen($hex)/3);

		// normalize: The short hex notation: "F" becomes "FF".
		$hexColors = array_map( function($hexColor) {
			return (strlen($hexColor)==1)?$hexColor.$hexColor:$hexColor;
		},$hexColors);

		$numColors = array_map( function($hexColor) {
			return hexdec($hexColor);
		},$hexColors);

		Logger::debug( 'Farbe-num aus Request: '.print_r($numColors,true));
		return array_reduce($numColors,function($num, $numColor) {
			$num = $num << 8;
			$num += $numColor;
			return $num;
		},0);
	}

	/**
	 * rgb2hex
	 *
	 * @param  mixed $rgb
	 *
	 * @return string
	 */
	protected function colorNum2hex($colorAsNum)
	{
		$decArr = [
			$colorAsNum >> 16 & 0xff,
			$colorAsNum >>  8 & 0xff,
			$colorAsNum       & 0xff
		];

		return "#" .
			array_reduce( $decArr, function ($carry,$item) {
				return $carry.=str_pad(dechex($item), 2, "0", STR_PAD_LEFT);
			}, '');
	}


}
