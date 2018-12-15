<?php 
class TrackedGuest extends DataObject
{
	private static $db = array (
	
		'Salutation' => 'Varchar(255)',
		'FirstName' => 'Varchar(255)',
		'Surname' => 'Varchar(255)',
		'Email' => 'Varchar(255)',
		'Phone' => 'Varchar(255)',
		'JobTitle' => 'Text',
		'Company' => 'Varchar(255)',		
		'Industry' => 'Varchar(255)',				
		'Website' => 'Varchar(255)',	
		'Newsletter' => 'Boolean',	
		'LeadSourceCurrent' => 'Text',	
		'LeadSourceHistory' => 'Text',				
	);
	
	private static $has_one = array (
		"Subsite"		=> "Subsite" //this is the one they are on when first tracked
		//"MemberFile" => "File",
	);
	
	//File::$allowed_extensions[] = "psd";
	
	public function getCMSFields_forPopup()
	{
		
		return new FieldSet(
			//new TextField("Name"),
			new TextField("FirstName"),
			new TextField("Surname"),
			new TextField("Email"),
			new TextField("Company")
		);
	}
	
	static $default_sort = "Created Desc";	
	
	//used in ModelAdmin (for search) - see BookingAdmin class
	static $searchable_fields = array(
		'ID',										 
		//'Created',
        "Surname" => array(
             "field" => "TextField",
             "filter" => "PartialMatchFilter",
             "title" => "Last name"
		),		
		'Email'
	);
	
	//used in ModelAdmin (list display)
	static $summary_fields = array(
		'ID',										 
		'Created',
		'FirstName',
		'Surname',
		'Email',
		
		'Phone',
		'Newsletter',				
		'JobTitle',	
		'Company',
		'Industry',		
		'getUserEventsReport',
		'Created',
		'LastVisited',
		'NumVisit'			
		
	);	
	
	public function getUserEventsReport(){
		
		return singleton("TrackedEvent")->getTrackedEventsForReport(NULL, NULL, $this->ID);
		
	}	
	
}