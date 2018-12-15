<?php
class NewsletterSnippet extends DataObject {

    static $singular_name = "Newsletter - code snippet";
    static $plural_name = "Newsletter - code snippets" ;

    static $db = array(
		"Title"     => "Text", //purely for reference
        "Snippet"   => "HTMLText"
	);
	
    static $has_one = array (
        "Subsite" => "Subsite",
    );

    static $belongs_many_many = array(

    );
	
	public static $default_sort = 'Title ASC';

    public function canView($member = null){
        return true;
    }

    public function canEdit($member = null){
        return true;
    }

    public function canDelete($member = null){
        return true;
    }

    public function canCreate($member = null){
        return true;
    }

    public function canPublish($member = null){
        return true;
    }

    public function getCMSValidator() {
        return new RequiredFields("Title", "Snippet");
    }

	function getCMSFields(){
		$fields = new FieldList();

		$fields->push(new TextField("Title", "Newsletter reference"));
        $fields->push($fldSnippet = new TextAreaField("Snippet", "Code snippet"));
        $fldSnippet->setRows(30);

		return $fields;		

	}
	
}