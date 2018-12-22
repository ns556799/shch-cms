<?php
class FacilityPage extends Page {
	
	static $icon = 'mysite/images/icons/mainleft';	
	static $singular_name = "Facility page";
   	static $plural_name = "Facility pages" ;
	static $description = 'Facility page';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);

	private static $has_many = array(
		"FacilityItems" => "FacilityItem"
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

		$fields->removeByName(['Banners', 'OtherImages']);

		$fields->addFieldToTab('Root.Items', new GridField("FacilityItems", "Facility Items:", $this->FacilityItems(), Page::gridConfig()));

		return $fields;
	}
	
}

class FacilityPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}
