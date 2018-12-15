<?php
class BlankModule extends Module {
	
	static $icon = 'mysite/images/icons/module';	
	static $singular_name = "Module - blank";
   	static $plural_name = "Module - blank" ;
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
		return false; //set this to false when all modules have been created. This class should only be extended
	} 	

	function getCMSFields() {
		$fields = parent::getCMSFields();

		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"Title" => "Title"
			)
		);

		//replaces DataObjectManager
		$gfConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableRows('SortOrder'),
			new GridFieldSortableHeader(),
			$gfColumns, //new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		);

		$fldBlankDataObjects = new GridField("BlankDataObjects", "Title here:", $this->BlankDataObjects(), $gfConfig);
		$fields->addFieldToTab("Root.Banners", $fldBlankDataObjects);

		return $fields;
	}

}
class BlankModule_Controller extends Module_Controller {
	public function init() {
		parent::init();
	}
	
//	public function index(){
//
//		//if the parent is a modular page, redirect there
//		if($oParent = $this->Parent()){
//			if($oParent->ClassName == "ModularPage"){ //this doesn't account for virtual pages
//				$data = array();
//				$data['ModularPage'] = $oParent;
//				$data['Module'] = $this;
//
//				return $this->customise($data)->renderWith(array('ModularPageSingleModule','Page'));
//			}
//		}
//	}
}