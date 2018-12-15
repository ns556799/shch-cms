<?php
class ContentPage extends Page {
	
	static $icon = 'mysite/images/icons/mainleft';	
	static $singular_name = "Content page";
   	static $plural_name = "Content pages" ;
	static $description = 'General content page';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);
	
	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}   

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}
	
}

class ContentPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}