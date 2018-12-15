<?php
class WhitepaperListPage extends Page {
	
	static $icon = 'mysite/images/icons/documentlist';	
	static $singular_name = "Whitepaper list page";
   	static $plural_name = "Whitepaper list pages" ;
	//static $description = 'The default page';
	static $allowed_children = array("WhitepaperPage"); //"none";
	static $default_child = "WhitepaperPage";
	
	public static $db = array(
		
	);

	public static $has_one = array(
		
	);
	
	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}   

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		return !(WhitepaperListPage::get()->Count() > 0);
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}

	public function getWhitepapers($limit = NULL) {

		$filter = array(
			//'ParentID' => $this->ID,
		);

		$oWhitepaperPages = WhitepaperPage::get()->filter($filter)->sort(array("PubDate" => "DESC"))->limit($limit);
		
		return $oWhitepaperPages;
	}
	
}

class WhitepaperListPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	static $perPage = 4;
	
	//7dots:: set this in _config => GalleryPage_Controller::setPerPage(10);
	public static function setPerPage($iCount = 10) {
		self::$perPage = $iCount;
	}

	public static function getPerPage() {
		return self::$perPage;
	}	

	public function getWhitepapersPaginated() {

		if(!$oWhitepaperPages = $this->getWhitepapers()) return false;

		$oPaginatedList  = new PaginatedList($oWhitepaperPages, $this->request); //turn it into a paginated list		
		$oPaginatedList->setPageLength($this->getPerPage());
		return $oPaginatedList;

	}
	
}