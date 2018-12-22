<?php
class BlockItem extends DataObject {

    static $db = array(
        "Title" => "Text",
        "Content" => "HTMLText",
        "SortOrder" => "Int",
    );

    static $has_one = array(
        'MainImage' => 'Image',
        'BaseBlock' => 'BaseBlock',
    );

    static $summary_fields = array(
        "Thumbnail",
        "Title",
    );

    static $default_sort = 'SortOrder ASC';

    public function getCMSFields() {
        $fields = new FieldList(new TabSet("Root"));

        $fields->addFieldToTab('Root.Main', new TextField('Title'));

        return $fields;
    }

    function Thumbnail() {
        if ($oImage = $this->MainImage()) {
            return $oImage->CMSThumbnail();
        }
    }

}
