<?php 
class DemoFileDataObject extends DataObject
{
	static $db = array (
		"Name" => "Text",
		"Description" => "HTMLText",
	);
	
	static $has_one = array (
		"DemoFile" => "File",
		"DemoPage" => "Page",
	);
	
	public function getCMSFields_forPopup()
	{
		
		return new FieldSet(
			new TextField("Name"),
			//new ImageField("GalleryImage", "Gallery image")
			new FileIFrameField("DemoFile", "Demo file")
		);
	}
	
	function Thumbnail() {
		$Image = $this->DemoImage();
		if ( $Image ) {
			return $Image->CMSThumbnail();
		} else {
			return null;
		}
	}	
	
}