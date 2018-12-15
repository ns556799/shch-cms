<?php 
class Banner extends DataObject {
	
	static $db = array (
		"Title" => "Text",
		"Description" => "HTMLText",
		"DraftMode" => "Boolean",
		"QuoteLayout" => "Boolean",
		"ContentStyle" => "Varchar(20)",
		"SortOrder" => "Int" //only do this if it is in has_one relationship with the page (not a has_many)
	);
	
	static $has_one = array (
		"MainImage" => "Image", // not need for "BetterImage",
		"Page" => "Page",
	);
	
	static $defaults = array(
		"ContentStyle" => "Style1"
	);
	
	static $default_sort = "Title Desc";	
	
	function getCMSFields(){ //getCMSFields_forPopup() deprecated in SS3
	
		$fldMainImage = new UploadField('MainImage', 'Main image');
    	$fldMainImage->allowedExtensions = array('jpg', 'png', 'gif');	
	
		$fldDescription = new HTMLEditorField("Description", "Content");
		$fldDescription->setRows(5);
		
		$fldQuoteLayout = new CheckboxField("QuoteLayout");
		
		$arrLayout = Array(
			'Style1' => 'None',
			'Style2' => 'Semi-transparent',
			'Style3' => 'White'
		);
		
		$fldContentStyle = new DropdownField("ContentStyle", "Content background", $arrLayout);
	
		return new FieldList(
			new TextField("Title"),
			$fldDescription,
			$fldMainImage,
			$fldContentStyle,
			$fldQuoteLayout,
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