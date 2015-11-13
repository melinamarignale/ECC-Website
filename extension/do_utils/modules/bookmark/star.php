<?php

$http = eZHTTPTool::instance();
$tpl = eZTemplate::factory();
$module = $Params['Module'];

$nodeID = $Params['NodeID'];
$node = eZContentObjectTreeNode::fetch( $nodeID, false, false );
$userID = eZUser::currentUserID();

$bookmarkList = eZPersistentObject::fetchObjectList( eZContentBrowseBookmark::definition(),
                                                   null,
                                                   array( 'user_id' => $userID , 'node_id' => $nodeID),
                                                   array( 'id' => 'desc' ),
                                                   array( 'offset' => 0, 'length' => '10' ),
                                                   true );




if( count($bookmarkList) > 0 )
{
	foreach($bookmarkList as $bookmark)
	{
		$bookmark->remove();
	}
	$star = '0';
}
else{

	eZContentBrowseBookmark::createNew( $userID, $nodeID, $node['name'] );

	/*
	$notificationList = eZPersistentObject::fetchObjectList(  eZSubtreeNotificationRule::definition(),
	                                                 array( 'node_id' ),
	                                                 array( 'user_id' => $userID , 'node_id' => $node['parent_node_id'] ),
                                                     null,
                                                     null,
                                                     false );

   if( count($notificationList) == 0 )
	{
	$notificationRules = new eZSubtreeNotificationRule( array(	'node_id' =>  $node['parent_node_id'],
																'user_id' => $userID,
																'use_digest' => 0
	) );
	$notificationRules->store();
	}*/
	$star = '1';
}

$tpl = eZTemplate::factory();
$tpl->setVariable( 'star', $star );
echo $tpl->fetch( 'design:bookmark/star.tpl' );
eZExecution::cleanExit();
?>