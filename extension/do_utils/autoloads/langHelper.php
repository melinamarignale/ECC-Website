<?php
//
// Definition of eZOETemplateUtils class
//
// Created on: <14-May-2008 18:42:08 ar>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Online Editor
// SOFTWARE RELEASE: 4.4.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2010 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*
 Some misc template operators to get access to some of the features in eZ Publish API

*/

class langHelper
{
    function langHelper()
    {
    }

    function operatorList()
    {
        return array( 'get_url_alias_by_lang' );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array( 'get_url_alias_by_lang' => array( 'node_id' => array(
                                                       'type' => 'integer',
                                                       'required' => false,
                                                       'default' => 2),
                                                   'lang_code' => array(
                                                       'type' => 'string',
                                                       'required' => false,
                                                       'default' => 'fre-FR' )
                                           ));
    }

    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    {
        $ret = '';

        switch ( $operatorName )
        {
            case 'get_url_alias_by_lang':
                {

					$node = eZContentObjectTreeNode::fetch( $namedParameters['node_id'], $namedParameters['lang_code'] );
					$originalPrioritizedLanguages = eZContentLanguage::prioritizedLanguageCodes();
					eZContentLanguage::setPrioritizedLanguages( array( $namedParameters['lang_code'] ) );
					$urlAlias = '';
					if(is_object($node))
						$urlAlias = '/'.$node->urlAlias();
					eZContentLanguage::setPrioritizedLanguages( $originalPrioritizedLanguages );
			        $ret = $urlAlias;


            } break;
        }
        $operatorValue = $ret;
    }

}

?>
