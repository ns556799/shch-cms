<?php

//refer to BrokenLinksReport

class UserReport extends SS_Report {

	public function title() {
		return "User reporting";
	}
	
    public function sourceRecords($params, $sort, $limit){ 

		//records must be returned by default
		//check if form has been submitted
		//count($params);
	
		if(isset($params['UserType']) && $params['UserType'] != '0'){
            $UserType = $params['UserType'];
        }else{
			$UserType = "all";	
		}

		//general filters
		$filter = array();
	
		if(isset($params['Created']) && $params['Created'] != ''){
			$filter[] = "`Created` >= '".Convert::raw2xml($params['Created'])."'";
		}
		
		if(isset($params['Email']) && $params['Email'] != ''){
			$filter[] = "`Email` LIKE '%".Convert::raw2xml($params['Email'])."%'";
		}					
		
		$oUsers = new ArrayList();
		//$oUsers = new DataObjectSet();

		if($UserType == "all" || $UserType == "registered"){
			$regFilter = $filter;
			if(isset($params['Visited']) && $params['Visited'] != ''){
				$regFilter[] = "`LastVisited` >= '".Convert::raw2xml($params['Visited'])."'";
			}	
						
			$regFilter = implode(" AND ", $regFilter);
			$oMembers = Member::get()->where($regFilter);
			foreach($oMembers as $obj) $oUsers->push($obj);
			//$oMembers = DataObject::get("Member", $regFilter);
			//$oUsers->merge($oMembers);
		}

		if($UserType == "all" || $UserType == "guest"){
			$guestFilter = $filter;
			if(isset($params['Created']) && $params['Created'] != ''){
				$guestFilter[] = "`Created` >= '".Convert::raw2xml($params['Created'])."'";
			}				
			$filter = implode(" AND ", $guestFilter);			
			$oGuests = TrackedGuest::get()->where($guestFilter);
			foreach($oGuests as $obj) $oUsers->push($obj);
			//$oGuests  = DataObject::get("TrackedGuest", $guestFilter);
			//$oUsers->merge($oGuests);
		}
		
		$oUsers->sort("Created", "DESC");
		
		return $oUsers;
	
	}	

	
    public function columns()
    {  

		$fields = array(
            'ID' => array(
                'title' => 'User ID',
            ),
            'ClassName' => array(
                'title' => 'Type',
            ),			
            'FirstName' => array(
                'title' => 'First name',
				'formatting' => '{$value}'
            ),		
            'Surname' => array(
                'title' => 'Surname',
				'formatting' => '{$value}'
            ),		
            'Email' => array(
                'title' => 'Email',
				'formatting' => '{$value}'
            ),		
            'Phone' => array(
                'title' => 'Phone',
				'formatting' => '{$value}'
            ),	
            'Newsletter' => array(
                'title' => 'Newsletter',
				'formatting' => '{$value}'
            ),						
            'JobTitle' => array(
                'title' => 'Job title',
				'formatting' => '{$value}'
            ),	
            'Company' => array(
                'title' => 'Company',
				'formatting' => '{$value}'
            ),
            'Industry' => array(
                'title' => 'Industry',
				'formatting' => '{$value}'
            ),		
						
            'getUserEventsReport' => array(
                'title' => 'Events',
				'formatting' => '{$value}'
            ),
            'Created' => array(
                'title' => 'User created',
				'formatting' => '{$value}'
                //'casting' => 'SS_Datetime->Ago'
            ),
            'LastVisited' => array(
                'title' => 'Last visited',
				'formatting' => '{$value}'
                //'casting' => 'SS_Datetime->Ago'
            ),
            'NumVisit' => array(
                'title' => 'Visits',
				'formatting' => '{$value}'
                //'casting' => 'SS_Datetime->Ago'
            )
			
        );
        return $fields;	


	}	
	
	public function parameterFields(){
		$params = new FieldList();

		$fldCreated = new DateField("Created","Created on or after");
		$fldCreated->setConfig('showcalendar', true);
		$fldCreated->setConfig('showdropdown', true);
		$fldCreated->setConfig('dateformat', 'YYYY-MM-dd');				   

		$fldVisited = new DateField("Visited","Visited on or after");
		$fldVisited->setConfig('showcalendar', true);
		$fldVisited->setConfig('showdropdown', true);
		$fldVisited->setConfig('dateformat', 'YYYY-MM-dd');				   

		$fldEmail = new TextField("Email", "Email address");
		
		$fldUserType = new DropdownField("UserType","User type",array("all" => "All", "registered" => "Registered only", "guest" => "Guest users"));

		$fldHasVisited = new CheckboxField("HasVisited", "Has visited?");
		
		$params->push($fldCreated);
		$params->push($fldVisited);
		$params->push($fldEmail);
		$params->push($fldUserType);
		//$params->push($fldHasVisited);
	   
		return $params;	
	}	

	//see SS_Report class
	public function getReportFieldOLD() {
		$columnTitles = array();
		$fieldFormatting = array();
		$csvFieldFormatting = array();
		$fieldCasting = array();

		// Parse the column information
		foreach($this->columns() as $source => $info) {
			if(is_string($info)) $info = array('title' => $info);
			
			if(isset($info['formatting'])) $fieldFormatting[$source] = $info['formatting'];
			if(isset($info['csvFormatting'])) $csvFieldFormatting[$source] = $info['csvFormatting'];
			if(isset($info['casting'])) $fieldCasting[$source] = $info['casting'];
			$columnTitles[$source] = isset($info['title']) ? $info['title'] : $source;
		}
		
		// To do: implement pagination
		$query = $this->sourceQuery($_REQUEST);
			
		$tlf = new TableListField('ReportContent', $this->dataClass(), $columnTitles);
		$tlf->setCustomQuery($query);
		$tlf->setShowPagination(true);
		$tlf->setPageSize(50);
		$tlf->setPermissions(array('export'/*, 'print'*/));
		
		// Hack to figure out if we are printing
		if (isset($_REQUEST['url']) && array_pop(explode('/', $_REQUEST['url'])) == 'printall') {
			$tlf->setTemplate('SSReportTableField');
		}
		
		if($fieldFormatting) $tlf->setFieldFormatting($fieldFormatting);
		if($csvFieldFormatting) $tlf->setCSVFieldFormatting($csvFieldFormatting);
		if($fieldCasting) $tlf->setFieldCasting($fieldCasting);

		return $tlf;
	}
	
}