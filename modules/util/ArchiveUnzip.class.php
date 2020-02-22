<?php
// 28/11/2005 (2.4)
// - dUnzip2 is now compliant with wrong placed "Data Description", made by some compressors,
//   like the classes ZipLib and ZipLib2 by 'Hasin Hayder'. Thanks to Ricardo Parreno for pointing it.
// 09/11/2005 (2.3)
// - Added optional parameter '$stopOnFile' on method 'getList()'.
//   If given, file listing will stop when find given filename. (Useful to open and unzip an exact file)
// 06/11/2005 (2.21)
// - Added support to PK00 file format (Packed to Removable Disk) (thanks to Lito [PHPfileNavigator])
// - Method 'getExtraInfo': If requested file doesn't exist, return FALSE instead of Array()
// 31/10/2005 (2.2)
// - Removed redundant 'file_name' on centralDirs declaration (thanks to Lito [PHPfileNavigator])
// - Fixed redeclaration of file_put_contents when in PHP4 (not returning true)

##############################################################
# Class dUnzip2 v2.4
#
#  Author: Alexandre Tedeschi (d)
#  E-Mail: alexandrebr at gmail dot com
#  Londrina - PR / Brazil
#
#  Objective:
#    This class allows programmer to easily unzip files on the fly.
#
#  Requirements:
#    This class requires extension ZLib Enabled. It is default
#    for most site hosts around the world, and for the PHP Win32 dist.
#
#  To do:
#   * Error handling
#   * Write a PHP-Side gzinflate, to completely avoid any external extensions
#   * Write other decompress algorithms
#
#  If you modify this class, or have any ideas to improve it, please contact me!
#  You are allowed to redistribute this class, if you keep my name and contact e-mail on it.
##############################################################

namespace util;
class ArchiveUnzip
{

	// Public
	var $files = array();
	var $value = '';
	var $fileName;
	var $compressedList; // You will problably use only this one!
	var $centralDirList; // Central dir list... It's a kind of 'extra attributes' for a set of files
	var $endOfCentral;   // End of central dir, contains ZIP Comments
	var $debug;

	// Private
	var $fh;
	var $zipSignature = "\x50\x4b\x03\x04"; // local file header signature
	var $dirSignature = "\x50\x4b\x01\x02"; // central dir header signature
	var $dirSignatureE = "\x50\x4b\x05\x06"; // end of central dir signature

	// Public
	Function __construct()
	{
		$this->compressedList =
		$this->centralDirList =
		$this->endOfCentral = Array();
	}

	function open($value)
	{
		$this->fileName = tempnam('/tmp', 'unzip');
//		echo $this->fileName;
		$fo = fopen($this->fileName, 'w');
		fwrite($fo, $value);
		$this->unzipAll();
	}


