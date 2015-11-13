<?php


/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version  2012.8
 * @package kernel
 */

// Set a default time zone if none is given to avoid "It is not safe to rely
// on the system's timezone settings" warnings. The time zone can be overriden
// in config.php or php.ini.
if ( !ini_get( "date.timezone" ) )
{
    date_default_timezone_set( "UTC" );
}

ignore_user_abort( true );
error_reporting ( E_ALL | E_STRICT );

require 'autoload.php';

/**
 * HACK REDIRECTION 301
 */
if(file_exists('ddo_redirect.php')){
    require 'ddo_redirect.php';
}
/**
 * Fin hack redirect 301
 */

$kernel = new ezpKernel( new ezpKernelWeb() );
echo $kernel->run()->getContent();
