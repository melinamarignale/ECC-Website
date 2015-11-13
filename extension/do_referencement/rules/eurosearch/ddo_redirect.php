<?php
/***********************
Redirections Eurosearch
 ***********************/
$site_FR = 'http://local.eurosearch.com';
$site_EN = 'http://local.eurosearch.en.com';

$site_FR = 'http://www.eurosearch-associes.com';
$site_EN = 'http://www.eurosearch-associes.com';

$aRedirections = array(
    '`^/(?:index.php)?\?menu=0`'         => $site_FR . '/',
    '`^/(?:index.php)?\?menu=2`'         => $site_FR . '/Expertises',
    '`^/(?:index.php)?\?menu=3`'         => $site_FR . '/Equipe',
    '`^/(?:index.php)?\?menu=5`'         => $site_FR . '/Implantation',
    '`^/(?:index.php)?\?menu=6`'         => $site_FR . '/',
    '`^/(?:index.php)?\?menu=7`'         => $site_FR . '/Publications',
    '`^/(?:index.php)?\?menu=8`'         => $site_FR . '/contact/info',
    '`^/(?:index.php)?\?menu=4$`'        => $site_FR . '/Nos-Offres',
    '`^/(?:index.php)?\?menu=4_1_5`'     => $site_FR . '/Nos-Offres/Recherche-de-Dirigeants',
    '`^/(?:index.php)?\?menu=4_2_0`'     => $site_FR . '/Nos-Offres/Management-de-Transition',
    '`^/(?:index.php)?\?menu=4_2_2`'     => $site_FR . '/Nos-Offres/Management-de-Transition/Gouvernance-et-Management-de-transition',
    '`^/(?:index.php)?\?menu=4_2_1`'     => $site_FR . '/Nos-Offres/Management-de-Transition/Diagnostic-et-accompagnement-operationnels',
    '`^/(?:index.php)?\?menu=4_2_3`'     => $site_FR . '/Nos-Offres/Management-de-Transition/Prise-de-mandat-social-non-executif',
    '`^/(?:index.php)?\?menu=4_1_1`'     => $site_FR . '/Nos-Offres/Dynamique-Manageriale/La-revue-de-management',
    '`^/(?:index.php)?\?menu=4_1_4`'     => $site_FR . '/Nos-Offres/Dynamique-Manageriale/L-evaluation-Individuelle',
    '`^/newsletter/2011-novembre.htm`'   => $site_FR . '/Publications/Edito/Neswletter-de-novembre-2011',
    '`^/newsletter/2012-mars.htm`'       => $site_FR . '/Publications/Edito/Newsletter-de-mars-2012',
    '`^/index_us.php$`'                  => $site_EN . '/',
    '`^/index_us.php\?menu=0`'           => $site_EN . '/',
    '`^/index_us.php\?menu=2`'           => $site_EN . '/Areas-of-expertise',
    '`^/index_us.php\?menu=3`'           => $site_EN . '/Team',
    '`^/index_us.php\?menu=5`'           => $site_EN . '/Locations',
    '`^/index_us.php\?menu=6`'           => $site_EN . '/',
    '`^/index_us.php\?menu=7`'           => $site_EN . '/Publications',
    '`^/index_us.php\?menu=8`'           => $site_EN . '/contact/info',
    '`^/index_us.php\?menu=4$`'          => $site_EN . '/Offers',
    '`^/index_us.php\?menu=4_1_5`'       => $site_EN . '/Offers/Recherche-de-Dirigeants',
    '`^/index_us.php\?menu=4_2_0`'       => $site_EN . '/Offers/Management-de-Transition',
    '`^/index_us.php\?menu=4_2_2`'       => $site_EN . '/Offers/Management-de-Transition/Gouvernance-et-Management-de-transition',
    '`^/index_us.php\?menu=4_2_1`'       => $site_EN . '/Offers/Management-de-Transition/Diagnostic-et-accompagnement-operationnels',
    '`^/index_us.php\?menu=4_2_3`'       => $site_EN . '/Offers/Management-de-Transition/Prise-de-mandat-social-non-executif',
    '`^/index_us.php\?menu=4_1_1`'       => $site_EN . '/Offers/Dynamique-Manageriale/La-revue-de-management',
    '`^/index_us.php\?menu=4_1_4`'       => $site_EN . '/Offers/Dynamique-Manageriale/L-evaluation-Individuelle',
);

$requestURI = $_SERVER['REQUEST_URI'];

foreach($aRedirections as $pattern => $redirectUri){
    if(preg_match($pattern, $requestURI) == 1){
        eZHTTPTool::redirect( $redirectUri, array(), 301 );
        eZExecution::cleanExit();
    }
}