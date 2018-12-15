<?php 
class GalleryVote extends DataObject
{
	static $db = array (
		"IP" => "Text",
		"Cookie" => "Text"
	);
	
	static $has_one = array (
		"UploadedImage" => "UploadedImage",
		"Member" => "Member"
	);

	//used in ModelAdmin (for search) - see BookingAdmin class
	static $searchable_fields = array(
		"ID" => array(
			"title" => "Image ID"
		),										 
        "IPAddress" => array(
             "field" => "TextField",
             "filter" => "PartialMatchFilter",
             "title" => 'IP Address'
         ),
		"Approved" => array(
			"title" => "Approved"
		),			 
	);
	
	//used in ModelAdmin (list display) - see UploadedImagesAdmin class
	static $summary_fields = array(
		"ID",
		"URL" => 'UploadedImage.AbsoluteURL',	
		'Created',
	);	
	
	static $default_sort = "ID Desc";	
	
	function getCMSFields() {
		
		$fields = parent::getCMSFields();
		
		//$fields->addFieldToTab('Root.Main', new TextAreaField("Description","Description / copyright information"));
		//$fields->addFieldToTab('Root.Main', new ImageField("UploadedImage","Uploaded image"));
		
		return $fields;
	}	

	public function getCMSFields_forPopup()
	{
		/*
		$linkField = new SimpleTreeDropdownField("BannerLinkID","Select link","SiteTree");
		$linkField->setEmptyString('-- Please select --');
		
		return new FieldSet(
			new TextField("Name"),
			new ImageField("BannerImage", "Banner image"),
			new SimpleTinyMCEField("BannerText", "Text to overlay on banner"),
			$linkField
		);
		*/
	}
	
	
}