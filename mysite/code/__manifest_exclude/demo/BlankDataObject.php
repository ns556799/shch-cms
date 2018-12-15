<?php 
class BlankDataObject extends DataObject {
	
	static $db = array (
		"Title" => "Text",
		"Content" => "HTMLText",
		"DraftMode" => "Boolean",
		"SortOrder" => "Int" //only do this if it is in has_one relationship with the page (not a has_many)
	);
	
	static $has_one = array (
		"MainImage" => "Image", // not need for "BetterImage",
		"Page" => "Page"
	);
	
	static $defaults = array(

	);
	
	static $default_sort = "Title Desc";	
	
	function getCMSFields(){ //getCMSFields_forPopup() deprecated in SS3
	
		$fldMainImage = new UploadField('MainImage', 'Main image');
    	$fldMainImage->allowedExtensions = array('jpg', 'png', 'gif');

		$fldContent = new HTMLEditorField("Content", "Content");
		$fldContent->setRows(5);
	
		return new FieldList(
			new TextField("Title"),
			$fldContent,
			$fldMainImage,
			new CheckboxField("DraftMode")
		);
	}	
	
	function Thumbnail() {
		if ($oImage = $this->MainImage()) {
			return $oImage->CMSThumbnail();
		} else {
			return NULL;
		}
	}	
	
	function DraftModeNice() {
		if($this->DraftMode) {
			return "Draft";	
		} else {
			return "Published";
		}
	}
	
}