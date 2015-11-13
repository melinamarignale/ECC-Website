<?php

$mj = new mailjetApi();

$listID = 1;
$Cemail = $_GET['Cemail'];

$makeContactParams = array(
	"method"	=> "POST",
	"Email"		=> $Cemail
);

$contact = $mj->contact($makeContactParams);

$listRecepParams = array(
	"method"	=> "POST",
	"ListID"	=> $listID,
	"ContactID"	=> $contact->Data[0]->ID,
	"IsActive"	=> True
);

$recep = $mj->listrecipient($listRecepParams);

if(is_object($recep)){
	echo "Thank you for subscribing !";
} else {
	echo "You have already subscribed, you are awesome !";
}

eZExecution::cleanExit();