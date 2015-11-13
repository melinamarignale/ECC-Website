<?php

/*! \file function_definition.php
 */

$FunctionList = array();

$FunctionList['do_top_list'] = array(
    'name' => 'do_top_list',
    'call_method' => array(
        'include_file' => 'extension/do_utils/classes/doTopList.php',
        'class' => 'doTopList',
        'method' => 'fetchTopList'
    ),
    'parameter_type' => 'standard',
    'parameters' => array (
        array (
            'name' => 'classes',
            'type' => 'array',
            'required' => true
        ),
        array(
            'name' => 'parent_node_id',
            'type' => 'integer',
            'required' => true
        ),
        array(
            'name' => 'limit',
            'type' => 'integer',
            'required' => true
        ),
        array(
            'name' => 'offset',
            'type' => 'integer',
            'required' => true
        )
    )
);
