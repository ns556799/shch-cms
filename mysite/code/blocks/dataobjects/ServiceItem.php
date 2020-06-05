<?php
class ServiceItem extends DataObject {

    static $db = array(
        "Title" => "Text",
        "Service" => "HTMLText",
        "SortOrder" => "Int",
    );

    static $has_one = array(
        'MainImage' => 'Image',
        'AboutPage' => 'AboutPage',
    );

    static $summary_fields = array(
        "Title"
    );

    static $default_sort = 'SortOrder ASC';

    public function getCMSFields() {
        $fields = new FieldList(new TabSet("Root"));

        $fields->addFieldToTab('Root.Main', new TextField('Title'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('Service'));

        return $fields;
    }

}
