<?php
class UploadedImagesAdmin extends ModelAdmin {
   static $managed_models = array(
      'UploadedImage'
   );
   static $model_importers = array(
   );
   static $url_segment = 'uploadedimages';
   
	public static $menu_title = 'Uploaded images';	
	/*
	public static $collection_controller_class = 'UploadedImagesAdmin_CollectionController';
	//public static $record_controller_class = 'BookingAdmin_RecordController';   
	public $showImportForm = false;
	public static $page_length = 100;

    public function init(){
		parent::init();
		Requirements::javascript('mysite/javascript/uploadedimagesadmin.js');
    }     
	*/
   
}

/*
class UploadedImagesAdmin_CollectionController extends ModelAdmin_CollectionController{
	//manages everything to do with overall control (e.g. search form, import, etc...)
	public function SearchForm() {
		$form = parent::SearchForm();
		return $form;
	}

	
   //function getResultsTable($searchCriteria) {
    //  $tableField = parent::getResultsTable($searchCriteria);
     // $tableField->MarkableTitle = "Select";
      //$tableField->Markable = true;
     // return $tableField;   
   //} 
   
   
	function getResultsTable($searchCriteria) { //original function in cms/code/ModelAdmin.php
		
		$summaryFields = $this->getResultColumns($searchCriteria);

		$className = $this->parentController->resultsTableClassName();
		$tf = new $className(
			$this->modelClass,
			$this->modelClass,
			$summaryFields
		);

		$tf->setCustomQuery($this->getSearchQuery($searchCriteria));
		$tf->setPageSize($this->parentController->stat('page_length'));
		$tf->setShowPagination(true);
		// @todo Remove records that can't be viewed by the current user
		$tf->setPermissions(array_merge(array('view','export'), TableListField::permissions_for_object($this->modelClass)));

		// csv export settings (select all columns regardless of user checkbox settings in 'ResultsAssembly')
		$exportFields = $this->getResultColumns($searchCriteria, false);
		$tf->setFieldListCsv($exportFields);

		$url = '<a href=\"' . $this->Link() . '/$ID/edit\">$value</a>';
		//$url = '$value';
		$fieldArray = array_combine(array_keys($summaryFields), array_fill(0,count($summaryFields), $url));
		$fieldArray["UploadedImage.AbsoluteURL"] = '<a href=\"$value\" target=\"_blank\">$value</a>';
		$tf->setFieldFormatting($fieldArray);
		//$tf->setFieldFormatting(array_combine(array_keys($summaryFields), array_fill(0,count($summaryFields), $url)));

		
	
		return $tf;
	}   	
	
	
}
*/