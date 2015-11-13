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

class arrayHelper
{
    function arrayHelper()
    {
    }

    function operatorList()
    {
        return array( 'array_chunk', 'real_strip_tags', 'get_range', 'tronque_mot_entier' );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            'array_chunk' => array(
                'input_array' => array(
                    'type' => 'array',
                    'required' => true,
                    'default' => 2
                ),
                'size' => array(
                    'type' => 'integer',
                    'required' => true,
                    'default' => ''
                )
            ),
            'real_strip_tags' => array(
                'allowable_tags' => array(
                    'type' => 'string',
                    'required' => false,
                    'default' => ''
                )
            ),
            'get_range' => array(
                'start' => array(
                    'type' => 'mixed',
                    'required' => true
                ),
                'end' => array(
                    'type' => 'mixed',
                    'required' => true
                ),
                'step' => array(
                    'type' => 'integer',
                    'required' => false,
                    'default' => 1
                )
            ),
            'tronque_mot_entier' => array(
                'pageReturn' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => ''
                ),
                'nb_caractere' => array(
                    'type' => 'integer',
                    'required' => true,
                    'default' => 150
                )
            )
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    {
        $ret = '';
        switch ( $operatorName )
        {
            case 'array_chunk':
                {
                	$ret = array_chunk($namedParameters['input_array'], $namedParameters['size']);
            } break;
            case 'real_strip_tags':
            {
                $ret = strip_tags($operatorValue, $namedParameters['allowable_tags']);
            }
            break;
            case 'get_range':
            {
                $ret = range($namedParameters['start'], $namedParameters['end'], $namedParameters['step']);
            }
            break;
            case 'tronque_mot_entier':
            {
                $ret = self::tronque_mot_entier($namedParameters['pageReturn'], $namedParameters['nb_caractere']);
            } break;
        }
        $operatorValue = $ret;
    }

    static function tronque_mot_entier($pageReturn,$nb_caractere)
    {
        $val="";
        if((is_numeric($nb_caractere))&& ($nb_caractere>=0))
        {
            $pageReturn = trim($pageReturn);
            if(mb_strlen($pageReturn)>$nb_caractere){
                $pageReturn=mb_substr($pageReturn, 0, $nb_caractere);
                $pageReturn=explode(" ", $pageReturn);
                $cmp=count($pageReturn);
                $cmpd=1;

                foreach($pageReturn as $pageReturns ){
                    if($cmpd<($cmp-1)){
                        $val.=$pageReturns." ";
                    }
                    else
                    {
                        $val.=$pageReturns."...";
                        break;
                    }
                    $cmpd=$cmpd+1;
                }
            }
            else
            {
                $val.=$pageReturn;
            }
        }
        else
        {
            $val.=$pageReturn;
        }
        return $val;
    }

}
