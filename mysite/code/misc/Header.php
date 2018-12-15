<?php
class Header extends Page {
	
	static $icon = 'mysite/images/icons/header';	
	
	private static $db = array(
		//"TwitterURL" => "URL",
		//"LinkedInURL" => "URL",
		//"GooglePlusURL" => "URL",
		//"YouTubeURL" => "URL",
		//"SlideShareURL" => "URL"
		//"FacebookURL" => "URL",
	);

	private static $has_one = array(
		
	);
	
	static $defaults = array (
		'ShowInMenus' => false,
		'ShowInSearch' => false
	);		
	
	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}   

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		return !(Footer::get()->Count() > 0);
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldFromTab('Root.Main','Content');
		$fields->removeByName('Banners');

		//$fields->addFieldToTab("Root.Social", new URLField('TwitterURL','Twitter URL (include http://)'));
		//$fields->addFieldToTab("Root.Social", new URLField('LinkedInURL','LinkedIn URL (include http://)'));
		//$fields->addFieldToTab("Root.Social", new URLField('GooglePlusURL','Google Plus URL (include http://)'));
		//$fields->addFieldToTab("Root.Social", new URLField('YouTubeURL','YouTube URL (include http://)'));
		//$fields->addFieldToTab("Root.Social", new URLField('FacebookURL','Facebook URL (include http://)'));
		//$fields->addFieldToTab("Root.Social", new URLField('SlideShareURL','SlideShare URL (include http://)'));

		return $fields;
	}
	
	public function onAfterWrite() {
		if(count($this->Children()) > 0){
			$i = 1;
			foreach($this->Children() as $child){ //assuming we'll get them in order
				$child->Sort = $i;
				$child->write();
				$i++;	
			}
				
		}		
		parent::onAfterWrite();
	}	
	
}

class Header_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}