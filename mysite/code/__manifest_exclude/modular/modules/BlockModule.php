<?php
class BlockModule extends Module {

	static $icon = 'mysite/images/icons/blocklist';	
	static $singular_name = "Module - blocks";
   	static $plural_name = "Module - blocks" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		"SelectedPage" => "SiteTree"
	);
	
	private static $has_many = array(
		"Blocks" => "BlockItem"
	);
	
	function canDelete($member = NULL) {
		return true;
	}   

	function canCreate($member = NULL) {
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		//$fields->removeByName('Banners');
		//$fields->addFieldToTab("Root.Main", new TreeDropDownField('SelectedPageID', 'Select page to link to', 'SiteTree'));

		$fields->addFieldToTab("Root.Main", $fldContent = new HtmlEditorField("Content", "Content before blocks"));
		$fldContent->setRows(5);

		$fields->addFieldToTab("Root.Main", $fldContent2 = new HtmlEditorField("Content2", "Content after blocks"));
		$fldContent2->setRows(5);

		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"Thumbnail" => "Thumbnail",
				"Name" => "Name",
				"DraftModeNice" => "Draft?"
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
			
		$fldBlocks = new GridField("Blocks", "Blocks:", $this->Blocks(), $gfConfig);
		$fields->addFieldToTab("Root.Main", $fldBlocks);	
		
		return $fields;
	}
	
	public function getBlocks() {
		$filter = array(
			'PageID' => $this->ID,
			'DraftMode' => 0
		);
		$data = BlockItem::get()->filter($filter)->sort('SortOrder', 'ASC');
		return $data;
	}
	
}

class BlockModule_Controller extends Module_Controller {
	
	public function init() {
		parent::init();
	}
}