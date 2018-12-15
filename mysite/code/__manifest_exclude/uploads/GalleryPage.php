<?php
class GalleryPage extends Page {
	
	static $icon = 'mysite/images/icons/gallery';	
	//static $singular_name = "Page";
   	//static $plural_name = "Pages" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);
	
	function canDelete($member = NULL) {
		return true;
	}   

	function canCreate($member = NULL) {
		return !(GalleryPage::get()->Count() > 0);
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}
	
}

class GalleryPage_Controller extends Page_Controller {

	private static $allowed_actions = array (
		/**
		* array (
		*     'action', // anyone can access this action
		*     'action' => true, // same as above
		*     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
		*     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
		* );	
		**/
		'voteForm' => true, // anyone can access this action
		'voteFormProcess' => true, // same as above
		'iframe' => true,
		'viewimage' => true
	);	
	
	public function init() {
		parent::init();
	}
	
	public function index() {
		return $this;
	}	

	static $perPage = 6;
	
	static $sortBy = "popular";		

	//7dots:: set this in _config => GalleryPage_Controller::setPerPage(10);
	public static function setPerPage($iCount = 10) {
		self::$perPage = $iCount;
	}

	public static function getPerPage() {
		return self::$perPage;
	}
	
	//7dots:: set this in _config => GalleryPage_Controller::setSortBy("popular");
	public static function setSortBy($sort = "popular") {
		self::$sortBy = $sort;
	}

	public static function getSortBy() {
		return self::$sortBy;
	}	

	function getUploadedImagesRendered(){

		$start = 0;
		if(isset($_GET["start"])) {
			if(is_numeric($_GET["start"])){
				$start = $_GET["start"];
			}
		}

		//we're not providing this option at the moment
		if(isset($_REQUEST["perpage"]) && is_numeric($_REQUEST["perpage"])){
			if($_REQUEST["perpage"] <= 50){
				$this->setPerPage($_REQUEST["perpage"]);
			}
		}

		//$limit = "$start," . $this->getPerPage();
		
		if(isset($_REQUEST["sortby"]) && $_REQUEST["sortby"] != ""){
			$sortby = Convert::raw2sql($_REQUEST["sortby"]);
		}else{
			$sortby = $this->getSortBy();
		}
		switch($sortby){
			case("recent"):
				$sort = "Created DESC";
				break;	
			case("popular"):
				$sort = "VoteCount DESC, Created ASC";
				break;	
		}
		
		$join = "";
		$filter = array();
		$filterDesc = array();

		$data = array();
	
		$searchtext = "";
		if($searchtext = $this->getSearchText()){
			//full text search
			$where = "MATCH (`Title`,`Description`,`Location`) AGAINST ('$searchtext')"; //matches any words				
			//$filter[] = "MATCH (`Title`,`Description`,`Location`) AGAINST ('\"$searchtext\"' IN BOOLEAN MODE)"; //exact match
			$filterDesc[] = "matching search term <strong>".$searchtext."</strong>";
			$data["SearchText"] = $searchtext;
		}else{
			$where = "";
		}
		
		//approved only
		$filter["Approved"] = 1;


		if($oImages  = UploadedImage::get()->Filter($filter)->Where($where)->Sort($sort)){

			//use the data to store the leaderboard position - needs some sort of caching
			if($sortby == "popular"){
				$iterator = 0;
				foreach($oImages as $oImage){
					if($oImage->VoteCount == 0) break;
					$iterator++;
					$oImage->LeaderPos = $iterator;	
					$oImage->write();
				}
			}
			
			$oDocs  = new PaginatedList($oImages, $this->request); //turn it into a paginated list
			//$oDocs  = new PaginatedList(UploadedImage::get()->Filter($filter)->Where($where)->Sort($sort), $this->request);
			$oDocs->setPageLength($this->getPerPage());
			//$oDocs->setPageStart($start);
			//$oDocs->setLimitItems(0);
	
			$data['Docs'] = $oDocs;
		}

		return $this->customise($data)->renderWith('GalleryPageResults');
				
	}

	public function getSearchText(){
		if(isset($_REQUEST["SearchText"]) && $_REQUEST["SearchText"] != ""){
			return Convert::raw2sql($_REQUEST["SearchText"]);
		}
	}
	
	public function getPerPageFilterDropdown(){
		$pageArray = array("5" => "5", "10" => "10", "20" => "20", "50" => "50");
		if(!$selectedValue = $this->getSelectedFilterValue("perpage")){
			$selectedValue = $this->getPerPage();
		}
		$oField = new DropdownField('perpage','Results per page', $pageArray, $selectedValue);
		
		return $oField;
	}	
	
	public function getSortbyDropdown(){
		$valuesArray = array("popular" => "Most popular", "recent" => "Most recent");
		if(!$selectedValue = $this->getSelectedFilterValue("sortby")){
			$selectedValue = "popular"; //most popular is default
		}
		$oField = new DropdownField('sortby','Sort by', $valuesArray, $selectedValue);
		return $oField;
	}	
	