	Function getList($stopOnFile = false)
	{
		if (sizeof($this->compressedList)) {
			$this->debugMsg(1, "Returning already loaded file list.");
			return $this->compressedList;
		}

		// Open file, and set file handler
		$fh = fopen($this->fileName, "r");
		$this->fh = &$fh;
		if (!$fh) {
			$this->debugMsg(2, "Failed to load file.");
			return false;
		}

		// Loop the file, looking for files and folders
		$ddTry = false;
		fseek($fh, 0);
		for (; ;) {
			// Check if the signature is valid...
			$signature = fread($fh, 4);
			if (feof($fh)) {
#				$this->debugMsg(1, "Reached end of file");
				break;
			}

			// If signature is a 'Packed to Removable Disk', just ignore it and move to the next.
			if ($signature == 'PK00') {
				$this->debugMsg(1, "Found PK00: Packed to Removable Disk");
				continue;
			}

			// If signature of a 'Local File Header'
			if ($signature == $this->zipSignature) {
				# $this->debugMsg(1, "Zip Signature!");

				// Get information about the zipped file
				$file['version_needed'] = unpack("v", fread($fh, 2)); // version needed to extract
				$file['general_bit_flag'] = unpack("v", fread($fh, 2)); // general purpose bit flag
				$file['compression_method'] = unpack("v", fread($fh, 2)); // compression method
				$file['lastmod_time'] = unpack("v", fread($fh, 2)); // last mod file time
				$file['lastmod_date'] = unpack("v", fread($fh, 2));  // last mod file date
				$file['crc-32'] = fread($fh, 4);              // crc-32
				$file['compressed_size'] = unpack("V", fread($fh, 4)); // compressed size
				$file['uncompressed_size'] = unpack("V", fread($fh, 4)); // uncompressed size
				$fileNameLength = unpack("v", fread($fh, 2)); // filename length
				$extraFieldLength = unpack("v", fread($fh, 2)); // extra field length
				$file['file_name'] = fread($fh, $fileNameLength[1]); // filename
				$file['extra_field'] = $extraFieldLength[1] ? fread($fh, $extraFieldLength[1]) : ''; // extra field
				$file['contents-startOffset'] = ftell($fh);

				// Bypass the whole compressed contents, and look for the next file
				fseek($fh, $file['compressed_size'][1], SEEK_CUR);

				// Convert the date and time, from MS-DOS format to UNIX Timestamp
				$BINlastmod_date = str_pad(decbin($file['lastmod_date'][1]), 16, '0', STR_PAD_LEFT);
				$BINlastmod_time = str_pad(decbin($file['lastmod_time'][1]), 16, '0', STR_PAD_LEFT);
				$lastmod_dateY = bindec(substr($BINlastmod_date, 0, 7)) + 1980;
				$lastmod_dateM = bindec(substr($BINlastmod_date, 7, 4));
				$lastmod_dateD = bindec(substr($BINlastmod_date, 11, 5));
				$lastmod_timeH = bindec(substr($BINlastmod_time, 0, 5));
				$lastmod_timeM = bindec(substr($BINlastmod_time, 5, 6));
				$lastmod_timeS = bindec(substr($BINlastmod_time, 11, 5));

				// Mount file table
				$this->compressedList[$file['file_name']] = Array(
					'file_name' => $file['file_name'],
					'compression_method' => $file['compression_method'][1],
					'version_needed' => $file['version_needed'][1],
					'lastmod_datetime' => mktime($lastmod_timeH, $lastmod_timeM, $lastmod_timeS, $lastmod_dateM, $lastmod_dateD, $lastmod_dateY),
					'crc-32' => str_pad(dechex(ord($file['crc-32'][3])), 2, '0', STR_PAD_LEFT) .
						str_pad(dechex(ord($file['crc-32'][2])), 2, '0', STR_PAD_LEFT) .
						str_pad(dechex(ord($file['crc-32'][1])), 2, '0', STR_PAD_LEFT) .
						str_pad(dechex(ord($file['crc-32'][0])), 2, '0', STR_PAD_LEFT),
					'compressed_size' => $file['compressed_size'][1],
					'uncompressed_size' => $file['uncompressed_size'][1],
					'extra_field' => $file['extra_field'],
					'general_bit_flag' => str_pad(decbin($file['general_bit_flag'][1]), 8, '0', STR_PAD_LEFT),
					'contents-startOffset' => $file['contents-startOffset']
				);

				if ($stopOnFile) if ($file['file_name'] == $stopOnFile) {
					$this->debugMsg(1, "Stopping on file...");
					break;
				}
			} // If signature of a 'Central Directory Structure'
			elseif ($signature == $this->dirSignature) {
				# $this->debugMsg(1, "Dir Signature!");

				$dir['version_madeby'] = unpack("v", fread($fh, 2)); // version made by
				$dir['version_needed'] = unpack("v", fread($fh, 2)); // version needed to extract
				$dir['general_bit_flag'] = unpack("v", fread($fh, 2)); // general purpose bit flag
				$dir['compression_method'] = unpack("v", fread($fh, 2)); // compression method
				$dir['lastmod_time'] = unpack("v", fread($fh, 2)); // last mod file time
				$dir['lastmod_date'] = unpack("v", fread($fh, 2)); // last mod file date
				$dir['crc-32'] = fread($fh, 4);              // crc-32
				$dir['compressed_size'] = unpack("V", fread($fh, 4)); // compressed size
				$dir['uncompressed_size'] = unpack("V", fread($fh, 4)); // uncompressed size
				$fileNameLength = unpack("v", fread($fh, 2)); // filename length
				$extraFieldLength = unpack("v", fread($fh, 2)); // extra field length
				$fileCommentLength = unpack("v", fread($fh, 2)); // file comment length
				$dir['disk_number_start'] = unpack("v", fread($fh, 2)); // disk number start
				$dir['internal_attributes'] = unpack("v", fread($fh, 2)); // internal file attributes-byte1
				$dir['external_attributes1'] = unpack("v", fread($fh, 2)); // external file attributes-byte2
				$dir['external_attributes2'] = unpack("v", fread($fh, 2)); // external file attributes
				$dir['relative_offset'] = unpack("V", fread($fh, 4)); // relative offset of local header
				$dir['file_name'] = fread($fh, $fileNameLength[1]);                             // filename
				$dir['extra_field'] = $extraFieldLength[1] ? fread($fh, $extraFieldLength[1]) : '';   // extra field
				$dir['file_comment'] = $fileCommentLength[1] ? fread($fh, $fileCommentLength[1]) : ''; // file comment

				// Convert the date and time, from MS-DOS format to UNIX Timestamp
				$BINlastmod_date = str_pad(decbin($file['lastmod_date'][1]), 16, '0', STR_PAD_LEFT);
				$BINlastmod_time = str_pad(decbin($file['lastmod_time'][1]), 16, '0', STR_PAD_LEFT);
				$lastmod_dateY = bindec(substr($BINlastmod_date, 0, 7)) + 1980;
				$lastmod_dateM = bindec(substr($BINlastmod_date, 7, 4));
				$lastmod_dateD = bindec(substr($BINlastmod_date, 11, 5));
				$lastmod_timeH = bindec(substr($BINlastmod_time, 0, 5));
				$lastmod_timeM = bindec(substr($BINlastmod_time, 5, 6));
				$lastmod_timeS = bindec(substr($BINlastmod_time, 11, 5));

				$this->centralDirList[$dir['file_name']] = Array(
					'version_madeby' => $dir['version_madeby'][1],
					'version_needed' => $dir['version_needed'][1],
					'general_bit_flag' => str_pad(decbin($file['general_bit_flag'][1]), 8, '0', STR_PAD_LEFT),
					'compression_method' => $dir['compression_method'][1],
					'lastmod_datetime' => mktime($lastmod_timeH, $lastmod_timeM, $lastmod_timeS, $lastmod_dateM, $lastmod_dateD, $lastmod_dateY),
					'crc-32' => str_pad(dechex(ord($file['crc-32'][3])), 2, '0', STR_PAD_LEFT) .
						str_pad(dechex(ord($file['crc-32'][2])), 2, '0', STR_PAD_LEFT) .
						str_pad(dechex(ord($file['crc-32'][1])), 2, '0', STR_PAD_LEFT) .
						str_pad(dechex(ord($file['crc-32'][0])), 2, '0', STR_PAD_LEFT),
					'compressed_size' => $dir['compressed_size'][1],
					'uncompressed_size' => $dir['uncompressed_size'][1],
					'disk_number_start' => $dir['disk_number_start'][1],
					'internal_attributes' => $dir['internal_attributes'][1],
					'external_attributes1' => $dir['external_attributes1'][1],
					'external_attributes2' => $dir['external_attributes2'][1],
					'relative_offset' => $dir['relative_offset'][1],
					'file_name' => $dir['file_name'],
					'extra_field' => $dir['extra_field'],
					'file_comment' => $dir['file_comment'],
				);
			} elseif ($signature == $this->dirSignatureE) {
				# $this->debugMsg(1, "EOF Dir Signature!");

				$eodir['disk_number_this'] = unpack("v", fread($fh, 2)); // number of this disk
				$eodir['disk_number'] = unpack("v", fread($fh, 2)); // number of the disk with the start of the central directory
				$eodir['total_entries_this'] = unpack("v", fread($fh, 2)); // total number of entries in the central dir on this disk
				$eodir['total_entries'] = unpack("v", fread($fh, 2)); // total number of entries in
				$eodir['size_of_cd'] = unpack("V", fread($fh, 4)); // size of the central directory
				$eodir['offset_start_cd'] = unpack("V", fread($fh, 4)); // offset of start of central directory with respect to the starting disk number
				$zipFileCommentLenght = unpack("v", fread($fh, 2)); // zipfile comment length
				$eodir['zipfile_comment'] = $zipFileCommentLenght[1] ? fread($fh, $zipFileCommentLenght[1]) : ''; // zipfile comment
				$this->endOfCentral = Array(
					'disk_number_this' => $eodir['disk_number_this'][1],
					'disk_number' => $eodir['disk_number'][1],
					'total_entries_this' => $eodir['total_entries_this'][1],
					'total_entries' => $eodir['total_entries'][1],
					'size_of_cd' => $eodir['size_of_cd'][1],
					'offset_start_cd' => $eodir['offset_start_cd'][1],
					'zipfile_comment' => $eodir['zipfile_comment'],
				);
			} else {
				if (!$ddTry) {
					$this->debugMsg(1, "Unexpected header. Trying to detect wrong placed 'Data Descriptor'...\n");
					$ddTry = true;
					fseek($fh, 12 - 4, SEEK_CUR); // Jump over 'crc-32'(4) 'compressed-size'(4), 'uncompressed-size'(4)
					continue;
				}
				$this->debugMsg(1, "Unexpected header, ending loop at offset " . ftell($fh));
				break;
			}
			$ddTry = false;
		}

		if ($this->debug) {
			#------- Debug compressedList
			$kkk = 0;
			echo "<table border='0' style='font: 11px Verdana; border: 1px solid #000'>";
			foreach ($this->compressedList as $fileName => $item) {
				if (!$kkk && $kkk = 1) {
					echo "<tr style='background: #ADA'>";
					foreach ($item as $fieldName => $value)
						echo "<td>$fieldName</td>";
					echo '</tr>';
				}
				echo "<tr style='background: #CFC'>";
				foreach ($item as $fieldName => $value) {
					if ($fieldName == 'lastmod_datetime')
						echo "<td title='$fieldName' nowrap='nowrap'>" . date("d/m/Y H:i:s", $value) . "</td>";
					else
						echo "<td title='$fieldName' nowrap='nowrap'>$value</td>";
				}
				echo "</tr>";
			}
			echo "</table>";

			#------- Debug centralDirList
			$kkk = 0;
			if (sizeof($this->centralDirList)) {
				echo "<table border='0' style='font: 11px Verdana; border: 1px solid #000'>";
				foreach ($this->centralDirList as $fileName => $item) {
					if (!$kkk && $kkk = 1) {
						echo "<tr style='background: #AAD'>";
						foreach ($item as $fieldName => $value)
							echo "<td>$fieldName</td>";
						echo '</tr>';
					}
					echo "<tr style='background: #CCF'>";
					foreach ($item as $fieldName => $value) {
						if ($fieldName == 'lastmod_datetime')
							echo "<td title='$fieldName' nowrap='nowrap'>" . date("d/m/Y H:i:s", $value) . "</td>";
						else
							echo "<td title='$fieldName' nowrap='nowrap'>$value</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}

			#------- Debug endOfCentral
			$kkk = 0;
			if (sizeof($this->endOfCentral)) {
				echo "<table border='0' style='font: 11px Verdana' style='border: 1px solid #000'>";
				echo "<tr style='background: #DAA'><td colspan='2'>dUnzip - End of file</td></tr>";
				foreach ($this->endOfCentral as $field => $value) {
					echo "<tr>";
					echo "<td style='background: #FCC'>$field</td>";
					echo "<td style='background: #FDD'>$value</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}

		return $this->compressedList;
	}


	Function getExtraInfo($compressedFileName)
	{
		return
			isset($this->centralDirList[$compressedFileName]) ?
				$this->centralDirList[$compressedFileName] :
				false;
	}


	Function getZipInfo($detail = false)
	{
		return $detail ?
			$this->endOfCentral[$detail] :
			$this->endOfCentral;
	}


	Function unzip($compressedFileName, $targetFileName = false)
	{
		$fdetails = &$this->compressedList[$compressedFileName];

		if (!sizeof($this->compressedList)) {
			$this->debugMsg(1, "Trying to unzip before loading file list... Loading it!");
			$this->getList(false, $compressedFileName);
		}
		if (!isset($this->compressedList[$compressedFileName])) {
			$this->debugMsg(2, "File '<b>$compressedFileName</b>' is not compressed in the zip.");
			return false;
		}
		if (substr($compressedFileName, -1) == "/") {
			$this->debugMsg(2, "Trying to unzip a folder name '<b>$compressedFileName</b>'.");
			return false;
		}
		if (!$fdetails['uncompressed_size']) {
			$this->debugMsg(1, "File '<b>$compressedFileName</b>' is empty.");
			return "";
		}

		fseek($this->fh, $fdetails['contents-startOffset']);
		return $this->uncompress(
			fread($this->fh, $fdetails['compressed_size']),
			$fdetails['compression_method'],
			$fdetails['uncompressed_size']);
	}


	Function unzipAll($targetDir = false, $baseDir = "", $maintainStructure = true, $chmod = false)
	{
		if ($targetDir === false)
			$targetDir = dirname(__FILE__) . "/";

		$lista = $this->getList();
		if (sizeof($lista)) foreach ($lista as $fileName => $trash) {
			$dirname = dirname($fileName);
			$outDN = "$targetDir/$dirname";

			if (substr($dirname, 0, strlen($baseDir)) != $baseDir)
				continue;

			if (!is_dir($outDN) && $maintainStructure) {
				$str = "";
				$folders = explode("/", $dirname);
				foreach ($folders as $folder) {
					$str = $str ? "$str/$folder" : $folder;
					if (!is_dir("$targetDir/$str")) {
						$this->debugMsg(1, "Creating folder: $targetDir/$str");
						mkdir("$targetDir/$str");
						if ($chmod)
							chmod("$targetDir/$str", $chmod);
					}
				}
			}
			if (substr($fileName, -1, 1) == "/")
				continue;

			$maintainStructure ?
				$this->unzip($fileName, "$targetDir/$fileName") :
				$this->unzip($fileName, "$targetDir/" . basename($fileName));

			if ($chmod)
				chmod($maintainStructure ? "$targetDir/$fileName" : "$targetDir/" . basename($fileName), $chmod);
		}
	}

	Function close()
	{ // Free the file resource
		if ($this->fh)
			fclose($this->fh);
	}

	// Private (you should NOT call these methods):
	Function uncompress($content, $mode, $uncompressedSize, $targetFileName = false)
	{
		switch ($mode) {
			case 0:
				// Not compressed
				return $content;
			case 1:
				$this->debugMsg(2, "Shrunk mode is not supported... yet?");
				return false;
			case 2:
			case 3:
			case 4:
			case 5:
				$this->debugMsg(2, "Compression factor " . ($mode - 1) . " is not supported... yet?");
				return false;
			case 6:
				$this->debugMsg(2, "Implode is not supported... yet?");
				return false;
			case 7:
				$this->debugMsg(2, "Tokenizing compression algorithm is not supported... yet?");
				return false;
			case 8:
				// Deflate
				return gzinflate($content, $uncompressedSize);
			case 9:
				$this->debugMsg(2, "Enhanced Deflating is not supported... yet?");
				return false;
			case 10:
				$this->debugMsg(2, "PKWARE Date Compression Library Impoloding is not supported... yet?");
				return false;
			default:
				$this->debugMsg(2, "Unknown uncompress method: $mode");
				return false;
		}
	}


	Function debugMsg($level, $string)
	{
		if ($this->debug)
			if ($level == 1)
				echo "<b style='color: #777'>dUnzip2:</b> $string<br>";
		if ($level == 2)
			echo "<b style='color: #F00'>dUnzip2:</b> $string<br>";
	}
}

?>