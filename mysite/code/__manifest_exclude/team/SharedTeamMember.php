<?php
class SharedTeamMember extends DataObject {
	
	static $db = array (
		"SortOrder" => "Int" //only do this if it is in has_one relationship with the page (not a has_many)
	);
	
	static $has_one = array (
		"TeamModule" => "TeamModule",
		"TeamMemberPage" => "TeamMemberPage",
	);
	
	static $defaults = array(
		
	);
	
	function getCMSFields(){ //getCMSFields_forPopup() deprecated in SS3
	
		$oTeamMembers = TeamMemberPage::get()->sort("Surname");
	
		return new FieldList(
			new DropdownField("TeamMemberPageID", "Select team member", $oTeamMembers->map("ID", "getNameForDropdown"))
		);
	}	
	
	function Thumbnail() {
		if ($oImage = $this->MainImage()) {
			return $oImage->CMSThumbnail();
		} else {
			return NULL;
		}
	}	
	
}