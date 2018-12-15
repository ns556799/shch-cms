<?php
class NewsListPage extends Page {
	
	static $icon = 'mysite/images/icons/newslist';
	static $singular_name = "News list";
   	static $plural_name = "News lists";
	static $description = '';
	static $default_child = "CmsFolder";
	
	public static $db = array(
		"ShowArchive" => "Boolean"
	);

	public static $has_one = array(
		
	);
	
	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}   

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		return true; //!(NewsListPage::get()->Count() > 0);
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab("Root.Main", new CheckboxField('ShowArchive','Show news archive links?'), "Content");
		
		return $fields;
	}

	public function getNews($limit = NULL) {

		$filter = array(
			//'ParentID' => $this->ID,
		);

		$oNewsPages = NewsPage::get()->filter($filter)->sort(array("PubDate" => "DESC"))->limit($limit);
		
		return $oNewsPages;
	}
	
}

class NewsListPage_Controller extends Page_Controller {

	private static $allowed_actions = array (
		'archive'
	);
	
	public function init() {
		parent::init();
	}
	
	static $perPage = 20;
	
	//7dots:: set this in _config => NewsListPage_Controller::setPerPage(10);
	public static function setPerPage($iCount = 10) {
		self::$perPage = $iCount;
	}

	public static function getPerPage() {
		return self::$perPage;
	}	

	public function getNewsPaginated() {

		if(!$oNewsPages = $this->getNews()) return false;

		$filterHeading = "";

		if($this->ShowArchive){
			//get an array of years
			$aYears = array();
			foreach($oNewsPages as $oNewsPage){
				$aYears[] = array(
									"Year" => $oNewsPage->obj("PubDate")->format("Y"),
									"Link" => $this->Link()."archive/".$oNewsPage->obj("PubDate")->format("Y")
								);
			}
			
			$oYears = new ArrayList($aYears);
			$oYears->removeDuplicates("Year");
			
			if($this->request->param("Action") == "archive" && is_numeric($this->request->param("ID"))){
				$year = $this->request->param("ID");
				$oNewsPages = $oNewsPages->where("YEAR(`PubDate`) = ".$year);
				$filterHeading = "<h2>Viewing news from ".$year ."</h2>";
			}
		}

		$oPaginatedList  = new PaginatedList($oNewsPages, $this->request); //turn it into a paginated list		
		$oPaginatedList->setPageLength($this->getPerPage());
		$oPaginatedList->Years = $oYears;
		if($filterHeading) $oPaginatedList->filterHeading = $filterHeading;
		return $oPaginatedList;

	}
	
}