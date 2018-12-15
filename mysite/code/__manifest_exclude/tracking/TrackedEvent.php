<?php 
class TrackedEvent extends DataObject
{
	private static $db = array (
		"FirstName" => "Text",
		"Surname" => "Text",
		"Email" => "Text",
		"Action" => "Text", //download, contact request, webinar signup
		"Details" => "Text",
		"PageURL" => "Text",		
		"FileName" => "Text", //store in case the download is deleted		
		"IP" => "Text",
		"SerializedData" => "Text"
	);
	
	private static $has_one = array (
		"Download" 		=> "File", 			//store the download, e.g. whitepaper
		"Page" 			=> "Page", 			//store the page where the action was completed
		"Member" 		=> "Member",		//registered user id
		"TrackedGuest" 	=> "TrackedGuest",	//guest user id
	);
	
	public function getCMSFields_forPopup()
	{
		return new FieldSet(
			new TextField("TrackedDownload")
		);
	}
	
	public function getTrackedEventsForReport($type = NULL, $memberID = NULL, $guestID){
		
		$where = array();
		if($memberID && is_numeric($memberID)){
			$where[] = "`MemberID` = ".$memberID;	
		}elseif($guestID && is_numeric($guestID)){
			$where[] = "`TrackedGuestID` = ".$guestID;	
		}
		
		$where = implode(" AND ", $where);
		
		if($oEvents = TrackedEvent::get()->where($where)->sort(array("Created" => "DESC"))){ //, $sort = "`TrackedEvent`.`Created` DESC")){
		//if($eventsDOS = DataObject::get("TrackedEvent", $filter, $sort = "`TrackedEvent`.`Created` DESC")){
			$aEvents = array();
			foreach($oEvents as $oEvent){
				switch($oEvent->Action){
					case "Newsletter subscription" :
						$aEvents[] = $oEvent->Created ." : newsletter";
						break;
					case "Contact request" :
						$aEvents[] = $oEvent->Created ." : contact request : ".$oEvent->Details;
						break;
					case "Download whitepaper" :
						$aEvents[] = $oEvent->Created ." : whitepaper : ".$oEvent->Details;
						break;						
					
				}
					//$Events[] = $eventsDO->Action.": ".$eventsDO->FileName;
					//$Downloads[] = $DownloadsDO->TrackedDownload()->TrackedFile()->Filename." (".$DownloadsDO->Created.")";
			}
			return implode("<br/>\n ",$aEvents);
			
		}
	}	
	
}