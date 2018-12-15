<?php
class NewslettersAdmin extends ModelAdmin {

    static $managed_models = array(
        'NewsletterSnippet',
    );

    static $model_importers = array(
    );

    public static $url_segment = 'newsletters';
    public static $menu_title = 'Newsletters';

    public $showImportForm = true;
    public static $page_length = 100;

    public static $menu_icon = 'mysite/images/menu-icons/16x16/pencil.png';

    //Dataobjects are subsite specific
    public function subsiteCMSShowInMenu(){
        return true;
    }

    //restrict to this subsite
    public function getEditForm($id = null, $fields = null){
        $form = parent::getEditForm($id, $fields);

        $gridField = $form->Fields()->fieldByName($this->sanitiseClassName($this->modelClass));
        if(class_exists('Subsite')){
            $list = $gridField->getList()->filter(array('SubsiteID'=>Subsite::currentSubsiteID()));
            $gridField->setList($list);

            /* install https://github.com/milkyway-multimedia/ss-gridfield-utils to provide a save button
            $gfColumns = new GridFieldEditableColumns();
            $gfColumns->setDisplayFields(
                array(
                    "Title" => array(
                        'title' => 'Title',
                        'callback' => function($record, $column, $grid){
                            return TextField::create($column);
                        }
                    )
                )
            );
            $gridField->getConfig()->addComponents(
                $gfColumns, //new GridFieldDataColumns(),
                //new GridFieldAddNewInlineButton('toolbar-header-right'),
                new GridFieldDetailForm()
            );
            */

        }

        return $form;
    }


}