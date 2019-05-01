<?php
class TeamPage extends Page {

	static $icon = 'mysite/images/icons/mainleft';
	static $singular_name = "Team page";
   	static $plural_name = "Team pages" ;
	static $description = 'Team page';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";


	private static $db = array(

	);

	private static $has_one = array(
		"MainImage" => 'Image'

	);

	private static $has_many = array(
		"TeamMembers" => "TeamMember"
	);

	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		return true;
	}

	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName(['Banners', 'OtherImages']);
		$fields->addFieldToTab('Root.HeroBanner', new UploadField('MainImage', 'Hero Banner'));
		$fields->addFieldToTab('Root.TeamMembers', new GridField("TeamMembers", "Team Members:", $this->TeamMembers(), Page::gridConfig()));

		return $fields;
	}

}

class TeamPage_Controller extends Page_Controller {

	public function init() {
		parent::init();
	}
}
