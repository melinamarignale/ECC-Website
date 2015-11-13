{if $attribute.content["name"]|ne('')}<div class="block">{$attribute.content["name"]|wash( xhtml )|nl2br}</div>{/if}
{if $attribute.content["description"]|ne('')}<div class="block">( {$attribute.content["description"]|wash( xhtml )|nl2br} )</div>{/if}
{if $attribute.content["keywords"]|ne('')}<div class="block">{$attribute.content["keywords"]|wash( xhtml )|nl2br}</div>{/if}