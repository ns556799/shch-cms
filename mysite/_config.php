<?php

// All modules installed using composer.
// /composer.json contains all dependencies.
// run this command to update all modules: composer update

global $project;
$project = 'mysite';

global $database;
$database = '';

require_once('conf/ConfigureFromEnv.php');

// To change theme edit mysite/_config/config.yml
// SSViewer::set_theme('base');

// Set the site locale
i18n::set_locale('en_GB');

// Alert to any deprecated code for SS versions below 3.0.0
Deprecation::notification_version('3.2.1');

if(Director::isDev()) SSViewer::flush_template_cache();

//Extensions and custom classes
Object::add_extension('Member', 'CustomMember');
Object::add_extension('Group', 'CustomGroup');
Object::useCustomClass('MemberLoginForm', 'CustomLoginForm');
Object::add_extension('SiteConfig', 'CustomSiteConfig');
Image::add_extension('CustomImage');

ShortcodeParser::get('default')->register('dates', function($arguments, $address, $parser, $shortcode) {
	$format = $arguments['format'];
    $date = date("$format");
    return sprintf(
        '%s',
        $date
    );
});


FulltextSearchable::enable();

$richTextEditor = HtmlEditorConfig::get('cms');
$richTextEditor->setOption('content_css', 'themes/'.SSViewer::current_theme().'/dist/editor-bundle.css');
$richTextEditor->enablePlugins('lists');

Director::addRules(100, array('utility//$Action/$ID' => 'Utility_Controller'));

GD::set_default_quality(100);

//LeftAndMain::require_themed_css('cms');
Config::inst()->update('SiteTree', 'create_default_pages', false);
CustomSiteConfig::setCustomCreateDefaultPages(true);

//Default behaviour - 'quoted-printable' - causes issues with "=" being inserted into the messages
Config::inst()->update('Mailer', 'default_message_encoding', "base64");
