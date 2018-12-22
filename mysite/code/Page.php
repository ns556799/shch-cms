<?php

class Page extends SiteTree
{

	//static $icon = 'mysite/images/icons/page';
	//static $singular_name = "Page";
	//static $plural_name = "Pages" ;
	//static $description = 'The default page';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "Page";

	private static $db = array(
		"ShortDescription" => "HTMLText",
		"Content2" => "HTMLText",
		"Content3" => "HTMLText",
		"Content4" => "HTMLText"
	);

	private static $has_one = array(
		"MainImage" => "Image",
		"ListImage" => "Image",
		"Attachment" => "File"
	);

	private static $has_many = array(
		"Banners" => "Banner", //a standalone dataobject
	);

	private static $many_many = array(
		'OtherImages' => 'Image' //an extension of image - N.B. description stored against image is global
	);

	// this adds the SortOrder field to the relation table.
	private static $many_many_extraFields = array(
		'OtherImages' => array('SortOrder' => 'Int')
	);

	//must include this function to override default on Page class
	function canDelete($member = NULL)
	{
		return true;
	}

	//must include this function to override default on Page class
	function canCreate($member = NULL)
	{
		$excludeClasses = array("Page", "VirtualPage");
		if (!in_array($this->ClassName, $excludeClasses)) {
			return true;
		}
	}

	function getSettingsFields()
	{
		$fields = parent::getSettingsFields();

		/*
		$fields->addFieldToTab("Root.Settings", new CheckboxField('IncludeOnly','Check this box if this page content is an include only.'));
		if($this->IncludeOnly){
			$fields->addFieldToTab("Root.Settings", new LiteralField('IncludeOnlyURL','<div class="field"><label class="left">This is the "include" URL for this page:</label><div class="middleColumn"><a href="'.$this->getContentOnlyLink().'" target="_blank">'.$this->getContentOnlyLink().'</a></div></div>'));
		}
		*/

		return $fields;
	}

	function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$gfColumns = new GridFieldDataColumns();
		$gfColumns->setDisplayFields(
			array(
				"Thumbnail" => "Thumbnail",
				"Title" => "Title"
			)
		);
		$gfConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableRows('SortOrder'),
			new GridFieldSortableHeader(),
			$gfColumns, //new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		);
		$fldBanners = new GridField("Banners", "Banners:", $this->Banners(), $gfConfig);
		$fields->addFieldToTab("Root.Banners", $fldBanners);

		$fields->addFieldToTab("Root.OtherImages", $fldOtherImages = new SortableUploadField("OtherImages", "Other images:"));
		$fldOtherImages->setAllowedFileCategories("image"); //"doc"
		$fldOtherImages->setFolderName('Uploads/otherimages/' . $this->ID);
		$fldOtherImages->setFileEditFields('getCustomFields');
		$fldOtherImages->setAllowedMaxFileNumber(20);
		$fldOtherImages->getValidator()->setAllowedMaxFileSize(52428800);

