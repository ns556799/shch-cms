<?php
class EventPage extends Page {
	
	static $icon = 'mysite/images/icons/event';	
	static $singular_name = "Event";
   	static $plural_name = "Events" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	public static $db = array(
		"EventStartDate" => "Date",
		"EventEndDate" => "Date",
		"EventTime" => "Varchar(255)",
		"EventDateManual" => "Varchar(255)",
	);

	public static $has_one = array(
	);
	
	function canDelete($member = NULL) {
		return true;
	}   

	function canCreate($member = NULL) {
		return true;
	} 	
	
	static $defaults = array (
		'ShowInMenus' => false,
		'ShowInSearch' => true
	);		
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab("Root.Main", $fldEventStartDate = new DateField("EventStartDate", "Event start date"), "Content");
		$fldEventStartDate->setConfig('showcalendar', true);

		$fields->addFieldToTab("Root.Main", $fldEventEndDate = new DateField("EventEndDate", "Event end date"), "Content");
		$fldEventEndDate->setConfig('showcalendar', true);

		$fields->addFieldToTab("Root.Main", new TextField("EventTime", "Event times"), "Content");

		$fields->addFieldToTab("Root.Main", new TextField("EventDateManual", "Event dates - manual override"), "Content");

		$fields->addFieldToTab("Root.Main", $fldShortDesc = new TextAreaField("ShortDescription", "Short description"), "Content");	
		//$fldShortDesc->setRows(5);
		
		return $fields;
	}
	
	//set the modular page parent for ease of reference
	function onBeforeWrite(){
		parent::onBeforeWrite();
		$this->PubDate = $this->EventStartDate; //for consistency with other activity pages
	}		
	
	function DateRange() {
		
		if($this->EventDateManual) return $this->EventDateManual;
		
		$start = new Date();
		$start->setValue($this->EventStartDate);
	
		if (!is_null($this->EventEndDate)) { // Check if there is an end date
		   $end = new Date();
		   $end->setValue($this->EventEndDate);
		   return $start->RangeString($end);
		} else {
		   return $start->Long();
		}
	}
	
	public function getOtherEvents($limit = NULL) {

		$where = array();

		$where[] = "`SiteTree`.`ID` <> ".$this->ID;
		
		$where = implode(" AND ", $where);

		$oEventPages = EventPage::get()->where($where)->sort(array("PubDate" => "DESC"))->limit($limit);
		
		return $oEventPages;
	}		
		
}

class EventPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}