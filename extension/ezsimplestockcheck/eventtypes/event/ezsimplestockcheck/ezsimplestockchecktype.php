<?php
//
// Definition of ezsimplestockcheck class
//
// Created on: <6-12-2005 10:38:00 fats>
//
// Copyright (C) 2005 Grandmore. All rights reserved.
//
//	http://www.grandmore.com
//	http://www.grandmore.co.uk

/*! \file ezsimplestockchecktype.php
*/

/*!
  \class eZWrappingType ezwrappingtype.php
  \brief The class eZWrappingType does

*/
//define( "EZ_WORKFLOW_TYPE_EZSIMPLESTOCKCHECK_ID", "ezsimplestockcheck" );


class eZSimpleStockCheckType extends eZWorkflowEventType
{

    const WORKFLOW_TYPE_STRING = "ezsimplestockcheck";
    /*!
     Constructor
    */
    function __construct()
    {
        $this->eZWorkflowEventType( self::WORKFLOW_TYPE_STRING, ezpI18n::tr( 'kernel/workflow/event', "SimpleStockCheck" ) );
    }
    function execute( $process, $event )
    {
        $parameters = $process->attribute( 'parameter_list' );
        $http = eZHTTPTool::instance();

        eZDebug::writeNotice( $parameters, "parameters" );
        $orderID = $parameters['order_id'];
        $order = eZOrder::fetch( $orderID );
        
        if (empty($orderID) || get_class( $order ) != 'ezorder')
        {
            eZDebug::writeWarning( "Can't proceed without a Order ID.", "SimpleStockCheck" );
            return eZWorkflowEventType::STATUS_FETCH_TEMPLATE_REPEAT;
        }

        // Decrement the quantitity field
		$order = eZOrder::fetch( $orderID );
		$productCollection = $order->productCollection();
		$ordereditems = $productCollection->itemList();
		foreach ($ordereditems as $item)
		{
			$contentObject = $item->contentObject(); 
			$contentObjectVersion = $contentObject->version($contentObject->attribute( 'current_version' ) );
			$contentObjectAttributes = $contentObjectVersion->contentObjectAttributes();
			foreach (array_keys($contentObjectAttributes) as $key)
			{
				$contentObjectAttribute = $contentObjectAttributes[$key];
				$contentClassAttribute = $contentObjectAttribute->contentClassAttribute();

				// Each attribute has an attribute identifier called 'quantity' that identifies it.
				if ($contentClassAttribute->attribute("identifier") == "quantity")
				{ 
					$contentObjectAttribute->setAttribute("data_int", (($contentObjectAttribute->attribute("value")) - $item->ItemCount));
					$contentObjectAttribute->store();
				}
			}
		}

        return eZWorkflowEventType::STATUS_ACCEPTED;
        
    }
    
}
eZWorkflowEventType::registerEventType( eZSimpleStockCheckType::WORKFLOW_TYPE_STRING, 'ezsimplestockchecktype' );

?>
