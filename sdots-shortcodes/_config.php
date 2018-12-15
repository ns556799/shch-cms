<?php

if (!defined('SHORTCODES_DIR')) {
    define('SHORTCODES_DIR', rtrim(basename(dirname(__FILE__))));
}

$richTextEditor->enablePlugins(array('shortCodes' => '../../../sdots-shortcodes/javascript/shortcodes/shortcodes.js'));
$richTextEditor->insertButtonsAfter('anchor', 'shortCodes');
ShortcodeParser::get('default')->register('button', array('ButtonShortCode', 'ButtonShortCodeMethod'));
ShortcodeParser::get('default')->register('newsletter', array('NewsletterShortCode', 'NewsletterShortCodeMethod'));
ShortcodeParser::get('default')->register('socials', array('SocialsShortCode', 'SocialsShortCodeMethod'));