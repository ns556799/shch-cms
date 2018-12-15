<?php

class SocialsShortCode extends ViewableData{

    static $oSiteConfig = NULL;

    public static function SocialsShortCodeMethod($arguments, $content = NULL, $parser = NULL, $tagName){

        if (isset($arguments['links']) && $arguments['links'] != "") {
            $SocialLis = array();

            $socials = array_map('trim', explode(",", $arguments['links']));

            if (count($socials) > 0) {

                self::$oSiteConfig = SiteConfig::current_site_config();

                foreach ($socials as $social) {
                    $SocialLis[] = SocialsShortCode::getSocialLinkLi($social);
                }
                //return SVGs:
                return '<ul class="social-links">' . implode(' ', $SocialLis) . '</ul>';

            }

        }

    }

    public static function getSocialLinkLi($channel = NULL){

        $oSiteConfig = self::$oSiteConfig;

        $fieldname = "SocialLink" . $channel;
        $url = $oSiteConfig->{$fieldname}; //error trap in case no field
        if ($url == "") return;
        if (!$svg = SocialsShortCode::getSVG($channel)) return;

        $cssclass = "-" . strtolower($channel);

        $HTML = <<<EOT
        <li class="social-link__item $cssclass">
                <a href="$url" class="social-link__item-link" target="_blank">
                    $svg
                </a>
        </li>
EOT;

        return $HTML;
    }

    public static function getSVG($channel = NULL){
        switch ($channel) {
            case "Facebook":
                return <<<EOT
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                            <title>Facebook</title>
                            <g>
                                <path d="M8.38,10H9.92c.2,0,.29,0,.29-.28,0-.82,0-1.64,0-2.46a3.05,3.05,0,0,1,2.57-3.15A7.22,7.22,0,0,1,14,3.95c.86,0,1.71,0,2.57,0h.25v3.2h-2A.85.85,0,0,0,14,8c0,.62,0,1.24,0,1.91h2.87L16.51,13H14v9H10.21V13H8.38Z"></path>
                            </g>
                        </svg>                
EOT;
                break;
            case "Instagram":
                return <<<EOT
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                        <title>Instagram</title>
                        <path class="cls-2" d="M13,10.7A2.3,2.3,0,1,0,15.3,13,2.28,2.28,0,0,0,13,10.7Z"></path>
                        <path class="cls-2" d="M19.74,9a3.66,3.66,0,0,0-3.49-2.91c-.16,0-.32,0-.47-.06H10.23c-.37.05-.75.09-1.12.17a3.68,3.68,0,0,0-3,3.52c0,.16,0,.32-.06.47v5.54c.05.36.09.73.16,1.09a3.69,3.69,0,0,0,3.53,3c.18,0,.36,0,.54.07h5.34c.44-.06.89-.09,1.32-.2a3.66,3.66,0,0,0,2.9-3.49c0-.2,0-.41.07-.61V10.3C19.87,9.88,19.84,9.45,19.74,9ZM13,16.55A3.55,3.55,0,1,1,16.55,13,3.53,3.53,0,0,1,13,16.55Zm3.72-6.41a.86.86,0,0,1-.85-.82.83.83,0,0,1,.83-.84.8.8,0,0,1,.84.81A.83.83,0,0,1,16.71,10.14Z"></path>
                    </svg>            
EOT;
                break;
            case "Twitter":
                return <<<EOT
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                        <title>Twitter</title>
                        <path d="M21.69,7.9a6.75,6.75,0,0,1-1.94.53,3.39,3.39,0,0,0,1.48-1.87,6.76,6.76,0,0,1-2.14.82,3.38,3.38,0,0,0-5.75,3.08,9.59,9.59,0,0,1-7-3.53,3.38,3.38,0,0,0,1,4.51A3.36,3.36,0,0,1,5.89,11v0A3.38,3.38,0,0,0,8.6,14.37a3.39,3.39,0,0,1-1.53.06,3.38,3.38,0,0,0,3.15,2.35A6.78,6.78,0,0,1,6,18.22a6.87,6.87,0,0,1-.81,0A9.6,9.6,0,0,0,20,10.08q0-.22,0-.44A6.86,6.86,0,0,0,21.69,7.9Z"></path>
                    </svg>        
EOT;
                break;
            case "LinkedIn":
                return <<<EOT
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                        <title>LinkedIn</title>
                        <path class="cls-2" d="M6.67,10H9.58v9.36H6.67ZM8.13,5.32A1.69,1.69,0,1,1,6.44,7,1.69,1.69,0,0,1,8.13,5.32"/>
                        <path class="cls-2" d="M11.41,10H14.2v1.28h0A3.06,3.06,0,0,1,17,9.75c2.95,0,3.49,1.94,3.49,4.46v5.14H17.57V14.79c0-1.09,0-2.48-1.51-2.48s-1.75,1.18-1.75,2.4v4.63H11.41Z"/>
                    </svg>     
EOT;
                break;
            case "YouTube":
                return <<<EOT
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                        <title>YouTube</title>
                        <path d="M9.6,17.81,18.85,13,9.6,8.19Z"/>
                    </svg>   
EOT;
                break;
            case "Pinterest":
                return <<<EOT
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                        <title>Pinterest</title>
                        <path class="cls-2" d="M9.1,22.07a10.26,10.26,0,0,1,0-3.07c.19-.84,1.26-5.32,1.26-5.32a3.86,3.86,0,0,1-.32-1.59c0-1.49.86-2.6,1.94-2.6A1.34,1.34,0,0,1,13.36,11a21.56,21.56,0,0,1-.89,3.56,1.55,1.55,0,0,0,1.59,1.93c1.9,0,3.36-2,3.36-4.9A4.23,4.23,0,0,0,13,7.25a4.63,4.63,0,0,0-4.83,4.64,4.16,4.16,0,0,0,.8,2.44.32.32,0,0,1,.07.31l-.3,1.21c0,.2-.16.24-.36.14C7,15.37,6.16,13.42,6.16,11.85c0-3.38,2.45-6.48,7.07-6.48a6.28,6.28,0,0,1,6.6,6.18c0,3.69-2.33,6.66-5.55,6.66A2.86,2.86,0,0,1,11.83,17l-.67,2.54a12,12,0,0,1-1.33,2.81s-.19.29-.44.29S9.1,22.07,9.1,22.07Z"/>
                    </svg> 
EOT;
                break;
            case "App":
                return <<<EOT
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                        <title>App</title>
                        <path class="cls-2" d="M16.93,4.53H9.07A1.14,1.14,0,0,0,7.93,5.67V20.33a1.14,1.14,0,0,0,1.14,1.14h7.86a1.14,1.14,0,0,0,1.14-1.14V5.67A1.14,1.14,0,0,0,16.93,4.53Zm-5,1.07h2.23a.27.27,0,1,1,0,.53H11.88a.27.27,0,0,1,0-.53ZM13,20.84a.72.72,0,1,1,.72-.72A.72.72,0,0,1,13,20.84Zm4.19-2.06H8.81V7.21h8.38V18.79Z"/>
                    </svg>
EOT;
                break;

        }
    }
}