<?php

namespace util\ui\minifier;

use util\json\JSON;

/**
 * An minifier superclass with support for sourcemaps.
 * @property string $compressedContent
 */
abstract class AbstractMinifier
{
	private $mappings = [];
	private $sourceFiles;

	const FLAG_CREATE_SOURCEMAP = 256;
	const FLAG_ALL = PHP_INT_MAX;

	/**
	 * Flags.
	 * @var int
	 */
	private $config = self::FLAG_ALL;

	protected function hasFlag( $flag )
	{
		return boolval( $this->config & $flag );
	}

	/**
	 * Source file content.
	 *
	 * @var string
	 */
	private $content;

	public function setNextSourceFile( $filename ) {
		$this->content = file_get_contents($filename);
		$this->addSourceFile( basename($filename),$filename );
		$this->compress( $this->getAllChars() );
	}

	public function getNextChar()
	{
		if   ( strlen($this->content) == 0 )
			return null;

		$firstChar = substr( $this->content,0,1);
		$this->content = substr( $this->content,1);
		return $firstChar;
	}

	public function getAllChars()
	{
		return str_split( $this->content);
	}

	public function addSourceFile( $filename,$index=null ) {
		if   ( !$index )
			$index = basename($filename);
		$this->sourceFiles[ $index ] = $filename;
	}


	public function getSourcemapLink()
	{

	}

	/**
	 * Creates the JSON sourcemap.
	 *
	 * @return void
	 */
	public function generateSourcemap()
	{
		$sourcemap = [
			"version"    => 3,
			"file"       => $this->outFile,
			"sourceRoot" => "",
			"sources"    => $this->sourceFiles,
			"names"      => [],
			"mappings"   => $this->generateMappings()
		];
		return JSON::encode( $sourcemap );
	}


	public function addMapping($destLine, $destColumn, $srcIndex, $srcLine, $srcColumn)
	{
		$this->mappings[] = array(
			'dest_line' => $destLine, // Line in the compiled file
			'dest_col' => $destColumn, // Column in the compiled file
			'src_index' => $srcIndex, // Index of the source file
			'src_line' => $srcLine, // Line in the source file
			'src_col' => $srcColumn, // Column in the source file
		);
	}



	public function __construct( $flags = null )
	{
		if   ( $flags )
			$this->config = $flags;
	}




	/**
	 * Create the mappings.
	 *
	 * @return string
	 */
	public function generateMappings() {

		// Group mappings by dest line number.
		$grouped_map = array();
		foreach ($this->mappings as $m) {
			$grouped_map[$m['dest_line']][] = $m;
		}

		ksort($grouped_map);

		$grouped_map_enc = array();

		$last_dest_line = 0;
		$last_src_index = 0;
		$last_src_line = 0;
		$last_src_col = 0;
		foreach ($grouped_map as $dest_line => $line_map) {
			while (++$last_dest_line < $dest_line) {
				$grouped_map_enc[] = ";";
			}

			$line_map_enc = array();
			$last_dest_col = 0;

			foreach ($line_map as $m) {
				$m_enc = Base64VLQ::encode($m['dest_col'] - $last_dest_col);
				$last_dest_col = $m['dest_col'];
				if (isset($m['src_index'])) {
					$m_enc .= Base64VLQ::encode($m['src_index'] - $last_src_index);
					$last_src_index = $m['src_index'];

					$m_enc .= Base64VLQ::encode($m['src_line'] - $last_src_line);
					$last_src_line = $m['src_line'];

					$m_enc .= Base64VLQ::encode($m['src_col'] - $last_src_col);
					$last_src_col = $m['src_col'];
				}
				$line_map_enc[] = $m_enc;
			}

			$grouped_map_enc[] = implode(",", $line_map_enc) . ";";
		}

		$grouped_map_enc = implode($grouped_map_enc);

		return $grouped_map_enc;
	}


	public function addCompressedContent( $add )
	{
		$this->compressedContent .= $add;
	}


	public function getCompressedContent()
	{
		$this->compress( str_split(file_get_contents( array_shift($this->sourceFiles))));
		return $this->compressedContent . ($this->hasFlag(self::FLAG_CREATE_SOURCEMAP) ? $this->linkToSourcemap( "" ) : '');
	}


	abstract public function linkToSourcemap( $sourcemap );

	abstract protected function compress( $chars );
}