		return $fields;
	}


	public static function gridConfig()
	{
		$gfColumns = new GridFieldDataColumns();
		$gfConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableRows('SortOrder'),
			new GridFieldSortableHeader(),
			$gfColumns, //new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		);
		return $gfConfig;
	}

	//return either the whole site config or an individual field
	public function getSiteConfig($field = "")
	{
		$config = SiteConfig::current_site_config();
		if ($field) {
			return $config->$field;
		} else {
			return $config;
		}
	}

	/*
     * Overrides the model in the core DataObject class
     * Primary objective of the function is to duplicate the blocks (and descendant block items) associated to this page - as opposed to sharing
     */
	public function duplicate($doWrite = true)
	{

		$className = $this->class;
		$map = $this->toMap();
		unset($map['Created']);
		$clone = new $className($map, false, $this->model);
		$clone->ID = 0;

		$clone->invokeWithExtensions('onBeforeDuplicate', $this, $doWrite);
		if ($doWrite) {
			$clone->write();
			$this->duplicateManyManyRelations($this, $clone);

			// STARTS:: specific to the Blocks relationship
			// check that the "Block" class exists - assuming if it does, the module is installed and the Page->Block relationship exists
			if (class_exists('Block')) {
				$oBlocks = $this->Blocks();
				if ($oBlocks->count() > 0) {
					foreach ($oBlocks as $oBlock) {
						//can't use the standard duplicate function as it copies relationships;
						$className = $oBlock->class;
						$map = $oBlock->toMap();
						unset($map['Created']);
						$oNewBlock = new $className($map, false, $oBlock->model);
						$oNewBlock->ID = 0;

						//$oNewBlock->write();
						$oNewBlock->writeToStage('Stage'); //defaults to writing straight to live
						$oNewBlock->publish('Stage', 'Live');

						if (count($oBlock->has_many()) > 0) {
							//now need to save all items within that block
							foreach ($oBlock->has_many() as $key => $itemClassName) {
								foreach ($oBlock->{$key}() as $hasmanyitem) {
									// Prepare the new item
									$itemMap = $hasmanyitem->toMap();
									unset($itemMap['Created']);
									$oNewItem = new $itemClassName($itemMap, false, $hasmanyitem->model);
									$oNewItem->ID = 0;
									$oNewItem->invokeWithExtensions('onBeforeWrite', $oNewItem);
									if ($oNewItem->hasExtension("Versioned")) {
										$oNewItem->writeToStage('Stage'); //defaults to writing straight to live
									} else {
										$oNewItem->write();
									}
									$oNewItem->invokeWithExtensions('onAfterWrite', $oNewItem);

									// Add the new item to the parent
									$oNewBlock->{$key}()->add($oNewItem, array("SortOrder" => $hasmanyitem->SortOrder));
								}
							}
						}
						/*
                         * Duplicates any many_many relationships on the original block - note that the related item is NOT duplicated, just the relationship
                         */
						if (count($oBlock->manyMany()) > 0) {
							//now need to save all items within that block
							foreach ($oBlock->manyMany() as $key => $itemClassName) {
								if ($key != "Pages") { //ignore the "Pages" relationship
									foreach ($oBlock->{$key}() as $manymanyitem) {
										// Add the item to the new parent block
										$oNewBlock->{$key}()->add($manymanyitem, array("SortOrder" => $manymanyitem->SortOrder));
									}
								}
							}
						}

						//add the new block - include the ManyMany fields
						$clone->Blocks()->add($oNewBlock, array("Sort" => $oBlock->Sort, "BlockArea" => $oBlock->BlockArea));
						//remove the old block
						$clone->Blocks()->remove($oBlock);
					}
				}
			}
			//ENDS:: specific to the Blocks relationship

		}
		$clone->invokeWithExtensions('onAfterDuplicate', $this, $doWrite);

		return $clone;
	}

	public function AssetsVersion()
	{
		$themeDistPath = "../" . SSViewer::get_theme_folder() . "/dist/";
		$currentTime = date("Ymd");
		$versioning = @file_get_contents($themeDistPath . '.version') ?: $currentTime;
		return $versioning;
	}

	// [OpenGraph functionality - override on individual classes]
	public function OGTitle()
	{
		return $this->Title;
	}

	public function OGImage()
	{
		return $this->MainImage();
	}

	public function OGDescription()
	{
		return $this->MetaDescription;
	}

	public function OGSiteName()
	{
		return $this->getSiteConfig()->Title;
	}

	public function OGTwitterSite()
	{
		return $this->getSiteConfig()->TwitterHandle;
	}

	// [/OpenGraph functionality - override on individual classes]

	public function debug7dots()
	{
		return singleton("Utility_Controller")->debug7dots();
	}

	public function isDebugMode()
	{
		return singleton("Utility_Controller")->isDebugMode();
	}

	public function getFooter()
	{
		return Footer::get()->First();
	}

	public function getNewsListPage()
	{
		return NewsListPage::get()->First();
	}

	public function getEventListPage()
	{
		return EventListPage::get()->First();
	}

	public function getContactPage()
	{
		return ContactPage::get()->First();
	}

	public function getMemberProfilePage()
	{
		return MemberProfilePage::get()->First();
	}

	public function getUploadImagesPage()
	{
		return UploadImagesPage::get()->First();
	}

	public function getOfficeListPage()
	{
		return OfficeListPage::get()->First();
	}

	public function getNewsGlobal($limit = NULL)
	{
		if ($oNewsListPage = $this->getNewsListPage()) {
			return $oNewsListPage->getNews($limit);
		}
	}

	public function getEventsGlobal($limit = NULL)
	{
		if ($oEventListPage = $this->getEventListPage()) {
			return $oEventListPage->getEvents($limit);
		}
	}

	public function getOfficesGlobal($limit = NULL)
	{
		if ($oOfficeListPage = $this->getOfficeListPage()) {
			return $oOfficeListPage->getAllOffices($limit);
		}
	}

	public function getBanners()
	{
		$filter = array(
			'PageID' => $this->ID,
			'DraftMode' => 0
		);
		$data = Banner::get()->filter($filter);
		return $data;
	}

	public function getMapLocations()
	{
		$filter = array(
			'PageID' => $this->ID,
			'DraftMode' => 0
		);
		$data = MapLocation::get()->filter($filter);
		return $data;
	}

	//used to ensure virtual pages still use the correct classname
	public function CustomClassName()
	{
		if ($this->CopyContentFromID > 0) {
			if ($this->CopyContentFrom()->ClassName == "NavigationModule") {
				return "NavigationModule_" . $this->CopyContentFrom()->ModuleLayout;
			} else {
				return $this->CopyContentFrom()->ClassName;
			}
		} else {
			return $this->ClassName;
		}
	}

	//tag data
	public function getAllTags($tagname = NULL)
	{
		if (!class_exists($tagname)) return false;

		return $tagname::get();

	}

	public function getBodyClass()
	{
		$bodyClass = array();

		if ($this->isLoggedIn()) $bodyClass[] = "loggedin";
		$bodyClass[] = $this->ClassName;

		return implode(" ", $bodyClass);
	}

	public function isLoggedIn()
	{
		if (Member::currentUser()) return true;
	}

	public function renderCookie() {
		if (!Cookie::get('SiteCookie')) {
			return $this->renderWith('CookieMessage');
		}
	}

}

class Page_Controller extends ContentController
{

	private static $allowed_actions = array(
		/**
		 * array (
		 *     'action', // anyone can access this action
		 *     'action' => true, // same as above
		 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
		 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
		 * );
		 **/
		//'contactForm', // anyone can access this action
		//'contactFormProcess' => true, // same as above
	);

	public function init()
	{
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

}
