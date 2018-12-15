<?php
class ModuleFolder extends Page {

	static $icon = 'mysite/images/icons/modulefolder';
	static $singular_name = "Module folder";
   	static $plural_name = "Module folders" ;
	static $description = "Add underneath modular pages and add all modules to this folder.";	
	//static $allowed_children = array("Module","CustomVirtualPage","RedirectorPage"); //"none";
	//static $default_child = "Page";

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
		'ShowInSearch' => false,
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

		return $fields;
	}	
	
	public function onAfterWrite() {
		if(count($this->Children()) > 0){
			$i = 1;
			foreach($this->Children() as $child){ //assuming we'll get them in order
				$child->Sort = $i;
				$child->write();
				$i++;	
			}
				
		}		
		parent::onAfterWrite();
	}			
}

class ModuleFolder_Controller extends Page_Controller {

	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
	}
}