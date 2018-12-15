<?php
class Module extends Page {
	
	static $icon = 'mysite/images/icons/module';	
	static $allowed_children = "none";
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		"ModuleBackground" => "Text",
        "ModuleClasses" => "Text",
		"ModuleIntro"	=> "HTMLText",
		"ModuleContent1" => "HTMLText",
		"ModuleContent2" => "HTMLText",
		"ModuleContent3" => "HTMLText",
		"ModuleContent4" => "HTMLText",
		"ModuleContent5" => "HTMLText",
		"ModuleContent6" => "HTMLText",
		"VideoID1" => "Varchar(255)",
		"VideoID2" => "Varchar(255)"
	);

	private static $has_one = array(
		"ModuleImage1" => "Image",
		"ModuleImage2" => "Image",
		"ModuleImage3" => "Image",
		"ModuleImage4" => "Image",
		"ModuleImage5" => "Image",
		"ModuleImage6" => "Image",
		"ModularPage" =>  "ModularPage",
	);
	
	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}   

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		if($this->ClassName != "Module"){
			return true;
		}
	}  	
	
	static $defaults = array (
		'ShowInMenus' => false,
		'ShowInSearch' => false,
	);		
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeFieldFromTab('Root.Main','Content');
		$fields->removeFieldFromTab('Root.Main','Metadata');
		
		/*
		//$fields->removeByName('Metadata'); //a field
		$fields->removeByName('GoogleSitemap'); //a tab
		$fields->removeByName('RelatedInformation'); //a tab
		$fields->removeByName('Media'); //a tab
		$fields->removeFieldFromTab('Root.Content.Main','Content');
		$fields->removeFieldFromTab('Root.Content.Main','Summary');
		//$fields->removeByName('Media'); //a tab
		//$fields->removeFieldFromTab('Root.Content.Metadata','MetaDescription'); // a specific field in a tab
*/
        $fields->addFieldToTab("Root.ModuleConfig", new TextField('ModuleClasses','Additional classes to add to the module'));
		$fields->addFieldToTab("Root.ModuleConfig", new TextField('ModuleBackground','Background Color Hex (minus #)'));
						
		return $fields;
	}
	
	//set the modular page parent for ease of reference
	function onBeforeWrite(){
		parent::onBeforeWrite();
		$oPage = $this;
		
		while(!is_a($oPage, 'ModularPage')){ //checks if page is a ModularPage or a descendant class
			$oPage = $oPage->Parent();
			if($oPage->ID == 0) exit;
		}
		$this->ModularPageID = $oPage->ID;
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
	
}

class Module_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	public function index(){
		
		//in SS3, this works in the admin as well...

		//	if($firstChild = SiteTree::get()->filter("ParentID", $this->ID)->sort('Sort')->First()){
		//		$this->redirect($firstChild->Link());
		//	}else{
		//		return $this->httpError(404);
		//	}	

		
		/*
		
		if($this->isSpider()){
			$data = array();
			//return $data;
			return $this->customise($data)->renderWith(array("ModuleWrapper"));
		//echo $this->Parent()->parentClass();
		//print_r(ClassInfo::ancestry($this->Parent()->class));
		//if the parent is a modular page, redirect there
		}elseif($oParent = $this->Parent()){
			if($oParent->ClassName == "ModularPage" || $oParent->parentClass() == "ModularPage"){ //this doesn't account for virtual pages
				return Controller::curr()->redirect($oParent->Link());
				//return Director::redirect($oParent->Link());
			}
		}else{
		
			//else show the module
			$data = array();
			return $data;
		}
		
		*/
		
	}
	
}