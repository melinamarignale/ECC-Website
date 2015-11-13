<?php
/*!
  \brief   Definition of functions contained in metatag module
  \version 1.0
  \date    Vendredi 18 Mai 2007 10:21:22 am
  \author  Alexandre Nion

*/
$FunctionList	= array();
$FunctionList['get_tags']	= array( 'name' => 'get_tags',
									 'call_method' => array(
									 						 'class' => 'MetatagFunctionCollection',
															 'method' => 'fetchTagsByNodeID' ),
									 'parameter_type' => 'standard',
									 'parameters' => array( array( 'name' => 'node_id',
																   'type' => 'string',
																   'required' => true ),
															array( 'name' => 'view_parameters',
																   'type' => 'array',
																   'required' => false )

															)
									);
?>