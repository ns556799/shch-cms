<?php

class ButtonShortCode extends ViewableData
{

    public static function ButtonShortCodeMethod($arguments, $content = NULL, $parser = NULL, $tagName)
    {
        $classes = array();
        $classes[] = isset($arguments['size']) && strlen($arguments['size']) > 2 ? '-' . $arguments['size'] : '';
        $classes[] = isset($arguments['style']) && strlen($arguments['style']) > 2 ? '-' . $arguments['style'] : '';
        $classes[] = isset($arguments['action']) && strlen($arguments['action']) > 2 ? '-' . $arguments['action'] : '';
        $text = isset($arguments['text']) && strlen($arguments['text']) > 2 ? $arguments['text'] : 'Click here';
        return '<span class="btn ' . implode(' ', $classes) . '" href="/">' . $text . '</span>'; //.Controller::curr()->ID;
    }

}