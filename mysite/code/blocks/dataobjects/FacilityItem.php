<?php
class FacilityItem extends DataObject {

    static $db = array(
        "Title" => "Text",
        "Content" => "HTMLText",
        "SortOrder" => "Int",
        "Content" => "HTMLText",
    );

    static $has_one = array(
        'MainImage' => 'Image',
        'FacilityPage' => 'FacilityPage',
    );

    static $summary_fields = array(
        "Title",
    );

    static $default_sort = 'SortOrder ASC';

    public function getCMSFields() {
        $fields = new FieldList(new TabSet("Root"));

        $fields->addFieldToTab('Root.Main', new TextField('Title'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('Content'));

        return $fields;
    }

}
