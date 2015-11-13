{default attribute_base='ContentObjectAttribute' html_class='full'}
<fieldset>
<div class="block">
<div class="block"><label>{'Tag name'|i18n( 'design/standard/content/datatype' )}:</label><input type="text" class="box" name="{$attribute_base}_data_text_{$attribute.id}_name" value="{$attribute.content["name"]|wash}" /></div>
<div class="block"><label>{'Tag description'|i18n( 'design/standard/content/datatype' )}:</label><textarea name="{$attribute_base}_data_text_{$attribute.id}_description" class="{eq( $html_class, 'half' )|choose( 'box', 'halfbox' )} ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" cols="70">{$attribute.content["description"]|wash}</textarea></div>
<div class="block"><label>{'Tag keywords'|i18n( 'design/standard/content/datatype' )}:</label><textarea name="{$attribute_base}_data_text_{$attribute.id}_keyword" class="{eq( $html_class, 'half' )|choose( 'box', 'halfbox' )} ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" cols="70">{$attribute.content["keywords"]|wash}</textarea></div>
</div>
</fieldset>
{/default}