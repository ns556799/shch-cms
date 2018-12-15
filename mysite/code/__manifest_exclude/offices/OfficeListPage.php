<?php
class OfficeListPage extends Page {
	
	static $icon = 'mysite/images/icons/office';	
	static $singular_name = "Office list";
   	static $plural_name = "Office lists" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);
	
	private static $has_many = array(
		"Offices" => "Office",
	);		
	
	function canDelete($member = NULL) {
		return false;
	}   

	function canCreate($member = NULL) {
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"Name" => "Name"
			)
		);		
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
			
		$fldOffices = new GridField("Offices", "Offices:", $this->Offices(), $gfConfig);
		$fields->addFieldToTab("Root.Offices", $fldOffices);
		
		
		return $fields;
	}

	public function getAllOffices($limit = NULL){
		
		$filter = array();
		$filter["PageID"] = $this->ID;
		
		$oOffices = Office::get()->filter($filter)->sort("SortOrder ASC")->limit($limit);
		
		return $oOffices;
	}
	
}

class OfficeListPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
}