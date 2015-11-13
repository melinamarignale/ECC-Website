<?php

$Module = array('name' => 'evecorpcenter', 'variable_params' => true);

$ViewList = array();
$ViewList['newsletter'] = array(
	'script'    => 'mailjet.php',
	'function'  => 'anonymous'
);

$FunctionList               = array();
$FunctionList['anonymous']  = array();
?>
