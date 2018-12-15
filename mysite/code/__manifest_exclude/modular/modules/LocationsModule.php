<?php
class LocationsModule extends Module {

	static $icon = 'mysite/images/icons/map';	
	static $singular_name = "Module - locations";
   	static $plural_name = "Module - locations" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	
	private static $db = array(
		"ShowOfficeLocations" => "Boolean",
		"ShowImageLocations" => "Boolean"
	);

	private static $has_one = array(
		
	);
	
	private static $has_many = array(
		
	);
	
	function canDelete($member = NULL) {
		return true;
	}   

	function canCreate($member = NULL) {
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fldShowOfficeLocations = new CheckboxField("ShowOfficeLocations", "Show office locations?");
		$fldShowImageLocations = new CheckboxField("ShowImageLocations", "Show image locations?");
		
		$fields->addFieldToTab("Root.Main", $fldShowOfficeLocations);
		$fields->addFieldToTab("Root.Main", $fldShowImageLocations);
		
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
		
		$fldLocations = new GridField("MapLocations", "Offices:", $this->MapLocations(), $gfConfig);
		$fields->addFieldToTab("Root.Main", $fldLocations);
		
		return $fields;
	}
	
	function getUploadedImage() {
		$filter = array(
			
		);
		$data = UploadedImage::get()->filter($filter)->sort('VoteCount', 'ASC');
		return $data;
	}
	
}

class LocationsModule_Controller extends Module_Controller {
	
	public function init() {
		parent::init();
	}
	
	
}