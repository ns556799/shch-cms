<?php
class EventListPage extends Page {
	
	static $icon = 'mysite/images/icons/calendar';
	static $singular_name = "Events list";
   	static $plural_name = "Events lists";
	static $description = '';
	static $default_child = "CmsFolder";
	
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
		return true; //!(EventListPage::get()->Count() > 0);
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}

	public function getEvents($limit = NULL){

		$filter = array(
			//'ParentID' => $this->ID,
		);
		$oEventPages = EventPage::get()->filter($filter)->sort(array("EventStartDate" => "DESC"))->limit($limit);
		return $oEventPages;

	}	
	
	
}

class EventListPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	static $perPage = 20;
	
	//7dots:: set this in _config => GalleryPage_Controller::setPerPage(10);
	public static function setPerPage($iCount = 10) {
		self::$perPage = $iCount;
	}

	public static function getPerPage() {
		return self::$perPage;
	}	

	public function getEventsPaginated() {

		if(!$oEventPages = $this->getEvents()) return false;

		$oPaginatedList  = new PaginatedList($oEventPages, $this->request); //turn it into a paginated list		
		$oPaginatedList->setPageLength($this->getPerPage());
		return $oPaginatedList;

	}	

}