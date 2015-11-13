{def
    $orginal=true()
    $attribute=false()
}
{if gt($node_id, 0)}
    {def $node=fetch('content', 'node', hash('node_id', $node_id))}
    {if eq($node.class_identifier, 'file')}
        {set $orginal=false()}
        {set $attribute = $node.data_map.file}
    {/if}
{elseif gt($object_id, 0)}
    {def $object=fetch('content', 'object', hash('object_id', $object_id))}
    {if eq($object.class_identifier, 'file')}
        {set $orginal=false()}
        {set $attribute = $object.data_map.file}
    {/if}
{else}
    {set $orginal=true()}
{/if}
{if or($orginal, $attribute|eq(false()))}
    <a href={$href|ezurl}{if $id} id="{$id}"{/if}{if $title}   title="{$title}"{/if}{if $target} target="{$target}"{/if}{if   $classification} class="{$classification|wash}"{/if}{if and(is_set(   $hreflang ), $hreflang)}   hreflang="{$hreflang|wash}"{/if}>{$content}</a>
{else}
<a href={concat( 'content/download/', $attribute.contentobject_id, '/', $attribute.id,'/version/', $attribute.version , '/file/', $attribute.content.original_filename|urlencode )|ezurl} rel="nofollow" {if   $classification} class="{$classification|wash}"{/if} {if $title}   title="{$title}"{/if}{if $target}   target="{$target}"{/if}>{$content}</a>
{/if}
{undef $orginal $attribute}