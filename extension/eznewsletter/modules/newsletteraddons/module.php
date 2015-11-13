<?php
//
// Definition of Module class
//
// Created on: <29-Nov-2005 09:27:17 oms>
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

/*! \file module.php
*/

$Module = array( 'name' => 'eZNewsletter' );

$ViewList = array();

$ViewList['unregister_subscription'] = array(
    'script' => 'unregister_subscription.php',
    'default_navigation_part' => 'eznewsletter',
    'functions' => array( ),
    'params' => array( 'UserHash' ) );
    
$ViewList['subscription'] = array(
    'script' => 'subscription.php',
    'default_navigation_part' => 'eznewsletter',
    'functions' => array( ),
    'params' => array( ),
    'single_post_actions' => array( 'Add' => 'Add', 'Remove' => 'Remove' ),
    'post_action_parameters' => array( 'Add' => array( 'ChoosenSubscriptions' => 'ChoosenSubscriptions', 'AvialableSubscriptions' => 'AvialableSubscriptions', 'RedirectURI' => 'RedirectURI' ),
                                       'Remove' => array( 'ChoosenSubscriptions' => 'ChoosenSubscriptions', 'AvialableSubscriptions' => 'AvialableSubscriptions', 'RedirectURI' => 'RedirectURI' ) ),
	'unordered_params' => array(  ) );
$ViewList['register_subscription'] = array(
    'script' => 'register_subscription.php',
    'default_navigation_part' => 'eznewsletter',
    'functions' => array( ),
    'params' => array( 'SubscriptionListID' ) );

?>