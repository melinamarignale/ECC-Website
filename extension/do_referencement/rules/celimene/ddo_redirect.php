<?php
/***********************
Redirections Eurosearch
 ***********************/
$site_FR = 'http://www.celimene-daudet.com';
$site_EN = 'http://en.celimene-daudet.com';

$aRedirections = array(

    '`^/home-en$`'                       => $site_EN . '/',

    '`^/agenda-fr$`'                     => $site_FR . '/Agenda',
    '`^/agenda-en$`'                     => $site_EN . '/Agenda',

    '`^/audio-fr$`'                      => $site_FR . '/Multimedia/Audio',
    '`^/audio-en$`'                      => $site_EN . '/Multimedia/Audio',

    '`^/discography-fr$`'                => $site_FR . '/Discographie',
    '`^/discography-en$`'                => $site_EN . '/Discography',

    '`^/press-en$`'                      => $site_EN . '/Press/Articles',
    '`^/press-fr$`'                      => $site_FR . '/Presse/Articles',

    '`^/repertoire-fr$`'                 => $site_FR . '/Repertoire/Solo',
    '`^/repertoire-en$`'                 => $site_EN . '/Repertoire/Solo',

    '`^/biography-fr$`'                  => $site_FR . '/Biographie',
    '`^/biography-en$`'                  => $site_EN . '/Profile',

    '`^/contact-fr$`'                    => $site_FR . '/Contact',
    '`^/contact-en$`'                    => $site_EN . '/Contact',

    '`^/photos-en$`'                     => $site_EN . '/Photos',
    '`^/photos-fr$`'                     => $site_FR . '/Galerie',

    '`^/pro-fr$`'                        => $site_FR . '/Espace-Pro',
    '`^/pro-en$`'                        => $site_EN . '/Pro-Area',

);

$requestURI = $_SERVER['REQUEST_URI'];

foreach($aRedirections as $pattern => $redirectUri){
    if(preg_match($pattern, $requestURI) == 1){
        eZHTTPTool::redirect( $redirectUri, array(), 301 );
        eZExecution::cleanExit();
    }
}