<?php
class ModularPage extends Page {
	
	static $icon = 'mysite/images/icons/modularpage';	
	static $singular_name = "Modular page";
   	static $plural_name = "Modular page" ;
	static $description = 'Modular page - add modules';
	//static $allowed_children = array("GeneralModule,BannerModule"); //"none";
	static $default_child = "GeneralModule";	
	
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
		
		//$fields->removeByName('Media'); 
		$fields->removeFieldFromTab('Root.Main','Content'); 
		//$fields->addFieldToTab("Root.Content.Main", new InfoField("ModularPageHelp", '<h2>Modular Page</h2>'));
		
		return $fields;
	}
	
	public function getChildModules(){
		//keep separate function so can have a selection of modular or other pages
		//return DataObject::get("Module", $filter = "`ParentID` = ".$this->ID);
		
	}
	
	function isModularPage() {	
		return true;
	}	
	
	private $firstWrite = false;
	
	function onBeforeWrite() {
		parent::onBeforeWrite();
		if(!$this->ID) $this->firstWrite = true;
	}
	
	public function onAfterWrite() {
		if($this->firstWrite){
			$oThis = "something";
			
			$oModuleFolder = new ModuleFolder();
			$oModuleFolder->Title = "Modules";
			$oModuleFolder->MenuTitle = "Modules";
			$oModuleFolder->ParentID = $this->ID;
			$oModuleFolder->write();	//this goes to live
		}		
		parent::onAfterWrite();
	}		
	
}

class ModularPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	public function getModulesFolder(){
		if($oModuleFolder = ModuleFolder::get()->filter(array("ParentID" => $this->ID))->First()){
			return $oModuleFolder;
		}
	}
	
}