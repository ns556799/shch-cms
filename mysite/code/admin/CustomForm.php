<?php
class CustomForm extends Form {

	function __construct($controller, $name, FieldSet $fields, FieldSet $actions, $validator = null) {
		
		parent::__construct($controller, $name, $fields, $actions, $validator);
		
	}
	
}
