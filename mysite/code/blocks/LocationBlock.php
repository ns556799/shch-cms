<?php

class LocationBlock extends Block
{

	const LAYOUTS_BASE_LOCATION = '/pages/mysite/images/blocks/';

	private static $db = array(
		"Title" => "Text",
		"Content" => "HTMLText",
		"SortOrder" => "Int",
		"Telephone" => "Text",
		"Fax" => "Text",
		"Email" => "Text",
		"OpeningTime1" => "Text",
		"OpeningTime2" => "Text",
		"Location" => "Text",
	);

	private static $has_one = array(
	);

	private static $has_many = array();

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();


		$fields->removeByName('Title');
		$fields->removeByName('SortOrder');

		$fields->addFieldToTab('Root.Main', new TextField('Title'));

		$fields->addFieldToTab('Root.Contact', new TextField('Telephone','Telephone'));
		$fields->addFieldToTab('Root.Contact', new TextField('Fax','Fax'));
		$fields->addFieldToTab('Root.Contact', new TextField('Email','Email'));

		$fields->addFieldToTab('Root.Contact', new TextField('OpeningTime1','OpeningTime 1'));
		$fields->addFieldToTab('Root.Contact', new TextField('OpeningTime2','OpeningTime 2'));

		$fields->addFieldToTab('Root.Main', new HtmlEditorField('Content','Content'));

		$fields->addFieldToTab('Root.Map', new TextareaField('Location','Location'));

		return $fields;
	}

	function RenderBlock()
	{
		return $this->BlockHTML();
	}


	public function getLatLng() {
		$address = $this->Location;
		$prepAddr = str_replace(' ','+',$address);
		$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=AIzaSyAqAX7TaZ9s7IVcGTnECon0K7ycqSSWYyU');
		$output= json_decode($geocode);

		if($output->results[0]) {

			$latitude = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;

			$coords = array();
			$coords['lat'] = $latitude;
			$coords['lng'] = $long;

			$map = new SSViewer('MapTemplate');

			return $map->process(new ArrayData($coords));
		} else {
			return 'Address incorrect';
		}
	}


}
