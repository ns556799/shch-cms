<?php
class ModularPage extends Page {

    static $icon = 'mysite/images/icons/modularpage';
    static $singular_name = "Modular page";
    static $plural_name = "Modular pages" ;
    static $description = 'Modular page - add modules';

    private static $db = array(
    );

    private static $has_one = array(
    );

    function canDelete($member = NULL) {
        return true;
    }

    function canCreate($member = NULL) {
        return true;
    }

    function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');

        $fields->addFieldToTab('Root.Main', $this->prepareBlocksFld());

        return $fields;
    }

}

class ModularPage_Controller extends Page_Controller {

    private static $allowed_actions = array (

    );

    public function init() {
        parent::init();
    }

}
