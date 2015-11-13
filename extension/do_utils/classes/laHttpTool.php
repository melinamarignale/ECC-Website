<?php

class laHttpTool
{


    public static function getDataByURL( $url, array $aCurlParams = array(), $justCheckURL = false, $userAgent = false )
    {
        if (in_array(CURLOPT_RETURNTRANSFER, $aCurlParams) && isset($aCurlParams[CURLOPT_RETURNTRANSFER]) && !$aCurlParams[CURLOPT_RETURNTRANSFER]) {
            $justCheckURL = true;
        } else {
            $aCurlParams[CURLOPT_RETURNTRANSFER] = true;
        }

        if (!extension_loaded( 'curl' )
        || !count($aCurlParams)
        ) {
            return eZHTTPTool::getDataByURL($url, $justCheckURL, $userAgent);
        }

        $ch = curl_init( $url );
        if ( $justCheckURL )
        {
            curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 2 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 15 );
            curl_setopt( $ch, CURLOPT_FAILONERROR, 1 );
            curl_setopt( $ch, CURLOPT_NOBODY, 1 );
        }

        if ( $userAgent )
        {
            curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );
        }

        $ini = eZINI::instance();
        $proxy = $ini->hasVariable( 'ProxySettings', 'ProxyServer' ) ? $ini->variable( 'ProxySettings', 'ProxyServer' ) : false;
        // If we should use proxy
        if ( $proxy )
        {
            curl_setopt ( $ch, CURLOPT_PROXY , $proxy );
            $userName = $ini->hasVariable( 'ProxySettings', 'User' ) ? $ini->variable( 'ProxySettings', 'User' ) : false;
            $password = $ini->hasVariable( 'ProxySettings', 'Password' ) ? $ini->variable( 'ProxySettings', 'Password' ) : false;
            if ( $userName )
            {
                curl_setopt ( $ch, CURLOPT_PROXYUSERPWD, "$userName:$password" );
            }
        }



        foreach ($aCurlParams as $iCurlOption => $mCurlParam)
        {
            curl_setopt($ch, $iCurlOption, $mCurlParam);
        }


        // If we should check url without downloading data from it.
        if ( $justCheckURL )
        {
            if ( !curl_exec( $ch ) )
            {
                curl_close( $ch );
                return false;
            }

            curl_close( $ch );
            return true;
        }

        // Getting data
        // ob_start();
        $data=curl_exec( $ch );

        $responseCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        if ($responseCode!=200 || !$data )
        {
            curl_close( $ch );
            //   ob_end_clean();
            return false;
        }

        curl_close ( $ch );
        // $data = ob_get_contents();
        // ob_end_clean();


        return $data;

    }


}
