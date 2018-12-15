<?php
class CmsFolder extends Page {

	static $icon = 'mysite/images/icons/folder';
	static $singular_name = "Folder";
   	static $plural_name = "Folders" ;
	static $description = '';	

	private static $db = array(
	);

	private static $has_one = array(
	);
	
	static $has_many = array (
	);	
	
	static $extensions = array(
	);
	
	static $defaults = array (
		'ShowInMenus' => false,
		'ShowInSearch' => false
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

		$fields->removeFieldFromTab('Root.Main','Content');
		
		$fields->removeByName("Meta-data"); 
/*
		$fields->removeFieldFromTab('Root.Content.Metadata','MetaTitle');
		$fields->removeFieldFromTab('Root.Content.Metadata','MetaKeywords');
		$fields->removeFieldFromTab('Root.Content.Metadata','MetaDescription');
		$fields->removeFieldFromTab('Root.Content.Metadata','ExtraMeta');
		$fields->removeFieldFromTab('Root.Content.Metadata','MetaTagsHeader');

		//Fields to remove
		$fields->removeByName("GoogleSitemap"); 
		$fields->removeByName('MenuTitle');
		$fields->removeFieldFromTab('Root.Content.Main','Content');
		*/		
		return $fields;
	}	
}

class CmsFolder_Controller extends Page_Controller {

	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
	}

	public function index() {
		throw new SS_HTTPResponse_Exception(ErrorPage::response_for(404), 404);
	}
}