<?php
class DemoPage extends Page {
	
	static $icon = 'mysite/images/icons/mainleft';	
	static $singular_name = "Demo page";
   	static $plural_name = "Demo pages" ;
	static $description = 'This is a demo page - do not use';
	static $allowed_children = array("SiteTree"); //"none"; *Page would allow Page explicitly but no subclasses of page
	static $default_child = "Page";
	
	private static $db = array(
	
		"DemoSection" => "Enum('inherit, red, yellow, green, blue')",							  
		"ContentAdditional" => "HTMLText",
		"ShowSomething" => "Boolean",
		"PubDate" => "Date",
		"DemoType" => "Enum('Type 1, Type 2, Type 3, Type 4, Type 5','Type 3')",
		"DemoTypeMulti" => "Varchar(255)"			
		
	);

	private static $has_one = array(
		"RelatedPage" => "Page",
		"DemoImage" => "Image"
	);
	
	private static $has_many = array(
		"DemoDataObjects" => "DemoDataObject",
		"DemoFileDataObjects" => "DemoFileDataObject"
	);
	
	//this replaces the DOM config settings, but only for many_many relationships
	/*	
	static $many_many_extraFields = array( 
		"DemoDataObjects" => array("SortOrder" => "Int")
	);
	*/
	
	static $defaults = array (
		'ShowInMenus' => true,
		'ShowInSearch' => true
	);			
	
	function canDelete($member = NULL) {
		return true;
	}   
	
	function canCreate($member = NULL) {
		return true; //!DataObject::get_one("DemoPage");
	} 	
	
	/*
	//used in ModelAdmin (for search) - see BookingAdmin class
	static $searchable_fields = array(
		'Title',										 
		'JobTitle',
		'OtherRoles',
        "StaffTypeMulti" => array(
             "field" => "TextField",
             "filter" => "PartialMatchFilter",
             "title" => 'Staff type'
         )	,
	);
	
	//used in ModelAdmin (list display) - see BookingAdmin class
	static $summary_fields = array(
		'Title',	
		'JobTitle',
		'OtherRoles',
		'StaffTypeMulti',
		'PageSummary'
	);	
	*/
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		//$fields->addFieldToTab("Root.Main", new Tab('NewTab','A new tab'),"Metadata"); //add tabs in before Metadata
		
		//$fields->removeFieldFromTab('Root.Main','Content');
		
		$fields->addFieldToTab("Root.AnotherTab",new TabSet('Tabs',
			new Tab('SubTab1','First sub-tab'),
			new Tab('SubTab2','Second sub-tab')		
      	));	
		
		
		$demoTypes = $this->dbObject('DemoType')->enumValues();
		$demoTypeField = new CheckboxSetField("DemoTypeMulti","Select type(s)",$demoTypes);	
		$fields->addFieldToTab("Root.NewTab",$demoTypeField,"Content");

		$fields->addFieldToTab("Root.Main", new CheckboxField('ShowSomething','A checkbox to show something'), "Content");
		
		$fields->addFieldToTab("Root.Main", $dateField1 = new DateField("PubDate", "Publication date"), "Content");
		$dateField1->setConfig('showcalendar', true);
		
		$fields->addFieldToTab("Root.Main", new DropdownField('DemoSection','Section', singleton('DemoPage')->dbObject('DemoSection')->enumValues()),"Content");

		$fields->addFieldToTab("Root.Main", new TreeDropDownField('RelatedPageID', 'Select related page', 'SiteTree'));

		$fields->addFieldToTab("Root.Images", $fldDemoImage = new UploadField('DemoImage','Demo upload for images'));
		//$fldDemoImage->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fldDemoImage->setAllowedFileCategories("image");
		$fldDemoImage->setFolderName('Uploads/team');
		$fldDemoImage->getValidator()->setAllowedMaxFileSize(52428800);

		$pages = new ArrayList; 
		foreach(Page::get() as $obj) $pages->push($obj);
		foreach(DemoPage::get() as $obj) $pages->push($obj);
		//foreach(Page::get()->filter('FieldName', 1)->sort('RAND()') as $obj) 
		
		if($pages) {
			$pages = $pages->Map('ID', 'Title');	//id, function name for value, no selection
			$pagesDropdown = new DropdownField("RelatedPageID", "Select page", $pages);
			$pagesDropdown->SetEmptyString("-- please select --");		
			$fields->addFieldToTab("Root.Main", $pagesDropdown, "Content");		
		}
		
		/*
		$DemoDOM = new DataObjectManager(
			$this, // Controller
			'DemoDataObjects', // Source name
			'DemoDataObject', // Source class
			array(
				"Thumbnail" => "Image stored against DOM",
				"Name" => "Name",
				"SelectedColours" => "Selected colours",
				//"BannerLink.Title" => "Link"
			), // Headings
			'getCMSFields_forPopup' // Detail fields function or FieldSet
			// Filter clause
			// Sort clause
			// Join clause
			
		);
		$fields->addFieldToTab("Root.Content.NewTab.Tabs.SubTab1", $DemoDOM);			
		*/
		
