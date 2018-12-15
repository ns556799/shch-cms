<?php 
class Office extends DataObject
{
	static $db = array (
		"Name" => "Text",
		"Address" => "HTMLText",
		"Country" => "VarChar(255)",
		"Lat" => "Decimal(10.10)",
		"Lng" => "Decimal(10.10)",
		"URL" => "ExternalURL",		
		"ContactDetails" => "HTMLText",
		"SortOrder" => "Int" //only do this if it is in has_one relationship with the page (not a has_many)
	);
	
	static $has_one = array (
		"Page" => "Page",
	);
	
	static $default_sort = "Name Desc";	
	
	function getCMSFields(){ //getCMSFields_forPopup() deprecated in SS3

		$fldContactDetails = new HTMLEditorField("ContactDetails", "Contact details");
		$fldContactDetails->setRows(5);			

		return new FieldList(
			new TextField("Name", "Name of office"),
			new TextAreaField("Address", "Address - for map pop-up"),
			new CountryDropdownField("Country", "Name of office"),
			new NumericField("Lat", "Latitude"),
			new NumericField("Lng", "Longitude"),
			new ExternalURLField("URL", "Website"),
			$fldContactDetails
		);
	}	
	
}