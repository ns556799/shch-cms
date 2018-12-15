<?php

class NewsletterShortCode extends ViewableData
{

    public static function NewsletterShortCodeMethod($arguments, $content = NULL, $parser = NULL, $tagName)
    {

        //get the newsletter and return the code snippet

        if(!isset($arguments['id']) || !is_numeric($arguments["id"])) return;

        $oNewsletterSnippet = NewsletterSnippet::get()->byID($arguments['id']);

        return "<div class='newsletter-wrapper'>".$oNewsletterSnippet->Snippet."</div>";
    }

}