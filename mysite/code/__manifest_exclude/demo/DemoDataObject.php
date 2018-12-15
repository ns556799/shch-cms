<?php 
class DemoDataObject extends DataObject
{
	static $db = array (
		"Name" => "Text",
		"Description" => "HTMLText",
		"SelectedColours" => "Text",
		"SortOrder" => "Int" //only do this if it is in has_one relationship with the page (not a has_many)
	);
	
	static $has_one = array (
		"DemoImage" => "Image", // not need for "BetterImage",
		"DemoPage" => "Page",
	);
	
	static $default_sort = "Name Desc";	
	
	function getCMSFields(){ //getCMSFields_forPopup() deprecated in SS3

		//This needs the onBeforeWrite function below to save properly
		$colours = singleton('DemoPage')->dbObject('DemoSection')->enumValues();
		///seems to run through this loop twice, so if set to array first time round, this errors on a second explode
		if(!is_array($this->SelectedColours)){
			$this->SelectedColours = explode(",",$this->SelectedColours);
		}
		$coloursField = new ListBoxField($name = "SelectedColours",$title = "Select colour",$source = $colours, "" /* $value = */,$size = 5,$multiple = true);
		//$coloursField->setMultiple(true);		
		//$coloursField->setSize(5);			
	
		$demoImageField = new UploadField('DemoImage', 'Demo image');
    	$demoImageField->allowedExtensions = array('jpg', 'png', 'gif');	
	
		$HTMLEditorField = new HTMLEditorField("Description", "Description", 5);
		$HTMLEditorField->setRows(5);
	
		//FieldSet deprecated in SS3
		return new FieldList(
			new TextField("Name"),
			$HTMLEditorField,
			$coloursField,
			$demoImageField
		);
	}	
	
	//required to save the listbox
	function onBeforeWrite(){
	
		$ColourList = null;
	
		if(is_array($this->SelectedColours)){
			for($i=0;$i<count($this->SelectedColours);$i++){
				$ColourList .= $this->SelectedColours[$i] . ",";
			}
			$this->SelectedColours = substr($ColourList,0,strlen($ColourList) -1);
		}
		
		return parent::onBeforeWrite();
	}		
	
	function Thumbnail() {
		$Image = $this->DemoImage();
		if ( $Image ) {
			return $Image->CMSThumbnail();
		} else {
			return null;
		}
	}	
	
}