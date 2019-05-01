<?php
class TeamMember extends DataObject {

    static $db = array(
        "Title" => "Text",
        "Content" => "HTMLText",
        "SortOrder" => "Int",
        "Position" => "Text",
    );

    static $has_one = array(
        'MainImage' => 'Image',
        'TeamPage' => 'TeamPage',
    );

    static $summary_fields = array(
        "Title",
    );

    static $default_sort = 'SortOrder ASC';

    public function getCMSFields() {
        $fields = new FieldList(new TabSet("Root"));

        $fields->addFieldToTab('Root.Main', new TextField('Title'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('Content'));
        $fields->addFieldToTab('Root.Main', new TextField('Position'));
        $fields->addFieldToTab('Root.Main', new UploadField('MainImage'));

        return $fields;
    }

}
