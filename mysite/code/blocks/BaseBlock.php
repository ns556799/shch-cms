<?php
class BaseBlock extends Block {

	const LAYOUTS_BASE_LOCATION = '/pages/mysite/images/blocks/';

	private static $db = array(
		'Heading' => 'Varchar(150)',
		'Content' => 'HTMLText',
	);

	private static $has_one = array(
		"MainImage" => "Image",
	);

	private static $has_many = array(

	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$this->removeFields($fields);

		return $fields;
	}

	function RenderBlock() {
		return $this->BlockHTML();
	}

	public function prepareNewLines($string) {
		return str_replace(array("\r"), '<br>', $string);
	}

	public function removeFields($fields, $exceptFields = array()) {

		$fieldsToRemove = array_merge(
			array_keys(self::$db),
			array_keys(self::$has_one),
			array_keys(self::$has_many)
		);

		foreach($exceptFields as $except) {
			unset($fieldsToRemove[$except]);
		}

		$fields->removeByName($fieldsToRemove);
	}

	public function prepareLayoutGuide($filePath) {
		$fldImageHolder = '<div style="margin-left: 184px;">';
		$fldImageHolder .= '<img src="'.self::LAYOUTS_BASE_LOCATION.$filePath.'" width="500">';
		$fldImageHolder .= '</div>';
		$fldLayoutGuide = new LiteralField('ImageGuide', $fldImageHolder);

		return $fldLayoutGuide;
	}

    public function getMemberListPage() {
        return MembersListPage::get()->first();
    }

}
