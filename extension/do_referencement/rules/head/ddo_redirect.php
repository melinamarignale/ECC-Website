<?php
/***********************
Redirections Ecole Head
 ***********************/

$site_FR = 'http://www.ecolehead.fr';
//$site_EN = 'http://www.eurosearch-associes.com';

$aRedirections = array(
    '`^/L-ecole$`'         				=> $site_FR . '/Ecole/Projet',
    '`^/Le-parcours-HEAD$`'        	 => $site_FR . '/Parcours',
    '`^/Candidature$`'         => $site_FR . '/contact/form/candidature',
    '`^/L-equipe-fondatrice$`'         => $site_FR . '/Ecole/Equipe',
    '`^/Financement$`'         => $site_FR . '/Admissions/Financement-des-etudes',
    '`^/Contact$`'         => $site_FR . '/Contact-HEAD',
    '`^/Les-valeurs$`'        => $site_FR . '/Ecole/Nos-Valeurs',
    '`^/Partenariats$`'     => $site_FR . '/Partenaires/Partenaires',
);

$requestURI = $_SERVER['REQUEST_URI'];

foreach($aRedirections as $pattern => $redirectUri){
    if(preg_match($pattern, $requestURI) == 1){
        eZHTTPTool::redirect( $redirectUri, array(), 301 );
        eZExecution::cleanExit();
    }
}