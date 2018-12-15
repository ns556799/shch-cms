<?php
class PublicationListModule extends Module {

	static $icon = 'mysite/images/icons/document';	
	static $singular_name = "Module - publications";
   	static $plural_name = "Module - publications" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	static $has_one = array(
		"SelectedPage" => "SiteTree"
	);
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Banners');

		$fields->addFieldToTab("Root.Main", new TreeDropDownField('SelectedPageID', 'Select page', 'SiteTree'));
		
		$fields->addFieldToTab("Root.Main", $fldContent = new HtmlEditorField("Content", "Content before list"));
		$fldContent->setRows(5);

		$fields->addFieldToTab("Root.Main", $fldContent2 = new HtmlEditorField("Content2", "Content after list"));
		$fldContent2->setRows(5);
		
		return $fields;
	}
	
	public function getListItems($limit = 5) {
		$filter = array(
			'ParentID' => $this->SelectedPageID
		);
		$data = PublicationPage::get()->filter($filter)->limit($limit);
		return $data;
	}
	
}
class PublicationListModule_Controller extends Module_Controller {
		
}