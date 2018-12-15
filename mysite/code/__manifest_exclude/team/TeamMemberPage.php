<?php
class TeamMemberPage extends Page {
	
	static $icon = 'mysite/images/icons/staffpage';	
	static $singular_name = "Team member";
   	static $plural_name = "Team members" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		"Salutation" => "Text",
		"FirstName" => "Text",
		"Surname" => "Text",
		"Email" => "Text",
		"JobTitle" => "Text",
		"Phone" => "Text"		
	);

	private static $has_one = array(
		
	);

	static $many_many = array(
		"TagRegions" 	=> "TagRegion",
		"TagTeams" 		=> "TagTeam",
	);	
	
	//private static $create_table_options = array(
	//	'MySQLDatabase' => 'ENGINE=MyISAM'
	//);
	
	static $indexes = array(
		'Fulltext_search' => array ('type' => 'fulltext', 'value' => 'FirstName,Surname,JobTitle' ) 
	 );		
	
	function canDelete($member = NULL) {
		return true;
	}   

	function canCreate($member = NULL) {
		return true;
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab("Root.Main", new TextField('Salutation','Salutation'), "Content");
		$fields->addFieldToTab("Root.Main", new TextField('FirstName','First name'), "Content");
		$fields->addFieldToTab("Root.Main", new TextField('Surname','Last name'), "Content");
		$fields->addFieldToTab("Root.Main", new EmailField('Email','Email address'), "Content");
		$fields->addFieldToTab("Root.Main", new TextField('Phone','Phone number'), "Content");
		$fields->addFieldToTab("Root.Main", new TextField('JobTitle','Job title'), "Content");

		$fields->addFieldToTab("Root.Main", $fldMainImage = new UploadField('MainImage','Photo'), "Content");
		$fldMainImage->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		//$fldMainImage->getValidator()->setAllowedFileCategories("image");
		$fldMainImage->setFolderName('Uploads/team');
		$fldMainImage->getValidator()->setAllowedMaxFileSize(52428800);

		$oTagRegions = $this->getAllTags("TagRegion");
		$fields->addFieldToTab("Root.Tags", new CheckboxSetField('TagRegions','Select region(s)',$oTagRegions));

		$oTagTeams = $this->getAllTags("TagTeam");
		$fields->addFieldToTab("Root.Tags", new CheckboxSetField('TagTeams','Select team(s)',$oTagTeams));

		return $fields;
	}
	
	public function getNameForDropdown(){
		return $this->Surname.", ".$this->FirstName;	
	}
	
	public function getTagList($tagname = NULL, $separator = ","){

		if(!class_exists($tagname)) return false;
		
		$tagnamePlural = $tagname."s";
		
		$oTags = $this->$tagnamePlural();
		
		return implode($separator, $oTags->column("Name"));
		
	}
	
}

class TeamMemberPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	public function getAllOffices(){
		
		$filter = array();
		$filter["PageID"] = $this->ID;
		
		$oOffices = Office::get()->filter($filter)->sort("SortOrder ASC");
		
		return $oOffices;
	}
	
}