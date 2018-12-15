<?php
class TeamListPage extends Page {
	
	static $icon = 'mysite/images/icons/staffholder';	
	static $singular_name = "Team list";
   	static $plural_name = "Team lists" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	private static $db = array(
		
	);

	private static $has_one = array(
		
	);
	
	private static $has_many = array(
		"TagRegions" 		=> "TagRegion",
		"TagTeams" 		=> "TagTeam",		
	);
	
	function canDelete($member = NULL) {
		return false;
	}   

	function canCreate($member = NULL) {
		return !(TeamListPage::get()->Count() > 0);
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"Name" => "Name"
			)
		);		
		$gfConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableRows('SortOrder'),
			new GridFieldSortableHeader(),
			$gfColumns, //new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		);
			
		$fldTagRegions = new GridField("TagRegions", "Region Tags:", $this->TagRegions(), $gfConfig);
		$fields->addFieldToTab("Root.ManageTags", $fldTagRegions);


		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"Name" => "Name"
			)
		);		
		$gfConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableRows('SortOrder'),
			new GridFieldSortableHeader(),
			$gfColumns, //new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		);
			
		$fldTagTeams = new GridField("TagTeams", "Team Tags:", $this->TagTeams(), $gfConfig);
		$fields->addFieldToTab("Root.ManageTags", $fldTagTeams);
		
		return $fields;
	}
	
}

class TeamListPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	public function index() {
		return $this;
	}	

	static $perPage = 40;
	
	static $sortBy = "Surname ASC";		

	//7dots:: set this in _config => GalleryPage_Controller::setPerPage(10);
	public static function setPerPage($iCount = 10) {
		self::$perPage = $iCount;
	}

	public static function getPerPage() {
		return self::$perPage;
	}
	
	//7dots:: set this in _config => GalleryPage_Controller::setSortBy("KB_CreateDate ASC");
	public static function setSortBy($sort = "Created ASC") {
		self::$sortBy = $sort;
	}

	public static function getSortBy() {
		return self::$sortBy;
	}	

	function getTeamListRendered(){

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
			switch($sortby){
				case("recent"):
					$sort = "Created DESC";
					break;	
				case("popular"):
					$sort = "VoteCount DESC, Created ASC";
					break;	
			}
		}
		if(!isset($sort)) $sort = $this->getSortBy();
		
		$join = "";
		$filter = array();
		$filterDesc = array();

		$data = array();
	
		$searchtext = "";
		$where = "";
		if($searchtext = $this->getSearchText()){
			//full text search
			$where = "MATCH (`FirstName`,`Surname`,`JobTitle`) AGAINST ('$searchtext')"; //matches any words				
			//$filter[] = "MATCH (`Title`,`Description`,`Location`) AGAINST ('\"$searchtext\"' IN BOOLEAN MODE)"; //exact match
			$filterDesc[] = "matching search term <strong>".$searchtext."</strong>";
			$data["SearchText"] = $searchtext;
		}

		if(isset($_REQUEST["region"]) && is_numeric($_REQUEST["region"])){
			$filter["TeamMemberPage_TagRegions.TagRegionID"] = $_REQUEST["region"];
		}
		
		if(isset($_REQUEST["team"]) && is_numeric($_REQUEST["team"])){
			$filter["TeamMemberPage_TagTeams.TagTeamID"] = $_REQUEST["team"];
		}		
		
		//$oDocs  = UploadedImage::get()->Filter($filter)->Where($where)->Sort($sort)->Limit($limit);
		//$oDocs  = new PaginatedList(TeamMemberPage::get()->Filter($filter)->Where($where)->Sort($sort), $this->request);
		$oDocs  = new PaginatedList(TeamMemberPage::get()->Filter($filter)
									->Where($where)->Sort($sort)
									->leftJoin("TeamMemberPage_TagRegions", "`TeamMemberPage`.`ID` = `TeamMemberPage_TagRegions`.`TeamMemberPageID`")
									->leftJoin("TeamMemberPage_TagTeams", "`TeamMemberPage`.`ID` = `TeamMemberPage_TagTeams`.`TeamMemberPageID`")
									, $this->request);
		$oDocsAll = $oDocs; //use this to get data for dropdown
		$oDocs->setPageLength($this->getPerPage());
		//$oDocs->setPageStart($start);
		//$oDocs->setLimitItems(0);

		$data['Docs'] = $oDocs;

		return $this->customise($data)->renderWith('TeamListPageResults');
				
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
	
	public function getTeamsDropdown(){
		$oTagTeams = $this->getAllTags("TagTeam");
		if(!$selectedValue = $this->getSelectedFilterValue("team")){
			//$selectedValue = "popular"; //most popular is default
		}
		$mapTagTeams = $oTagTeams->map('ID','Name');
		$oField = new DropdownField('team','Team', $mapTagTeams, $selectedValue);
		$oField->SetEmptyString("--all teams --");
		return $oField;
	}	
	
	public function getRegionsDropdown(){
		$oTagRegions = $this->getAllTags("TagRegion");
		if(!$selectedValue = $this->getSelectedFilterValue("region")){
			//$selectedValue = "popular"; //most popular is default
		}
		$mapTagRegions = $oTagRegions->map('ID','Name');
		$oField = new DropdownField('region','Region', $mapTagRegions, $selectedValue);
		$oField->SetEmptyString("-- all regions --");
		return $oField;
	}		
		
	
	function getSelectedFilterValue($queryelement = ""){
		if($queryelement){
			if(isset($_REQUEST[$queryelement]) && $_REQUEST[$queryelement] != ""){
				return $_REQUEST[$queryelement];
			}
		}
	}	
	
}