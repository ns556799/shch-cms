<?php

class AboutPage extends Page
{

	static $icon = 'mysite/images/icons/home';
	static $singular_name = "About page";
	static $plural_name = "About pages";
	static $description = 'About Page';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "ModularPage";

	private static $db = array(
		"Content" => "HTMLText",
		"Content2" => "HTMLText",
	);

	private static $has_one = array();

	private static $has_many = array(
		"ServiceItems" => "ServiceItem"
	);

	private static $many_many = array(
		"GalleryImages" => "Image"
	);


	function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->removeByName(['Banners','OtherImages']);
		$fields->addFieldToTab('Root.Main', new HtmlEditorField('Content'));
		$fields->addFieldToTab('Root.Main', new HtmlEditorField('Content2'));
		$fields->addFieldToTab('Root.Gallery', new UploadField('GalleryImages'));
		$fields->addFieldToTab('Root.Service', new GridField("ServiceItems", "Service Items:", $this->ServiceItems(), Page::gridConfig()));


		return $fields;
	}

}

class AboutPage_Controller extends Page_Controller
{

}
