<?php 
class UploadedImage extends DataObject
{
	static $db = array (
		"Title" => "Text",
		"Description" => "HTMLText",
		"Approved" => "Boolean",
		"VoteCount" => "Int",
		"LeaderPos" => "Int",
		"Location" => "Text",
		"Lng" => "Decimal(10,6)",
		"Lat" => "Decimal(10,6)",
	);
	
	static $has_one = array (
		"UploadedImage" => "Image",
		"Member" => "Member"
	);
	
	static $has_many = array (
		"GalleryVotes" => "GalleryVote"
	);	

	private static $create_table_options = array(
		'MySQLDatabase' => 'ENGINE=MyISAM'
	);
	
	static $indexes = array(
		'Fulltext_search' => array ('type' => 'fulltext', 'value' => 'Title,Description,Location' ) 
	 );	


	//used in ModelAdmin (for search) - see BookingAdmin class
	static $searchable_fields = array(
		"ID" => array(
			"title" => "Image ID"
		),										 
        "Title" => array(
             "field" => "TextField",
             "filter" => "PartialMatchFilter",
             "title" => 'Description'
         ),
        "Description" => array(
             "field" => "TextField",
             "filter" => "PartialMatchFilter",
             "title" => 'Description'
         ),
        "Member.Surname" => array(
             "field" => "TextField",
             "filter" => "PartialMatchFilter",
             "title" => 'Uploaded by (surname)'
         ),
		"Approved" => array(
			"title" => "Approved"
		),			 
	);
	
	//used in ModelAdmin (list display) - see UploadedImagesAdmin class
	static $summary_fields = array(
		"ID",
		'Thumbnail',
		"URL" => 'UploadedImage.AbsoluteURL',	
		'Title',
		'Description',
		'Location',
		'Uploaded by' => "UploadedBy",
		//'Created',
		'Approved',
		'VoteCount'
	);	
	
	static $default_sort = "ID Desc";	
	
	function getCMSFields() {
		
		return new FieldList(
			new TextField("Title"),
			new TextField("Location"),
			new NumericField("Lat"),
			new NumericField("Lng"),
			new CheckboxField("Approved"),
			new NumericField("VoteCount"),
			new UploadField("UploadedImage")
		);
		
	}	

	function Thumbnail() {
		$Image = $this->UploadedImage();
		if ( $Image ) {
			return $Image->CMSThumbnail();
		} else {
			return null;
		}
	}	

	public function UploadedBy(){
		$oMember = $this->Member();
		return $oMember->FirstName." ".$oMember->Surname." (".$oMember->Email.")";
			
	}
	
	public function updateVoteCount(){
		$this->VoteCount = count($this->GalleryVotes());
		$this->write();

/*
$cache = SS_Cache::factory('foo');
if (!($result = $cache->load($cachekey))) {
    $result = "potatoes";
    $cache->save($result);
}
return $result;

		
		//set the time this was last done
		$cache = SS_Cache::factory('votes'); 
		$lastvotetime = $cache->load('lastvotetime');

		echo "**".$lastvotetime."**";
		exit;
		
		$cacheKey = time();
		$cache->save('lastvotetime', time());
*/		
	}
	
	public function detailsCompleted(){
		if($this->Title /*&& $this->Description*/ && $this->Location){
			return true;
		}
	}
	
}