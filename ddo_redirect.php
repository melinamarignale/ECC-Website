<?php
/***********************
Redirections Completel
 ***********************/
$site_FR = 'http://www.completel.fr';
//$site_FR = 'http://195.167.195.205';
//$site_FR = '';

$aRedirections = array(
    //'`^/mentions-legales$`'                             => $site_FR . '/Completel/Mentions-legales',
);

/**
 * Transformation de l'URI pour avoir une adresse dénuée de caractères spéciaux et exploitable
 */

$patternURI = array("'é'", "'è'", "'ë'", "'ê'", "'É'", "'È'", "'Ë'", "'Ê'", "'á'", "'à'", "'ä'", "'â'", "'å'", "'Á'", "'À'", "'Ä'", "'Â'", "'Å'", "'ó'", "'ò'", "'ö'", "'ô'", "'Ó'", "'Ò'", "'Ö'", "'Ô'", "'í'", "'ì'", "'ï'", "'î'", "'Í'", "'Ì'", "'Ï'", "'Î'", "'ú'", "'ù'", "'ü'", "'û'", "'Ú'", "'Ù'", "'Ü'", "'Û'", "'ý'", "'ÿ'", "'Ý'", "'ø'", "'Ø'", "'œ'", "'Œ'", "'Æ'", "'ç'", "'Ç'");
$replaceURI = array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'I', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'y', 'y', 'Y', 'o', 'O', 'a', 'A', 'A', 'c', 'C');
$requestURI = preg_replace($patternURI, $replaceURI, urldecode($_SERVER['REQUEST_URI']));

foreach($aRedirections as $pattern => $redirectUri){
    if(preg_match($pattern, $requestURI) == 1){
        eZHTTPTool::redirect( $redirectUri, array(), 301 );
        eZExecution::cleanExit();
    }
}

/**
 * Cas particulier : capture de $_GET
 */

$redirectMask = array(
    '`^/recherche\?searchword=(.*)$`' => $site_FR . '/content/search?SearchText=$1',
);

foreach($redirectMask as $pattern => $redirectUri){
    if( ($newUrl = preg_replace($pattern, $redirectUri, $requestURI) ) != $requestURI){
        eZHTTPTool::redirect( $newUrl, array(), 301 );
        eZExecution::cleanExit();
    }
}