		//replaces DataObjectManager
		$gridFieldConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableRows('SortOrder'),
			new GridFieldSortableHeader(),
			new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		);
		
		$gridField = new GridField("DemoDataObjects", "DemoDataObjects List:", $this->DemoDataObjects(), $gridFieldConfig);
		$fields->addFieldToTab("Root.DemoDataObjects", $gridField);		
		
		
		return $fields;
	}
	
	function getCMSFieldsORIGINAL(){

		//Remove and/or rename tabs
		$fields->removeByName('ExtraMeta'); //a field
		$fields->removeByName('RelatedInformation'); //a tab
		$fields->removeByName('Media'); //a tab
		$fields->removeFieldFromTab('Root.Content.Metadata','MetaDescription'); // a specific field in a tab
		$fields->fieldByName('Root.Main')->setTitle('This is the \'Main\' tab (renamed)');
		$fields->fieldByName('Root.Main.Content')->setTitle('This is the \'Content\' field (renamed)'); 
		
		$demoTypes = $this->dbObject('DemoType')->enumValues();
		$demoTypeField = new CheckboxSetField("DemoTypeMulti","Select type(s)",$demoTypes);	
		$fields->addFieldToTab("Root.Main",$demoTypeField,"Content");
		
		$fields->addFieldToTab("Root.Main", $dateField1 = new DateField("PubDate", "Publication date"), "Content");
		$dateField1->setConfig('showcalendar', true);
		$dateField1->setConfig('dateformat', 'dd/MM/YYYY');

		$fields->addFieldToTab("Root.Main", new CheckboxField('ShowSomething','A checkbox to show something'), "Content");

		$fields->addFieldToTab("Root.Main", new DropdownField('DemoSection','Section', singleton('DemoPage')->dbObject('DemoSection')->enumValues()),"Content");
		
		$pages = new DataObjectSet(); 
		$pages->merge(DataObject::get("HomePage"));
		$pages->merge(DataObject::get("NewsPage"));
		if($pages) {
			$pages = $pages->Map('ID', 'getTitleForDD', '--please select--');	//id, function name for value, no selection
			$pagesDropdown = new DropdownField("RelatedPageID","Select page (homepage and newspage only)",$pages);
			$pagesDropdown->SetEmptyString("-- please select --");		
			$fields->addFieldToTab("Root.Main", $pagesDropdown, "Content");		
		}

		$fields->addFieldToTab("Root.Content",new Tab('NewTab','A new tab'),"Metadata"); //add tabs in before Metadata
		$fields->addFieldToTab("Root.Content.NewTab",new TabSet('Tabs',
			new Tab('SubTab1','First sub-tab'),
			new Tab('SubTab2','Second sub-tab')		
      	));	
		
		$fields->addFieldToTab("Root.Content.NewTab.Tabs.SubTab1", new LiteralField('Literal1','<h1>Here is a tab title</h1>'));
		
		$DemoDOM = new DataObjectManager(
			$this, // Controller
			'DemoDataObjects', // Source name
			'DemoDataObject', // Source class
			array(
				"Thumbnail" => "Image stored against DOM",
				"Name" => "Name",
				"SelectedColours" => "Selected colours",
				//"BannerLink.Title" => "Link"
			), // Headings
			'getCMSFields_forPopup' // Detail fields function or FieldSet
			// Filter clause
			// Sort clause
			// Join clause
			
		);
		$fields->addFieldToTab("Root.Content.NewTab.Tabs.SubTab1", $DemoDOM);				


		$DemoFileDOM = new FileDataObjectManager(
			$this, // Controller
			'DemoFileDataObjects', // Source name
			'DemoFileDataObject', // Source class
			'DemoFile', // File name on DataObject
			array(
				'Name' => 'Name', 
				//'Description' => 'Description', 
				//'SelectedCalls' => 'Selected call(s)',
				'DemoFile.Filename' => 'Filename'
				//'Category' => 'Category'
			), // Headings 
			'getCMSFields_forPopup' // Detail fields (function name or FieldSet object)
			// Filter clause
			// Sort clause
			// Join clause
		);
		
		/*
		$DemoFileDOM->setFilter(
			'Category', // Name of field to filter
			'Filter by Category', // Label for filter
			singleton('Resource')->dbObject('Category')->enumValues() // Map for filter (could be $dataObject->toDropdownMap(), e.g.)
		);
		*/
		$DemoFileDOM->setPermissions(array(
												"show",
												"edit",
												"delete",
												"add"
											)
		);		
		
		$DemoFileDOM->setAllowedFileTypes(array('pdf','doc','xls')); 
		$DemoFileDOM->setBrowseButtonText("Upload (pdf, doc, xls only)"); 
		$DemoFileDOM->setGridLabelField('Name'); 
		$DemoFileDOM->setPluralTitle('Files');
		$DemoFileDOM->setDefaultView("list");
		$DemoFileDOM->setPageSize('999');

		$fields->addFieldToTab("Root.Content.NewTab.Tabs.SubTab2", $DemoFileDOM);
		
		
		return $fields;
	}
	
}

class DemoPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}