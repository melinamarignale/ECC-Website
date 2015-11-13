<?php
//
// Created on: <09-Dec-2005 16:22:43 hovik>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// COPYRIGHT NOTICE: Copyright (C) 1999-2006 eZ systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*! \file operation_definition.php
*/

$OperationList = array();
$OperationList['register_subscription'] = array( 'name' => 'register_subscription',
                                                 'default_call_method' => array( 'include_file' => eZExtension::baseDirectory() . '/eznewsletter/module/newsletter/eznewsletteroperationcollection.php',
                                                                                 'class' => 'eZRegisterSubscription' ),
                                                 'parameter_type' => 'standard',
                                                 'parameters' => array( array( 'name' => 'subscription_id',
                                                                               'type' => 'integer',
                                                                               'required' => true ) ),
                                                 'keys' => array( 'node_id' ),
                                                 'body' => array( array( 'type' => 'trigger',
                                                                         'name' => 'pre_register',
                                                                         'keys' => array( 'subscription_id' ) ),
                                                                  array( 'type' => 'method',
                                                                         'name' => 'register_subscription',
                                                                         'frequency' => 'once',
                                                                         'method' => 'readObject' ) ) );

?>
