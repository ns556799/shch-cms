<?php

require_once 'XmlLoader.php';

// Google site search documentation
// http://code.google.com/intl/en/apis/customsearch/docs/xml_results.html

class GoogleSearch extends Page {

	function canDelete($member = NULL) {
		return false;
	}   

	function canCreate($member = NULL) {
		return false;
	} 	

	static $perpage = 10;
	static $useJS = true;

	function GoogleSearchForm() {

		$config = SiteConfig::current_site_config();
		if(!$config->GoogleSiteSearchID) return;
		
		$input = array_merge($_GET, $_POST);
		$query = "";
		if(isset($input['q'])) $query = $input['q'];
		$fields = new FieldList(
			$thequery = new TextField("q", "", $query)
		);
		
		//$thequery->setAttribute('placeholder', 'What are you looking for');
		
		$actions = new FieldList(
			new FormAction('searchresults', 'search')
		);
		
		//$form = new SearchForm($this, "searchresults", $fields, $actions);
		//$form = new SearchForm(Controller::curr(), "searchresults", $fields, $actions);
		$form = new SearchForm(Controller::curr(), "searchresults", $fields, $actions);
		
		return $form;
	
	}

	function getGoogleSearchResultsJS(){
		$config = SiteConfig::current_site_config();
		if(!$cx = $config->GoogleSiteSearchID) return;		
		
		$data = array();
		if(isset($_GET['q']) & $_GET['q'] != ""){
			$data["SearchQuery"] = "for <em>".$_GET['q']."</em>";
		}else{
			$data["SearchQuery"] = "Please enter a search term";
		}
		$data["cx"] = $cx;
		
		//give it a context
		//$oHomePage = HomePage::get()->First();
		
		return $this->customise($data)->renderWith(array('GoogleSearchJS','Page'));
	}

	function getGoogleSearchResultsRendered(){
		//$data = array();
		if($data = GoogleSearch::GetGoogleSearchResults()){

			return $this->customise($data)->renderWith(array('GoogleSearch','Page'));
			
		}else{
			
		}
	}

	function GetGoogleSearchResults() {


		$config = SiteConfig::current_site_config();
		if($GoogleSearchId = $config->GoogleSiteSearchID){		
		
			$data = array();
			
			$input = array_merge($_GET, $_POST);
			$page = isset($input['p']) ? $input['p'] : '1';
			$query = isset($input['q']) ? $input['q'] : '';
			
			$data['SearchString'] = $query;
			
			$perPage = self::$perpage;
			if ($page < 1) { $page = 1; }
			$xml = GoogleSearch::getGoogleSearchResultsXML($GoogleSearchId, $perPage, $page, $query);
			$results = "";
			if($xml){
				$results = GoogleSearch::parseGoogleSearchResults($xml);
				$totalResults = GoogleSearch::getResultCount($xml);
			}
			
			//7dots:: no need to format in here...
			//$output .= $this->getFormattedResults($results);
			if($results){
				$Docs = new DataObjectSet(); 
				foreach($results as $result) {
					$record = array(
						'Title' => $result['title'],
						'URL' => $result['url'],					
						'Description' => $result['desc'],
					);				
					$Docs->push( new ArrayData($record) );
				} 
				$data['Docs'] = $Docs;
				$data['TotalResults'] = (int)$totalResults;
				$data['Pagination'] = GoogleSearch::getPagingForResults($totalResults, $query, $perPage, $page);
			}else{
				$data['TotalResults'] = 0;
				$data['NoResults'] = $config->GoogleSiteSearchNoResultsMessage;
			}
			return $data;

	/*
			if (count($results) == 0) {
				// Show no results message
				$output .= $this->NoResults;;
			} else {
				// Append paging
				$output .= $this->getPagingForResults($totalResults, $query, $perPage, $page);
			}
	*/		
		}

		
	}


