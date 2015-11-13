{if is_set($node.children.0)}
    {def $children = fetch( 'content', 'list', hash(
    'parent_node_id', $node.node_id ,
    'sort_by', array('priority', false()) ,
    'limit', 1,
    ))}
    {def $url = $children.0.url}
    {redirect($url)}
{/if}