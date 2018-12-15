<?php 
class FormSubmission extends DataObject
{
	static $db = array (
		"Salutation" => "Text",
		"FirstName" => "Text",
		"Surname" => "Text",
		"Email" => "Text",
		"Phone" => "Text",
		"JobTitle" => "Text",
		"Company" => "Text",
		"Newsletter" => "Boolean",
		"Message" => "Text",

		"Product" => "Text",
		"Service" => "Text",
		"RequestType" => "Text",

		"PageID" => "Text",		
		"PageURL" => "Text",		
		"IP" => "Text",
		"SerializedData" => "Text"
	);
	
	static $has_one = array (
		//"Download" 		=> "File", 			//store the download, e.g. whitepaper
		"Page" 			=> "Page", 			//store the page where the action was completed
		//"Member" 		=> "Member",		//registered user id
		//"TrackedGuest" 	=> "TrackedGuest",	//guest user id
	);
	
	public function getCMSFields_forPopup()
	{
		
		return new FieldSet(
			//new TextField("TrackedDownload")
		);
	}
	
	public function getTrackedEventsForReport($type = NULL, $memberID = NULL, $guestID){
		
		$filter = array();
		if($memberID && is_numeric($memberID)){
			$filter[] = "`MemberID` = ".$memberID;	
		}elseif($guestID && is_numeric($guestID)){
			$filter[] = "`TrackedGuestID` = ".$guestID;	
		}
		
		$filter = implode(" AND ", $filter);
		
		if($eventsDOS = DataObject::get("TrackedEvent", $filter, $sort = "`Created` DESC")){
			$Events = array();
			foreach($eventsDOS as $eventsDO){
				switch($eventsDO->Action){
					case "Newsletter subscription" :
						$Events[] = $eventsDO->Created ." : newsletter";
						break;
					case "Contact request" :
						$Events[] = $eventsDO->Created ." : contact request : ".$eventsDO->Details;
						break;
					case "Download whitepaper" :
						$Events[] = $eventsDO->Created ." : whitepaper : ".$eventsDO->Details;
						break;						
					
				}
					//$Events[] = $eventsDO->Action.": ".$eventsDO->FileName;
					//$Downloads[] = $DownloadsDO->TrackedDownload()->TrackedFile()->Filename." (".$DownloadsDO->Created.")";
			}
			return implode("<br/>\n ",$Events);
			
		}
	}	
	
}