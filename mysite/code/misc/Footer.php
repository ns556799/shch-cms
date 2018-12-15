<?php

class Footer extends Page
{

	static $icon = 'mysite/images/icons/footer';

	private static $db = array(
		"CookieMessage" => "HTMLText",
		//"Panel2" => "HTMLText",
		//"Panel3" => "HTMLText",
		//"Panel4" => "HTMLText", //not used
		//"Copyright" => "HTMLText",
		//"FacebookURL" => "ExternalURL",
		//"TwitterURL" => "ExternalURL",
		//"LinkedInURL" => "ExternalURL",
		//"GooglePlusURL" => "ExternalURL",
		//"YouTubeURL" => "ExternalURL",
		//"SlideShareURL" => "ExternalURL"
	);

	private static $has_one = array();

	static $defaults = array(
		'ShowInMenus' => false,
		'ShowInSearch' => false
	);

	//must include this function to override default on Page class
	function canDelete($member = NULL)
	{
		return true;
	}

	//must include this function to override default on Page class
	function canCreate($member = NULL)
	{
		return !(Footer::get()->Count() > 0);
	}

	function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->removeFieldFromTab('Root.Main', 'Content');
		$fields->removeByName('Banners');

		//$fields->addFieldToTab("Root.Main", new LiteralField('FooterHelp1','<p><strong>IMPORTANT!</strong> Save and publish this node if sub-pages deleted or added. This will ensure footer menu order is correct.</p>'));

		$fields->addFieldToTab("Root.Cookie",
			$fldCookieMsg = new HTMLEditorField('CookieMessage', 'Cookie Message'));

		return $fields;
	}

	public function onAfterWrite()
	{
		if (count($this->Children()) > 0) {
			$i = 1;
			foreach ($this->Children() as $child) { //assuming we'll get them in order
				$child->Sort = $i;
				$child->write();
				$i++;
			}

		}
		parent::onAfterWrite();
	}

}

class Footer_Controller extends Page_Controller
{

	public function init()
	{
		parent::init();
	}
}
