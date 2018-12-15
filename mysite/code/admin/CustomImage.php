<?php
class CustomImage extends DataExtension {
 
    private static $db = array(
        'Description' => 'Text',
		"PanelFormat" => "Text", //don't really want this on the object - try to move into relationship table only		
    );
     
    private static $has_one = array(
       // 'Page' => 'Page'
    );

    private static $belongs_many_many = array(
        'Pages' => 'Page'   
    );	

    public function updateCMSFields(FieldList $fields) {
		$fldPanelFormat = new DropdownField('PanelFormat', 'Panel format', array("small" => "small", "medium" => "medium", "large" => "large"));
		$fldPanelFormat->SetEmptyString("-- please select --");	
		
		$fields->push(new TextareaField('Description'));
		$fields->push($fldPanelFormat);
    }
	
    function getCustomFields() {

		$fldPanelFormat = new DropdownField('PanelFormat', 'Panel format', array("small" => "small", "medium" => "medium", "large" => "large"));
		$fldPanelFormat->SetEmptyString("-- please select --");	

		$fields = $this->owner->getCMSFields();

        //$fields = new FieldList(
		//	new TextareaField('Description', 'Description'),
		//	$fldPanelFormat
		//);
        //$fields->push(new TextareaField('Description', 'Description'));
		//$fields->push($fldPanelFormat);

        return $fields;
    }	
	
}