<?php
class CustomFile extends DataExtension {
     
	public function getCustomFileType() {
		$types = array(
			'gif' => 'GIF image - good for diagrams',
			'jpg' => 'JPEG image - good for photos',
			'jpeg' => 'JPEG image - good for photos',
			'png' => 'PNG image - good general-purpose format',
			'ico' => 'Icon image',
			'tiff' => 'Tagged image format',
			'doc' => 'Word document',
			'docx' => 'Word document',
			'xls' => 'Excel spreadsheet',
			'xlsx' => 'Excel spreadsheet',
			'zip' => 'ZIP compressed file',
			'gz' => 'GZIP compressed file',
			'dmg' => 'Apple disk image',
			'pdf' => 'Adobe Acrobat PDF file',
			'mp3' => 'MP3 audio file',
			'wav' => 'WAV audo file',
			'avi' => 'AVI video file',
			'mpg' => 'MPEG video file',
			'mpeg' => 'MPEG video file',
			'js' => 'Javascript file',
			'css' => 'CSS file',
			'html' => 'HTML file',
			'htm' => 'HTML file',
			'ppt' => 'Powerpoint presentation',
			'pptx' => 'Powerpoint presentation'
		);
		
		$ext = strtolower($this->owner->getExtension());
		
		return isset($types[$ext]) ? $types[$ext] : 'unknown';
	}

}   