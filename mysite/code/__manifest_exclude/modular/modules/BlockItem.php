<?php
class BlockItem extends DataObject {
	
	static $db = array(
		"Name" => "Text",
		"Content" => "HTMLText",
		"CTAText" => "Text",
		"DraftMode" => "Boolean",
		"SortOrder" => "Int" //only do this if it is in has_one relationship with the page (not a has_many)
	);
	
	static $has_one = array(
		"SelectedPageLink" => "SiteTree",
		"Page" => "Page",
		"MainImage" => "Image"
	);
	
	static $default_sort = "Name Desc";	
	
	function getCMSFields(){ //getCMSFields_forPopup() deprecated in SS3

	
		$fldMainImage = new UploadField('MainImage', 'Main image');
    	$fldMainImage->allowedExtensions = array('jpg', 'png', 'gif');	
		
		$fldContent = new HtmlEditorField("Content");
		$fldContent->setRows(15);
	
		return new FieldList(
			new TextField("Name"),
			$fldContent,
			new TreeDropDownField('SelectedPageLinkID', 'Select link', 'SiteTree'),
			new TextField("CTAText", "Link text"),
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