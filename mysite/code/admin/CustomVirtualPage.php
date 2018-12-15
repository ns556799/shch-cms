<?php
class CustomVirtualPage extends VirtualPage {
	
	static $icon = 'mysite/images/icons/virtual';	
	static $singular_name = "Virtual page (custom)";
   	static $plural_name = "Virtual pages (custom)";
	static $description = "Displays the content of another page (custom version)";
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
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}

	//public function RenderModule(){
        //$this->preRenderModule();
		//$template = $this->ClassName."Content"; //use this template
		//$data = $this;
		//return $this->customise($data)->renderWith(array($template));	
	//}
	
}

class CustomVirtualPage_Controller extends VirtualPage_Controller {
	
	public function init() {
		parent::init();
	}
}