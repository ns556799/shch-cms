<?php

class Shortcodes_Controller extends Page_Controller {

    private static $url_handlers = array(
        '' => 'index',
    );

    private static $allowed_actions = array(
        "index"    => true,
    );

	public function init() {
		parent::init();
	}

	public function index(){

	    $data = array();

	    $oNewsletterSnippets = NewsletterSnippet::get()->sort("Title ASC");
        $data["Newsletters"] = $oNewsletterSnippets;

        $oSocials = new ArrayList();
        $oSocials->push(new ArrayData(
            array(
                "Title" => "Facebook",
                "ID" => "Facebook"
            )
        ));
        $oSocials->push(new ArrayData(
            array(
                "Title" => "Twitter",
                "ID" => "Twitter"
            )
        ));
        $oSocials->push(new ArrayData(
            array(
                "Title" => "Instagram",
                "ID" => "Instagram"
            )
        ));
        $oSocials->push(new ArrayData(
            array(
                "Title" => "LinkedIn",
                "ID" => "LinkedIn"
            )
        ));
        $oSocials->push(new ArrayData(
            array(
                "Title" => "YouTube",
                "ID" => "YouTube"
            )
        ));
        $oSocials->push(new ArrayData(
            array(
                "Title" => "Pinterest",
                "ID" => "Pinterest"
            )
        ));
        $oSocials->push(new ArrayData(
            array(
                "Title" => "App",
                "ID" => "App"
            )
        ));
        $data["Socials"] = $oSocials;

        return $this->customise($data)->renderWith(array("Shortcodes"));

    }

}