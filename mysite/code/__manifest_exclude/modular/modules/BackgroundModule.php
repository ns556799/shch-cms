<?php
class BackgroundModule extends Module {

	static $icon = 'mysite/images/icons/module-banner';	
	static $singular_name = "Module - background";
   	static $plural_name = "Module - background" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);
	
	function canDelete($member = NULL) {
		return true;
	}   
	
	function canCreate($member = NULL) {
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
				
		$fldMainImage = new UploadField('MainImage', 'Main image');
    	$fldMainImage->allowedExtensions = array('jpg', 'png', 'gif');
		
		$fields->addFieldToTab("Root.Main", $fldMainImage);
				
		return $fields;
	}
}
class BackgroundModule_Controller extends Module_Controller {
	
	public function init() {
		parent::init();
	}
}