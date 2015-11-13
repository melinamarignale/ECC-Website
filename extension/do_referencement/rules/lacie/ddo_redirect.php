<?php
/***********************
Redirections La Compagnie 1973
 ***********************/

//$site_FR = 'http://www.lacompagnie1973.fr';
$site_FR = 'http://local.lacompagnie.fr';
//$site_EN = 'http://www.eurosearch-associes.com';

$aRedirections = array(
    '`^/nos-services.html$`'         				=> $site_FR . '/',
    '`^/la-course-ecologique-11.html$`'        	    => $site_FR . '/Coursier-Paris/Coursier-velo-Paris',
    '`^/le-coursier-parisien-11.html$`'        	    => $site_FR . '/Coursier-Paris/Coursier-velo-Paris',
    '`^/le-coursier-parisien-23.html$`'        	    => $site_FR . '/Coursier-Paris',
    '`^/vos-colis-en-ile-de-france-12.html$`'       => $site_FR . '/Transport-Express/Transport-express-Ile-de-France',
    '`^/vos-envois-en-nombre-15.html$`'        	    => $site_FR . '/Plate-forme-logistique/Logistique-et-transport-operations-de-distribution',
    '`^/la-logistique-evenementielle-14.html$`'     => $site_FR . '/Logistique-evenementielle-salon-congres',
    '`^/logistique-evenementielle-14.html$`'        => $site_FR . '/Logistique-evenementielle-salon-congres',
    '`^/le-stockage-intelligent-16.html$`'        	=> $site_FR . '/Plate-forme-logistique/Stockage-et-logistique-de-proximite',
    '`^/stockage-intelligent-16.html$`'        	    => $site_FR . '/Plate-forme-logistique/Stockage-et-logistique-de-proximite',
    '`^/laffretement-17.html$`'        	            => $site_FR . '/Transport-Express/Affretement-transport-routier',
    '`^/affretement-17.html$`'        	            => $site_FR . '/Transport-Express/Affretement-transport-routier',
    '`^/la-france-j-1-13.html$`'        	        => $site_FR . '/Transport-Express/Transport-en-France-J-1',
    '`^/la-france-en-quelques-heures-20.html$`'     => $site_FR . '/Transport-Express/Transport-express-en-France-en-quelques-heures',
    '`^/ma-planete.html$`'        	                => $site_FR . '/Ma-Planete',
    '`^/environnement-21.html$`'        	        => $site_FR . '/Ma-Planete/Notre-charte-Environnement-et-Logistique',
    '`^/eco-responsabilite-22.html$`'        	    => $site_FR . '/Ma-Planete/Notre-charte-Environnement-et-Logistique',
    '`^/demande-de-devis.html$`'        	        => $site_FR . '/contact/form/devis',
    '`^/acces-a-nos-locaux.html$`'        	        => $site_FR . '/contact/form/info',
    '`^/qui-sommes-nous.html$`'        	            => $site_FR . '/A-propos',
    '`^/contact.html$`'        	                    => $site_FR . '/contact/form/info',
    '`^/news.html$`'        	                    => $site_FR . '/Actualites',
    '`^/recrutement-partenariat.html$`'        	    => $site_FR . '/Recrutement',
);

$requestURI = $_SERVER['REQUEST_URI'];

foreach($aRedirections as $pattern => $redirectUri){
    if(preg_match($pattern, $requestURI) == 1){
        eZHTTPTool::redirect( $redirectUri, array(), 301 );
        eZExecution::cleanExit();
    }
}