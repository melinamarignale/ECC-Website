<?php

class navigationHelper
{
    function navigationHelper()
    {
    }

    function operatorList()
    {
        return array( 'isInPath', 'isNodeInPath' );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            'isInPath' => array(
                'module_result' => array(
                    'type' => 'array',
                    'required' => true,
                    'default' => array()
                ),
                'node_id' => array(
                    'type' => 'integer',
                    'required' => true,
                    'default' => 2
                )
            ),
            'isNodeInPath' => array(
                'node' => array(
                    'type' => 'node',
                    'required' => true,
                    'default' => null
                ),
                'node_id' => array(
                    'type' => 'integer',
                    'required' => true,
                    'default' => 2
                )
            ),
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    {
        switch ( $operatorName )
        {
            case 'isInPath':
            {
                $operatorValue = false;
                $module_result = $namedParameters['module_result'];
                $node_id = $namedParameters['node_id'];
                if(isset($module_result['node_id']) && $module_result['node_id'] == $node_id){
                    $operatorValue = true;
                }elseif(isset($module_result['node_id'])){
                    foreach($module_result['path'] as $path){
                        if(isset($path['node_id']) && $path['node_id'] == $node_id){
                            $operatorValue = true;
                        }
                    }
                }

            } break;
            case 'isNodeInPath':
                {
                $operatorValue = false;
                $node = $namedParameters['node'];
                $node_id = $namedParameters['node_id'];
                if($node->attribute('node_id') == $node_id){
                    $operatorValue = true;
                }else{
                    foreach($node->attribute('path') as $path){
                        if($path->attribute('node_id')  == $node_id){
                            $operatorValue = true;
                        }
                    }
                }

                } break;
        }

    }

}

?>
