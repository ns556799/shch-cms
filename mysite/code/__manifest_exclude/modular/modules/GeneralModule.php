<?php
class GeneralModule extends Module {
	
	static $icon = 'mysite/images/icons/module';	
	static $singular_name = "Module - general";
   	static $plural_name = "Module - general" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		"EqualCol" => "Boolean",
		"ContentLayout" => "Varchar(20)"
	);

	private static $has_one = array(
		
	);
	
	function canDelete($member = NULL) {
		return true;
	}   
	
	function canCreate($member = NULL) {
		return true; //set this to false when all modules have been created. This class should only be extended
	} 	
	
	static $defaults = array (
		'ShowInMenus' => false,
		'ShowInSearch' => false,
		'ContentLayout' => 'Layout1'
	);		
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeByName('Banners');
		
		//$fields->addFieldToTab("Root.Main", new CheckboxField("EqualCol", "Equal Columns?"),"Content");
		
		$arrLayout = Array(
			'Layout1' => 'Layout A',
			'Layout2' => 'Layout B',
			'Layout3' => 'Layout C'
		);
		
		//$fields->addFieldToTab("Root.Main", new LiteralField("ContentLayoutImage", '<h5>Please choose from one of the layouts shown below:</h5><img src="http://placehold.it/400x150">'));
		//$fields->addFieldToTab("Root.Main", new DropdownField("ContentLayout", "Content Layout", $arrLayout));
		
		$fields->addFieldToTab("Root.Main", $fldContent = new HtmlEditorField("Content", "Content - top"));	
		$fldContent->setRows(20);
		$fields->addFieldToTab("Root.Main", $fldContent2 = new HtmlEditorField("Content2", "Content - middle, left column"));	
		$fldContent2->setRows(20);
		$fields->addFieldToTab("Root.Main", $fldContent3 = new HtmlEditorField("Content3", "Content - middle, right column"));	
		$fldContent3->setRows(20);
		$fields->addFieldToTab("Root.Main", $fldContent4 = new HtmlEditorField("Content4", "Content - bottom"));	
		$fldContent4->setRows(20);
		
		return $fields;
	}
}
class GeneralModule_Controller extends Module_Controller {
	public function init() {
		parent::init();
	}
	
	public function index(){

		//if the parent is a modular page, redirect there
		if($oParent = $this->Parent()){
			if($oParent->ClassName == "ModularPage"){ //this doesn't account for virtual pages
				$data = array();
				$data['ModularPage'] = $oParent;
				$data['Module'] = $this;						
				
				return $this->customise($data)->renderWith(array('ModularPageSingleModule','Page'));
			}
		}	
	}
}