	private function getGoogleSearchResultsXML($googleId, $perPage, $page, $query) {
	
		$startingRecord = ($page - 1) * $perPage;
		
		$url = "http://www.google.com/search";
		$parameters = array();
		$parameters["client"] = "google-csbe";
		$parameters["output"] = "xml_no_dtd";
		$parameters["num"] = $perPage;
		$parameters["cx"] = $googleId;
		$parameters["start"] = $startingRecord;
		$parameters["q"] = $query;
		
		$XmlLoader = new XmlLoader();
		return $XmlLoader->pullXml($url, $parameters, true);
	
	}

	private function parseGoogleSearchResults($xml) {
	
		$results = array();
		
		$attr["title"] = $xml->xpath("/GSP/RES/R/T");
		$attr["url"] = $xml->xpath("/GSP/RES/R/U");
		$attr["desc"] = $xml->xpath("/GSP/RES/R/S");
		
		foreach($attr as $key => $attribute) {
			$i = 0;
			foreach($attribute as $element) {
				$results[$i][$key] = (string)$element;
				$i++;
			}
		}
		return $results;
	}

	private function getFormattedResults($results) {
	
		$output = "";
		
		if (count($results) > 0) {
			$output .= "<ul class=\"results\">";
			foreach($results as $i => $result) {
				$title = "";
				$url = "";
				$desc = "";
				foreach($result as $key => $value) {
					if ($key == "title") {
						$title = $value;
					}
					if ($key == "url") {
						$url = $value;
					}
					if ($key == "desc") {
						$desc = $value;
					}
				
					$output .= "<li><a href=\"$url\">$title</a><p>";
					$output .= str_replace("<br>", "<br/>", $desc);
					$output .= "</p></li>\n";
				}
			}
			$output .= "</ul>";
		}
		return $output;
	}

	private function getResultCount($xml) {
		$totalResults = 0;
		$count = $xml->xpath("/GSP/RES/M");
		foreach($count as $value) {
			$totalResults = $value;
		}
		return $totalResults;
	}

	private function getPagingForResults($totalResults, $query, $perPage, $page) {
		$maxPage = ceil($totalResults/$perPage);
		$output = "";
		if ($totalResults > 1 && ($totalResults > $perPage) ) {
			
			$currentPageLink = Director::get_current_page()->Link();
			if($currentPageLink == "/") $currentPageLink = "/home/";
			$output .= '<td class="prev">';
			if($page > 1){
				$output .= '<a href="'.$currentPageLink.'searchresults?q='.$query.'&p='.($page-1).'" title="View the previous page">&larr; previous page</a>';
			}
			$output .= '</td>';			
			$output .= '<td class="numbers">';
			for($pageNum = 1; $pageNum <= $maxPage; $pageNum++) {
				if ($pageNum == $page) {
					$output .= '  <a href="#" class="current">'.$pageNum.'</a> ';
				} else {
					$output .= ' <a href="'.$currentPageLink.'searchresults?q='.$query.'&p='.$pageNum.'">'.$pageNum.'</a> ';
				}
			}
			$output .= '</td>';
			$output .= '<td class="next">';
			if($page < $maxPage){
				$output .= '<a href="'.$currentPageLink.'searchresults?q='.$query.'&p='.($page+1).'" title="View the next page">next page &rarr;</a>';
			}
			$output .= '</td>';				

			return $output;
		}
		
	}
	
	public function getMenu($level = 1) {
		if($level == 1) {
			$result = SiteTree::get()->filter(array(
				"ShowInMenus" => 1,
				"ParentID" => 0
			));

		} else {
			$parent = $this->data();
			$stack = array($parent);
			
			if($parent) {
				while($parent = $parent->Parent) {
					array_unshift($stack, $parent);
				}
			}
			
			if(isset($stack[$level-2])) $result = $stack[$level-2]->Children();
		}

		$visible = array();

		// Remove all entries the can not be viewed by the current user
		// We might need to create a show in menu permission
 		if(isset($result)) {
			foreach($result as $page) {
				if($page->canView()) {
					$visible[] = $page;
				}
			}
		}

		return new ArrayList($visible);
	}

	//function straight from ContentController. Not sure why this is needed, but menu does not show if not here.
	public function Menu($level) {
		return Controller::curr()->getMenu($level);
	}	
	
}

class GoogleSearch_Controller extends Page_Controller {
	
}