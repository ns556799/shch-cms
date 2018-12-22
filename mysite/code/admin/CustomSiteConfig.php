<?php
 class CustomSiteConfig extends DataExtension {
     
    static $db = array(
        "AdminEmail" => "Text",
        "AdminPhone" => "Text",
        "AdminAddress" => "HTMLText",
    );
	
	static $has_one = array(
    );
 
    public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab("Root.Contact", new TextField('AdminEmail','Admin email'));
		$fields->addFieldToTab("Root.Contact", new TextField('AdminPhone','Admin Phone'));
		$fields->addFieldToTab("Root.Contact", new TextareaField('AdminAddress','Admin Address'));
    }
	
	static $custom_create_default_pages = true;

	public static function setCustomCreateDefaultPages($state = false) {
		self::$custom_create_default_pages = $state;
	}

	public static function getCustomCreateDefaultPages() {
		return self::$custom_create_default_pages;
	}		
	
	public function requireDefaultRecords() {
		parent::requireDefaultRecords();

		//if($this->class == 'SiteTree' && SiteTree::config()->create_default_pages) { //default function
		if(class_exists("HomePage") && CustomSiteConfig::getCustomCreateDefaultPages()) {
			if(!SiteTree::get_by_link(Config::inst()->get('RootURLController', 'default_homepage_link'))) {
				$oHomePage = new HomePage();
				$oHomePage->Title = "Home";
				$oHomePage->Content = "<p>Welcome to the homepage</p>";
				$oHomePage->URLSegment = Config::inst()->get('RootURLController', 'default_homepage_link');
				$oHomePage->Sort = 1;
				$oHomePage->write();
				$oHomePage->publish('Stage', 'Live');
				$oHomePage->flushCache();
				DB::alteration_message('Home page created', 'created');
			}

		}
		
		// default page
		if(class_exists("ContentPage") && CustomSiteConfig::getCustomCreateDefaultPages()) {

			if(DB::query("SELECT COUNT(*) FROM `SiteTree` WHERE `ClassName` = 'ContentPage'")->value() == 0) {
				$oPage = new ContentPage();
				$oPage->Title = "Default styles";
				$oPage->Content = <<<MARKER

<h1>This is a heading 1 with <a href="[sitetree_link,id=1]">a link</a> <em>and emphasis</em></h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. <a href="[sitetree_link,id=1]">Pellentesque pharetra</a> risus id lorem ullamcorper tristique. Cras nunc felis, euismod non aliquam et, hendrerit ac felis.</p>
<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. Pellentesque <em>pharetra risus id lorem ullamcorper</em> tristique. <span style="text-decoration: underline;">Cras nunc felis</span>, euismod non aliquam et, hendrerit ac felis.</p>
<h2>This is a heading 2 with <a href="[sitetree_link,id=1]">a link</a> <em>and emphasis</em></h2>
<p>Fusce convallis pretium neque, id ultrices arcu pretium vel. Nulla eget tempus erat. Etiam aliquet, neque nec rutrum mattis, risus magna elementum nisi, sed ultrices arcu purus id tortor. Duis nec condimentum orci. Ut a odio eget justo iaculis ornare a vel elit.</p>
<p>Some bullet points:</p>
<ul>
<li>Integer mattis sollicitudin <a href="[sitetree_link,id=1]">this is a link</a> massa, ac imperdiet sapien viverra in.</li>
<li>Mauris ultricies elit sed nulla pulvinar adipiscing.
	<ul>
		<li>A sublist item.</li>
		<li>Integer mattis sollicitudin <a href="[sitetree_link,id=1]">this is a link</a> massa, ac imperdiet sapien viverra in.</li>
		<li>Mauris ultricies elit sed nulla pulvinar adipiscing.
	</ul>
</li>
<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>
<li>Nam ac est eget est feugiat dictum et at augue.</li>
</ul>
<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus eu lorem a tortor mollis posuere at nec est. Morbi ac laoreet lorem. Sed imperdiet orci quis enim pharetra vel posuere sapien luctus. Sed sit amet leo ut mauris varius fringilla.</p>
<p>And now for an ordered list:</p>
<ol>
<li>Integer mattis sollicitudin <a href="[sitetree_link,id=1]">this is a link</a> massa, ac imperdiet sapien viverra in.</li>
<li>Mauris ultricies elit sed nulla pulvinar adipiscing.</li>
<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>
<li>Nam ac est eget est feugiat dictum et at augue.</li>
</ol>
<p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis.</p>
<h3>This is a heading 3 with <a href="[sitetree_link,id=1]">a link</a> <em>and emphasis</em></h3>
<p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis. Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>
<hr />
<p>&nbsp;</p>
<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>
<p style="text-align: center;">Some centred text</p>
<p style="text-align: center;">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>
<p style="text-align: left;">Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>
<h2>Another heading 2 immediately followed by...</h2>
<h3>A heading 3</h3>
<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>
<p>And now a blockquote:</p>
<blockquote>
<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>
</blockquote>
<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>
<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>
<p>&nbsp;</p>
										
MARKER;
				$oPage->Sort = 2;
				$oPage->write();
				$oPage->publish('Stage', 'Live');
				$oPage->flushCache();
				DB::alteration_message('Default styles page created', 'created');
			}
		}
		
		//create a footer and add a T&Cs and Privacy Policy page underneath
		if(class_exists("Footer") && CustomSiteConfig::getCustomCreateDefaultPages()) {

			if(DB::query("SELECT COUNT(*) FROM `SiteTree` WHERE `ClassName` = 'Footer'")->value() == 0) {
				$oFooter = new Footer();
				$oFooter->Title = "Company";
				$oFooter->Sort = 3;
				$oFooter->write();
				$oFooter->publish('Stage', 'Live');
				$oFooter->flushCache();
				DB::alteration_message('Footer created', 'created');
				
				if(class_exists("ContentPage")){
					
					$arrPageTitles = array("Terms and conditions", "Privacy policy");
					
					foreach($arrPageTitles as $pageTitle){
						$oContentPage = new ContentPage();
						$oContentPage->Title = $pageTitle;
						$oContentPage->ParentID = $oFooter->ID;
						$oContentPage->write(); 
						$oContentPage->publish('Stage', 'Live');
						$oContentPage->flushCache();
					}
				}
			
			}
		}	
		
		//create a footer and add a T&Cs and Privacy Policy page underneath
		if(class_exists("Header") && CustomSiteConfig::getCustomCreateDefaultPages()) {

			if(DB::query("SELECT COUNT(*) FROM `SiteTree` WHERE `ClassName` = 'Header'")->value() == 0) {
				$oHeader = new Header();
				$oHeader->Title = "Header";
				$oHeader->Sort = 3;
				$oHeader->write();
				$oHeader->publish('Stage', 'Live');
				$oHeader->flushCache();
				DB::alteration_message('Header created', 'created');
				
			}
		}
		
		//create the default Error pages
		Config::inst()->update('SiteTree', 'create_default_pages', true);
		singleton("ErrorPage")->requireDefaultRecords();
		Config::inst()->update('SiteTree', 'create_default_pages', false);
		
		// create a "System" folder and move error pages into it
		if(class_exists("CmsFolder") && CustomSiteConfig::getCustomCreateDefaultPages()) {

			if(DB::query("SELECT COUNT(*) FROM `SiteTree` WHERE `ClassName` = 'CmsFolder'")->value() == 0) {
				$oPage = new CmsFolder();
				$oPage->Title = "System";
				$oPage->Sort = 4;
				$oPage->write();
				$oPage->publish('Stage', 'Live');
				$oPage->flushCache();
				DB::alteration_message('System folder created', 'created');
				
				if($oErrorPage404 = ErrorPage::get()->filter(array("ErrorCode" => "404"))->First()){
					$oErrorPage404->ParentID = $oPage->ID;
					$oErrorPage404->write(); 
					$oErrorPage404->publish('Stage', 'Live');
					$oErrorPage404->flushCache();
				}
				
				if($oErrorPage500 = ErrorPage::get()->filter(array("ErrorCode" => "500"))->First()){
					$oErrorPage500->ParentID = $oPage->ID;
					$oErrorPage500->write(); 
					$oErrorPage500->publish('Stage', 'Live');
					$oErrorPage500->flushCache();
				}				
				
			}
		}			
		
	}		
}
