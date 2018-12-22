<?php
class GeneralContentBlock extends BaseBlock {

    static $singular_name = "General content block";


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', new TextField('Heading'));
        $fields->addFieldToTab('Root.Main', new HtmlEditorField('Content'));

        return $fields;
    }

}
