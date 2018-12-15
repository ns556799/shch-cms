<?php

class CustomGroup extends DataExtension{
	
	private static $db = array(
		"GoToAdmin" => "Boolean"
	);

	private static $has_one = array(
		"LinkedPage" => "SiteTree"
	);	
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();		
		$this->extend('updateCMSFields', $fields);
		return $fields;
	}	
	
	public function updateCMSFields(FieldList $fields) {
		
		//SiteTree::get()->filter("ParentID", $this->ID)->sort('Sort')->First();
		/*
		$pages = new ArrayList; 
		foreach(SiteTree::get() as $obj) $pages->push($obj);
		$pages = $pages->Map('ID', 'Title');	//id, function name for value, no selection
		$pagesDropdown = new DropdownField("LinkedPageID", "Or select a page to redirect to");
		$pagesDropdown->SetEmptyString("-- please select --");					
		Gallery::get()->map('ID', 'Title')
		*/
		
		$fields->push(new CheckboxField("GoToAdmin", " Go to Admin area"),"Members");
		//$fields->push($pagesDropdown,"Members");
		$fields->push( new DropdownField('LinkedPageID', 'Or select a page to redirect to', Page::get()->map('ID', 'Title')));
	}	

/*   
    public function extraStatics(){
         
        return array(
            'db' => array(
                "GoToAdmin" => "Boolean"
            ),
            'has_one' => array(
                "LinkedPage" => "SiteTree"
            ),
        );
    }
	
    public function updateCMSFields(FieldSet &$fields) {
       $fields->addFieldToTab("Root.Members", new CheckboxField("GoToAdmin", " Go to Admin area"), 'Members');
       $fields->addFieldToTab("Root.Members", new TreeDropdownField("LinkedPageID", "Or select a page to redirect to", "SiteTree"), 'Members');
    }	
*/

} 