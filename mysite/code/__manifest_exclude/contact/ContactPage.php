<?php
class ContactPage extends Page {	
	
	static $icon = 'mysite/images/icons/office';
	static $singular_name = "Contact page";
   	static $plural_name = "Contact pages";
	static $description = '';
	
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
		return !(ContactPage::get()->Count() > 0);
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeFieldFromTab('Root.Main','Content');
		
		return $fields;
	}
	
}

class ContactPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}