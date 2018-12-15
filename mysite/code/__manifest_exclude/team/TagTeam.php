<?php
class TagTeam extends DataObject {
	static $db = array(
		"Name" => "Text",
		"SortOrder" => "Int" //only do this if it is in has_one relationship with the page (not a has_many)
	);
	
	static $has_one = array (
		"Page" => "TeamListPage",
	);
	
	static $belongs_many_many = array(
		"TeamMemberPages" => "TeamMemberPage"
	);
	
	public static $default_sort = 'Name ASC';
	
	function getCMSFields(){ //getCMSFields_forPopup() deprecated in SS3
		return new FieldList(
			new TextField("Name", "Name of team")
		);
	}
	
	function Thumbnail() {
		$Image = $this->Icon();
		if ( $Image ) {
			return $Image->CMSThumbnail();
		} else {
			return null;
		}
	}		
}