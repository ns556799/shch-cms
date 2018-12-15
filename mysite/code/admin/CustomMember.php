<?php
class CustomMember extends DataExtension{
	
	private static $db = array(
		"Company" => "Varchar",
		"ScreenName" => "Varchar"
	);

	private static $has_one = array(
	);	
	
	public function getScreenNameForMember(){
		//return $this->owner->FirstName." ".$this->owner->Surname."-McSomthing";	
		if($this->owner->ScreenName){
			return $this->owner->ScreenName;
		}else{
			return $this->owner->FirstName." ".$this->owner->Surname;
		}
	}
	
}