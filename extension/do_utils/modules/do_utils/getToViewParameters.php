<?php

$redirectURL = $_GET['redirectURL'];
$thematiques = implode('-' , $_GET['thematiques']);
$quartiers = implode('-' , $_GET['quartiers']);


$url =  $redirectURL .'/(thematiques)/' .$thematiques .'/(quartiers)/' .$quartiers;


header("Location: $url ");

eZExecution::cleanExit();