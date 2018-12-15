<?php
class BlankPage extends Page {
	
	static $icon = 'mysite/images/icons/mainleft';	
	//static $singular_name = "Page";
   	//static $plural_name = "Pages" ;
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
		return false;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}
	
}

class BlankPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}