<?php

class doTopList
{


    public function fetchTopList($classes, $parent_node_id, $limit, $offset){
        $result = array();

        $parentNode = eZContentObjectTreeNode::fetch($parent_node_id);

        $path_string = $parentNode->attribute('path_string');

        $db = eZDB::instance();

        $sql = "SELECT evc.node_id FROM ezview_counter evc
        LEFT JOIN ezcontentobject_tree ecot ON evc.node_id = ecot.node_id
        LEFT JOIN ezcontentobject eco ON ecot.contentobject_id = eco.id
        LEFT JOIN ezcontentclass ecc ON eco.contentclass_id = ecc.id
        WHERE ecc.identifier IN ('" . implode("', '", $classes) . "')
        AND ecot.path_string LIKE '" . $path_string . "%'
        AND ecot.is_hidden = 0 AND ecot.is_invisible = 0
        ORDER BY evc.count DESC LIMIT " . $offset .", " . $limit;


        $queryRes = $db->arrayQuery($sql);


        foreach($queryRes as $res)
        {
            $node = eZContentObjectTreeNode::fetch($res['node_id']);

            $result[] = $node;

        }

        return array('result' => $result);
    }

}