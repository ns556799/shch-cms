<?php

class HomePage extends Page
{

	static $icon = 'mysite/images/icons/home';
	static $singular_name = "Home page";
	static $plural_name = "Home pages";
	static $description = 'The main homepage (displays 404 error)';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";

	private static $db = array();

	private static $has_one = array();
	private static $many_many = array(
		"BannerImages" => "Image"
	);

	function canDelete($member = NULL)
	{
		return true;
	}

	function canCreate($member = NULL)
	{
		return !(HomePage::get()->Count() > 0);
	}

	function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->removeByName('Banners');
		$fields->addFieldToTab('Root.Banner', $fldImg = new UploadField('BannerImages'));

		return $fields;
	}

}

class HomePage_Controller extends Page_Controller
{

	private static $allowed_actions = array(
		'forceerror'
	);

	public function init()
	{
		parent::init();
	}

	public function index()
	{
		//return $this->httpError(404);
		//return $this->redirect('Security/login');
		return $this;
	}
}
