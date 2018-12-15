<?php
class NewsPage extends Page {
	
	static $icon = 'mysite/images/icons/news';	
	static $singular_name = "News article";
   	static $plural_name = "News articles" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	public static $db = array(
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

		$fields->removeByName('Banners');

		$fields->addFieldToTab("Root.Main", $fldPubDate = new DateField("PubDate", "Publication date"), "Content");
		$fldPubDate->setConfig('showcalendar', true);

		$fields->addFieldToTab("Root.Main", $fldShortDesc = new TextAreaField("ShortDescription", "Short description"), "Content");	
		$fldShortDesc->setRows(5);
		
		$fields->addFieldToTab("Root.Images", $fldMainImage = new UploadField('MainImage', 'Main image'));
		//$fldMainImage->allowedExtensions(array('jpg', 'png', 'gif'));
		$fldMainImage->setAllowedFileCategories("image"); //"doc"
		$fldMainImage->setFolderName('Uploads/news');
		$fldMainImage->getValidator()->setAllowedMaxFileSize(52428800);	
		$fields->addFieldToTab("Root.Images", $fldMainImage);

		return $fields;
	}
	
	public function getOtherNews($limit = NULL) {

		$where = array();

		$where[] = "`SiteTree`.`ID` <> ".$this->ID;
		
		$where = implode(" AND ", $where);

		$oNewsPages = NewsPage::get()->where($where)->sort(array("PubDate" => "DESC"))->limit($limit);
		
		return $oNewsPages;
	}	
	
}

class NewsPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
}