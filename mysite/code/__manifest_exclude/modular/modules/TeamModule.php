<?php
class TeamModule extends Module {

	static $icon = 'mysite/images/icons/staff';	
	static $singular_name = "Module - team";
   	static $plural_name = "Module - team" ;
	//static $description = 'Description here';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";	
	
	static $has_one = array(
	);

	private static $has_many = array(
		"SharedTeamMembers" => "SharedTeamMember",
	);	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Banners');
		
		$fields->addFieldToTab("Root.Main", $fldContent = new HtmlEditorField("Content", "Content before list"));
		$fldContent->setRows(5);

		$fields->addFieldToTab("Root.Main", $fldContent2 = new HtmlEditorField("Content2", "Content after list"));
		$fldContent2->setRows(5);
		
		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"TeamMemberPage.getNameForDropdown" => "Name",
				"TeamMemberPage.Email" => "Email",
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
		$fldSharedTeamMembers = new GridField("SharedTeamMembers", "Select team members:", $this->SharedTeamMembers(), $gfConfig);
		$fields->addFieldToTab("Root.Team", $fldSharedTeamMembers);
				
		return $fields;
	}

	public function getTeamMembers($limit = 4) {
		
		$data = new ArrayList; 
		
		if($oSharedTeamMembers = $this->SharedTeamMembers()){
			foreach($oSharedTeamMembers as $oSharedTeamMember){
				$obj = $oSharedTeamMember->TeamMemberPage();
				$data->push($obj);
			}
		}
		
		return $data;

	}
	
}

class TeamModule_Controller extends Module_Controller {
		
}