	function getSelectedFilterValue($queryelement = ""){
		if($queryelement){
			if(isset($_REQUEST[$queryelement]) && $_REQUEST[$queryelement] != ""){
				return $_REQUEST[$queryelement];
			}
		}
	}	
	
	function getUploadedImages($SortOrder = "leaderboard", $filter = array(), $limit = NULL){ 
		
		//always ensure approved
		$filter["Approved"] = 1;
		
		switch($SortOrder){
			case("leaderboard"):
				$sort = "VoteCount DESC, Created DESC"; //highest votes, then newest
				break;
			case("mostrecent"):
				$sort = "Created DESC";
			default:
				$sort = "";
		}
		
		//return UploadedImage::get()->Filter(array("Approved" => 1))->Sort($sort);
		return UploadedImage::get()->Filter($filter)->Sort($sort)->Limit($limit);
		
	}		
	
	public function iframe(){
		$data = array();

		//$data['iFrameContent'] = $this->Content;
		if(Session::get("voteFormSuccess")){
			$data['iFrameForm'] = Session::get("voteFormSuccess");
			Session::set("voteFormSuccess", "");
		}else{
			$data['iFrameForm'] = $this->getVoteFormForUser();
		}
		
		return $this->customise($data)->renderWith(array('iFrameContent'));		
	}	
	
	
	public function getVoteFormForUser(){
		
		//get the image id from the url - can't do this in form itself because of refleciton on submission
		if(!is_numeric($this->request->param("ID"))) return false;
		
		$idImage = $this->request->param("ID");
		
		//try to get the image for that ID - can't do this in form itself because of refleciton on submission
		if(!$oUploadedImage = UploadedImage::get()->byID($idImage)) return false;

		//check they haven't voted for this already - cookie
		//get the existing cookie and unserialize the data
		if($dataVotes = Cookie::get('votes')){
			$dataVotes = unserialize($dataVotes);
			if(in_array($idImage, $dataVotes)) return false;
		}				
		
		return $this->voteForm();
		
	}

	
	public function voteForm(){

		$idImage = $this->request->param("ID");
		
		$oUploadedImage = UploadedImage::get()->byID($idImage);
		
		//all good - show the form
		$fields = new FieldList(
		);	

		$fldUploadedImageID = new HiddenField("UploadedImageID", "UploadedImageID", $idImage);
		$fields->push($fldUploadedImageID);

		$required = new RequiredFields(

		);
			
		$actions = new FieldList(
			new FormAction("voteFormProcess", "Vote")
		);

		//revert to the standard Form for debugging
		$oForm = new Form($this, "voteForm", $fields, $actions, $required);
		//$formDetails->getValidator()->setJavascriptValidationHandler('none');
		
		return $oForm;			
	
	}		
	
	public function voteFormProcess(array $data, Form $form) {

		if(!isset($data['UploadedImageID']) && !is_numeric($data['UploadedImageID'])) return false;
		
		$idImage = $data['UploadedImageID'];
		
		//try to get the image for that ID
		if(!$oUploadedImage = UploadedImage::get()->byID($idImage)) return false;

		//get the existing cookie and unserialize the data
		if($dataVotes = Cookie::get('votes')){
			$dataVotes = unserialize($dataVotes); //should now be an array?
		}else{
			$dataVotes[0]  = session_id(); //set initial key as the current session id
		}
		$dataVotes[] = $idImage;
		
		Cookie::set('votes',serialize($dataVotes));
		
		$oGalleryVote = new GalleryVote();
		$form->saveInto($oGalleryVote);
		
		//7dots:: server settings may mean the alternative needs to be used
		//$oGalleryVote->IP = $_SERVER['REMOTE_ADDR'];
		$oGalleryVote->IP = Controller::curr()->getRequest()->getIP();
		$oGalleryVote->Cookie = $dataVotes[0];
		$oGalleryVote->write();		
		
		$oUploadedImage->updateVoteCount();

		//check if called from a "real" page
		if($this->ID > 0){
			//$form->sessionMessage('Thanks for getting in touch. We will respond shortly.'.$pixel, 'success');
			Session::set("voteFormSuccess", "<p>Thanks for voting!</p>"); 
			return Controller::curr()->redirectBack();
		}else{
			return "<p>Thanks for voting!</p>";
		}

	}		
	
	public function viewimage(){
		if(is_numeric($this->request->param("ID"))){
			
			if($oUploadedImage = UploadedImage::get()->byID($this->request->param("ID"))){
				$data["UploadedImage"] = $oUploadedImage;
				
				return $this->customise($data)->renderWith(array('GalleryImagePage','Page'));	
			}
		}
		
		//fall back to main page if there is an issue
		return $this->index();
	}	
	
}