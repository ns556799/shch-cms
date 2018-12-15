<?php
class GalleryModule extends Module {

	static $icon = 'mysite/images/icons/gallery';	
	static $singular_name = "Module - gallery";
   	static $plural_name = "Module - galleries" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);
	
	private static $has_many = array(
		
	);
	
	function canDelete($member = NULL) {
		return true;
	}   

	function canCreate($member = NULL) {
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeByName('Banners');

		$fields->addFieldToTab("Root.Main", $fldContent = new HtmlEditorField("Content", "Content before blocks"));
		$fldContent->setRows(5);

		$fields->addFieldToTab("Root.Main", $fldContent2 = new HtmlEditorField("Content2", "Content after blocks"));
		$fldContent2->setRows(5);	
		
		return $fields;
	}
	
	public function	getUploadedImages($SortOrder = "leaderboard", $filter = NULL, $limit = 5){
		return singleton("GalleryPage_Controller")->getUploadedImages($SortOrder, $filter, $limit);
	}
	
}

class GalleryModule_Controller extends Module_Controller {
	
	public function init() {
		parent::init();
	}
}