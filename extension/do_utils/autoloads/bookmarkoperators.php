<?php
class bookmarkOperators
{
    function bookmarkOperators()
    {
    }

    function operatorList()
    {
        return array( 'is_bookmarked' , 'is_in_subscribed_nodes' );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array( 'is_bookmarked' => array( 'node_id' => array( 	'type' => 'integer',
			                                                          	'required' => true,
			                                                          	'default' => array() ) ),
						'is_in_subscribed_nodes' => array( 'node_id' => array( 	'type' => 'integer',
			                                                          	'required' => true,
			                                                          	'default' => array() ) ),

        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'is_bookmarked':
            {
            	$bookmarkList = eZPersistentObject::fetchObjectList( eZContentBrowseBookmark::definition(),
                                                   null,
                                                   array( 'user_id' => eZUser::currentUserID() , 'node_id' => $namedParameters['node_id']),
                                                   array( 'id' => 'desc' ),
                                                   array( 'offset' => 0, 'length' => '10' ),
                                                   true );

               if( count($bookmarkList) > 0 )
               { $operatorValue = 1;}
			   else
               { $operatorValue = 0;}

            } break;


            case 'is_in_subscribed_nodes':
            {
            	$subscriptionList = eZPersistentObject::fetchObjectList(
            										 eZSubtreeNotificationRule::definition(),
	                                                 array( 'node_id' ),
	                                                 array( 'user_id' => eZUser::currentUserID() , 'node_id' => $namedParameters['node_id'] ),
                                                     null,
                                                     null,
                                                     false );


               if( count($subscriptionList) > 0 )
               { $operatorValue = 1;}
			   else
               { $operatorValue = 0;}

            } break;
        }
    }
}

?>