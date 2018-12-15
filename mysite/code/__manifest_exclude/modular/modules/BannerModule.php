<?php
class BannerModule extends Module {

	static $icon = 'mysite/images/icons/module-banner';	
	static $singular_name = "Module - banner";
   	static $plural_name = "Module - banner" ;
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
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeByName('Banners');
		
		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"Thumbnail" => "Thumbnail",
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
			
		$fldBanners = new GridField("Banners", "Banners:", $this->Banners(), $gfConfig);
		$fields->addFieldToTab("Root.Main", $fldBanners);
				
		return $fields;
	}
}
class BannerModule_Controller extends Module_Controller {
	
	public function init() {
		parent::init();
	}
}