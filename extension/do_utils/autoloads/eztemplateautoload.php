<?php

$eZTemplateOperatorArray = array();


$eZTemplateOperatorArray[] = array( 'script' => 'extension/do_utils/autoloads/langHelper.php',
                                    'class' => 'langHelper',
                                    'operator_names' => array( 'get_url_alias_by_lang' ) );

$eZTemplateOperatorArray[] = array( 'script' => 'extension/do_utils/autoloads/arrayHelper.php',
                                    'class' => 'arrayHelper',
                                    'operator_names' => array( 'array_chunk', 'real_strip_tags', 'get_range', 'tronque_mot_entier' ) );

$eZTemplateOperatorArray[] = array( 'script' => 'extension/do_utils/autoloads/bookmarkoperators.php',
                                    'class' => 'bookmarkOperators',
                                    'operator_names' => array( 'is_bookmarked' , 'is_in_subscribed_nodes' ) );

$eZTemplateOperatorArray[] = array( 'script' => 'extension/do_utils/autoloads/navigationHelper.php',
    'class' => 'navigationHelper',
    'operator_names' => array( 'isInPath', 'isNodeInPath') );


?>