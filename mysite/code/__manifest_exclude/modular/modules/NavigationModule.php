<?php
class NavigationModule extends Module {
	
	static $icon = 'mysite/images/icons/subnav';	
	static $singular_name = "Module - subnavigation";
   	static $plural_name = "Module - subnavigation" ;
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		"ModuleLayout" => "Varchar(25)"
	);

	private static $has_one = array(
		"SelectedPage" => "SiteTree"
	);
	
	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}   

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		return true;
	}  	
	
	static $defaults = array (
		'ShowInMenus' => false,
		'ShowInSearch' => false,
		'ModuleLayout' => 'Horizontal'
	);		
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$arrLayout = Array(
			'Layout1' => 'Horizontal',
			'Layout2' => 'Sidebar with content'
		);
		
		$fldModuleLayout = new DropdownField("ModuleLayout", "Layout", $arrLayout);
		
		//$fields->removeFieldFromTab('Root.Main','Content');
		$fields->removeFieldFromTab('Root.Main','Metadata');
						
		$fields->addFieldToTab("Root.Main", $fldModuleLayout);
		$fields->addFieldToTab("Root.Main", new TreeDropDownField('SelectedPageID', 'Select nav parent page', 'SiteTree'));
		
		$fields->addFieldToTab("Root.Main", new TextField("ShortDescription", "Tab name for selected page (leave blank to omit)"));
		
		//$fields->addFieldToTab("Root.Main", new HtmlEditorField("Content", "Content"));

		return $fields;
	}
	
	public function RenderModule(){
        $this->preRenderModule();
		$template = $this->ClassName."Content"; //use this template
		$data = $this;
		return $this->customise($data)->renderWith(array($template));	
	}

    public function preRenderModule(){
        // Override this to add JS/CSS to the head on a per module basis
    }
	
	public function getMainImageURL(){
		
		return $this->owner->ID;	
		//return $this->owner->MainImage()->URL;	
	}
	
	function isModule() {	
		return true;
	}
	
	function getModulePage() {
		return $this->Parent()->Parent();
	}
	
	public function CustomClassName(){
		return $this->ClassName."_".$this->ModuleLayout;
	}
}

class NavigationModule_Controller extends Module_Controller {
	
	public function init() {
		parent::init();
	}
	
	public function index(){

	}
	
}