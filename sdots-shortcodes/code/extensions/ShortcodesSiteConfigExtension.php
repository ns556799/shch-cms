<?php

class ShortcodesSiteConfigExtension extends DataExtension
{

    static $db = array(
        "SocialLinkLinkedIn" => "Text",
        "SocialLinkFacebook" => "Text",
        "SocialLinkTwitter" => "Text",
        "SocialLinkYouTube" => "Text",
        "SocialLinkPinterest" => "Text",
        "SocialLinkInstagram" => "Text",
    );

    static $has_one = array();

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Main", new TextField('AdminEmail', 'Admin email'));

        $fields->addFieldToTab("Root.Social", new TextField('SocialLinkLinkedIn', 'LinkedIn URL'));
        $fields->addFieldToTab("Root.Social", new TextField('SocialLinkFacebook', 'Facebook URL'));
        $fields->addFieldToTab("Root.Social", new TextField('SocialLinkTwitter', 'Twitter URL'));
        $fields->addFieldToTab("Root.Social", new TextField('SocialLinkYouTube', 'YouTube URL'));
        $fields->addFieldToTab("Root.Social", new TextField('SocialLinkPinterest', 'Pinterest URL'));
        $fields->addFieldToTab("Root.Social", new TextField('SocialLinkInstagram', 'Instagram URL'));

    }
}