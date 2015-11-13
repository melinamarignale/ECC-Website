<?php
//
// Redirect - extension for eZ Publish
// Copyright (C) 2008 Seeds Consulting AS, http://www.seeds.no/
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of version 2.0 of the GNU General
// Public License as published by the Free Software Foundation.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
// MA 02110-1301, USA.
//

class RedirectOperator
{
    function RedirectOperator()
    {
        $this->Operators = array( 'redirect' );
    }

    function operatorList()
    {
        return $this->Operators;
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            'redirect' => array(
                'url' => array(
                    'type' => 'string',
                    'required' => true
                )
            )
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace,
                     $currentNamespace, &$operatorValue, $namedParameters )
    {
        $redirectUri = $namedParameters['url'];
        // if $redirectUri is not starting with scheme://
        if ( !preg_match( '#^\w+://#', $redirectUri ) )
        {
            // path to eZ Publish index
            $indexDir = eZSys::indexDir();

            /* We need to make sure we have one
               and only one slash at the concatenation point
               between $indexDir and $redirectUri. */
            $redirectUri = rtrim( $indexDir, '/' ) . '/' . ltrim( $redirectUri, '/' );
        }

        // Redirect to $redirectUri by returning status code 301 and exit.
        eZHTTPTool::redirect( $redirectUri, array(), 301 );
        eZExecution::cleanExit();
    }
}

?>
