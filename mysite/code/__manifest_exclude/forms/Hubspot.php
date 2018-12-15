<?php

//use this class to manage all Hubspot related actions

class Hubspot extends Page {
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);
	
	function canDelete($member = NULL) {
		return true;
	}   

	function canCreate($member = NULL) {
		return false;
	} 
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}
	
	static $hubspot_enabled = false;
	static $hubspot_oid = "";

	public static function setHubspotEnabled($state = false) {
		self::$hubspot_enabled = $state;
	}

	public static function getHubspotEnabled() {
		return self::$hubspot_enabled;
	}	
	
	public static function setHubspotPortalID($oid = NULL) {
		self::$hubspot_oid = $oid;
	}

	public static function getHubspotPortalID() {
		return self::$hubspot_oid;
	}		
	
	
	public static $HSFieldMapping = array(
		//SilverStripe form field => Hubspot field
		"Salutation" 	=> "title",
		"FirstName" 	=> "first_name",
		"Surname" 		=> "last_name",
		"Phone" 		=> "phone",
		"Email" 		=> "email",
		"JobTitle" 		=> "jobtitle",
		"Industry"		=> "industry",
		"Company" 		=> "company",
		"Newsletter" 	=> "newsletter",
		"Message" 		=> "OnlineEnquiry", //"decription",
		"Website" 		=> "URL",
		"LeadSource" 	=> "lead_source",
		"Activity" 		=> "activityUNUSED"
	);
	
	//convert an object into an array of fields to post to SalesForce
	public function HubspotProcessObject($object) {

		$aHSFieldMapping = Hubspot::$HSFieldMapping;

		$fields = array();

		//set POST variables
		foreach($aHSFieldMapping as $key => $value){
			$fields[$key] = $object->{$key};
		}		
		
		HubSpot::HSProcessForm($fields);
		
	}
	
	public function HSProcessForm(array $fields, $formGuid = NULL) {

		//Documentation: http://developers.hubspot.com/docs/methods/forms/submit_form
		
		if(Director::isDev()){
			Hubspot::setHubspotPortalID("335435"); // NOT CURRENTLY 7dots account id
		}else{
			Hubspot::setHubspotPortalID(Page::getSiteConfig("HubspotPortalID"));
		}
		if(!$portalId = Hubspot::getHubspotPortalID()) return false;
		
		if(!$formGuid){
			$formGuid = Page::getSiteConfig("HubspotFormID");
		}
		if(!$formGuid) return false;
	
		//$formGuid = "9cc7b13b-91e2-4923-9beb-7c6a90ac82a8";

		$url = 'https://forms.hubspot.com/uploads/form/v2/'.$portalId.'/'.$formGuid;		

		if(isset($_COOKIE['hubspotutk'])){
			$hubspotutk = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
		}else{
			$hubspotutk = "";			
		}

		$hs_context = array(
			'hutk' => $hubspotutk,
			'ipAddress' => $_SERVER['REMOTE_ADDR'],
			//'pageUrl' => 'http://www.example.com/form-page',
			//'pageName' => 'Example Title'
			//'redirectUrl'
		);
		$hs_context_json = json_encode($hs_context);
		
		$aSFFieldMapping = Hubspot::$HSFieldMapping;

		//set POST variables
		foreach($fields as $key => $value){
			if(array_key_exists($key, $aSFFieldMapping)){
				$aFieldsToSend[] = $aSFFieldMapping[$key]."=".urlencode($value);
			}
		}
		
		$aFieldsToSend[] = urlencode($hs_context_json);
		
		$sFieldsToSend = implode("&", $aFieldsToSend);

		//open connection
		$ch = curl_init();

		@curl_setopt($ch, CURLOPT_POST, true);
		@curl_setopt($ch, CURLOPT_POSTFIELDS, $sFieldsToSend);
		@curl_setopt($ch, CURLOPT_URL, $url);
		@curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = @curl_exec($ch);  //Log the response from HubSpot as needed.
		$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
		@curl_close($ch);
			
		$oHubspotLead = new HubspotLead();
		$oHubspotLead->PostFields = $sFieldsToSend;
		$oHubspotLead->SerializedResponse = serialize($response);
		$oHubspotLead->StatusCode = $status_code;
		$oHubspotLead->write();
		
	}		
	
}

class Hubspot_Controller extends Page_Controller {

	private static $allowed_actions = array (
		/**
		* array (
		*     'action', // anyone can access this action
		*     'action' => true, // same as above
		*     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
		*     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
		* );	
		**/
		'testsubmission' => 'ADMIN', // you must have ADMIN permissions to access this action

	);

	public function init() {
		parent::init();
	}
	
	public function index() {
		return $this->httpError(404);
	}
	
	public function testsubmission() {
		$fields = array(
			"Salutation" 	=> "Mr",
			"FirstName" 	=> "Test",
			"Surname" 		=> "McTest",		
			"Email" 		=> "test1@7dots.co.uk"
		);
		singleton("Hubspot")->HSProcessForm($fields);
	}	
}


class HubspotLead extends DataObject
{
	static $db = array (
		"PostFields" => "Text",
		"SerializedResponse" => "Text",
		"StatusCode" => "Text",
	);

	static $has_one = array (
	);
	
	public function getCMSFields_forPopup()
	{
		
		return new FieldSet(
			new TextField("PostFields")
		);
	}
	
}