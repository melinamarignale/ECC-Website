{* Locations window. *}
{let assigned_nodes=$node.object.assigned_nodes
     assignment_count=$assigned_nodes|count
     has_manage_locations=fetch( 'user', 'current_user' ).has_manage_locations
     can_edit_node=$node.can_edit
     can_remove_location=false()
     can_manage_location=or(fetch( 'content', 'access',
                	    hash( 'access', 'manage_locations',
		            	'contentobject', $node)),
			    fetch( 'content', 'access',
                	    hash( 'access', 'create',
		            	'contentobject', $node)))}

<form name="locationsform" method="post" action={'content/action'|ezurl}>
<input type="hidden" name="ContentNodeID" value="{$node.node_id}" />
<input type="hidden" name="ContentObjectID" value="{$node.object.id}" />
<input type="hidden" name="ViewMode" value="{$viewmode|wash}" />
<input type="hidden" name="ContentObjectLanguageCode" value="{$language_code|wash}" />

<div class="context-block">

{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h2 class="context-title">{'Locations [%locations]'|i18n( 'design/admin/node/view/full',, hash( '%locations', $assigned_nodes|count ) )}</h2>

{* DESIGN: Subline *}<div class="header-subline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

<table class="list" cellspacing="0">
<tr>
    <th class="tight"><img src={'toggle-button-16x16.gif'|ezimage} alt="{'Invert selection.'|i18n( 'design/admin/node/view/full' )}" title="{'Invert selection.'|i18n( 'design/admin/node/view/full' )}" onclick="ezjs_toggleCheckboxes( document.locationsform, 'LocationIDSelection[]' ); return false;"/></th>
    <th class="wide">{'Location'|i18n( 'design/admin/node/view/full' )}</th>
    <th class="tight">{'Sub items'|i18n( 'design/admin/node/view/full' )}</th>
{*   <th class="tight">{'Sorting'|i18n( 'design/admin/node/view/full' )}</th> *}
    <th class="tight">{'Visibility'|i18n( 'design/admin/node/view/full' )}</th>
    <th class="tight">{'Main'|i18n( 'design/admin/node/view/full' )}</th>
</tr>
{foreach $assigned_nodes as $assignment_node
         sequence array( bglight, bgdark ) as $sequence}
    {let assignment_path=$assignment_node.path|append( $assignment_node )}

<tr class="{$sequence}">

    {* Remove. *}
    <td>
    {if and( or( $assignment_node.can_remove, $assignment_node.can_remove_location ), eq( $assignment_node.node_id, $node.main_node_id )|not )}
        <input type="checkbox" name="LocationIDSelection[]" value="{$assignment_node.node_id}" title="{'Select location for removal.'|i18n( 'design/admin/node/view/full' )}" />
        {set can_remove_location=true()}
    {else}
        <input type="checkbox" name="LocationIDSelection[]" value="{$assignment_node.node_id}" disabled="disabled" title="{'This location cannot be removed either because you do not have permission to remove it or because it is currently being displayed.'|i18n( 'design/admin/node/view/full' )}" />
    {/if}
    </td>

    {* Location.  *}
    {section show=and( eq( $assignment_node.path_string, $node.path_string ), $assigned_nodes|count|gt(1))}
    <td><b>{section var=node_path loop=$assignment_path} <a href={$node_path.url|ezurl}>{$node_path.name|wash}</a>{delimiter} / {/delimiter}{/section}</b></td>
    {section-else}
    <td>{section var=node_path loop=$assignment_path} <a href={$node_path.url|ezurl}>{$node_path.name|wash}</a>{delimiter} / {/delimiter}{/section}</td>
    {/section}


    {* Sub items. *}
    <td class="number" align="right">{$assignment_node.children_count}</td>

    {* Sorting. *}
{*
    <td class="nowrap">{$assignment_node.item.sort_array[0][0]} / {$assignment_node.item.sort_array[0][1]|choose( 'down'|i18n( 'design/admin/node/view/full' ), 'up'|i18n( 'design/admin/node/view/full' ) )}</td>
*}

    {* Visibility. *}
    <td class="nowrap">
    {section show=$assignment_node.is_invisible}
        {section show=$assignment_node.is_hidden}
            {'Hidden'|i18n( 'design/admin/node/view/full' )}
            [ <a href={concat( '/content/hide/', $assignment_node.node_id )|ezurl} title="{'Make location and all sub items visible.'|i18n( 'design/admin/node/view/full' )}">{'Reveal'|i18n( 'design/admin/node/view/full' )}</a> ]
        {section-else}
            {'Hidden by superior'|i18n( 'design/admin/node/view/full' )}
            [ <a href={concat( '/content/hide/', $assignment_node.node_id )|ezurl} title="{'Hide location and all sub items.'|i18n( 'design/admin/node/view/full' )}">{'Hide'|i18n( 'design/admin/node/view/full' )}</a> ]
        {/section}
    {section-else}
        {'Visible'|i18n( 'design/admin/node/view/full' )}
        [ <a href={concat( '/content/hide/', $assignment_node.node_id )|ezurl} title="{'Hide location and all sub items.'|i18n( 'design/admin/node/view/full' )}" >{'Hide'|i18n( 'design/admin/node/view/full' )}</a> ]
    {/section}
    </td>

    {* Main node. *}
    <td>

    {section show=$assignment_node.can_edit}

    {section show=$assignment_count|gt( 1 ) }
    <input type="radio" {section show=$assignment_node.is_main}checked="checked"{/section} name="MainAssignmentCheck" value="{$assignment_node.node_id}" title="{'Use these radio buttons to select the desired main location.'|i18n( 'design/admin/node/view/full' )}" />
    {section-else}
    <input type="radio" {section show=$assignment_node.is_main}checked="checked"{/section} name="MainAssignmentCheck" value="{$assignment_node.node_id}" disabled="disabled" title="{'The item being displayed has only one location, which is by default the main location.'|i18n( 'design/admin/node/view/full' )}" />
    {/section}

    {section-else}

    <input type="radio" {section show=$assignment_node.is_main}checked="checked"{/section} name="MainAssignmentCheck" value="{$assignment_node.node_id}" disabled="disabled" title="{'You cannot set the main location because you do not have permission to edit the item being displayed.'|i18n( 'design/admin/node/view/full' )}" />

    {/section}

    </td>
</tr>
{/let}
{/foreach}
</table>

{* DESIGN: Content END *}</div></div></div>

{* Required to get the main node selection to work,
   unchecked radio buttons will not be sent by browser. *}
<input type="hidden" name="HasMainAssignment" value="1" />

<div class="controlbar">

{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">

<div class="block">
<div class="button-left">
{if or( $can_edit_node, $has_manage_locations )}

    {if $can_remove_location}
    <input class="button" type="submit" name="RemoveAssignmentButton" value="{'Remove selected'|i18n( 'design/admin/node/view/full' )}" title="{'Remove selected locations from the list above.'|i18n( 'design/admin/node/view/full' )}" />
    {else}
    <input class="button-disabled" type="submit" name="RemoveAssignmentButton" value="{'Remove selected'|i18n( 'design/admin/node/view/full' )}" title="{'There is no removable location.'|i18n( 'design/admin/node/view/full' )}" disabled="disabled" />
    {/if}

    {if and( $can_manage_location, ne( $node.node_id, ezini( 'NodeSettings', 'RootNode','content.ini' ) ), ne( $node.node_id, ezini( 'NodeSettings', 'MediaRootNode', 'content.ini' ) ), ne( $node.node_id, ezini( 'NodeSettings', 'UserRootNode', 'content.ini' ) ) )}
    <input class="button" type="submit" name="AddAssignmentButton" value="{'Add locations'|i18n( 'design/admin/node/view/full' )}" title="{'Add one or more new locations.'|i18n( 'design/admin/node/view/full' )}" />
    {else}
    <input class="button-disabled" type="submit" name="AddAssignmentButton" value="{'Add locations'|i18n( 'design/admin/node/view/full' )}" title="{'It is not possible to add locations to a top level node.'|i18n( 'design/admin/node/view/full' )}" disabled="disabled" />
    {/if}

{else}
    <input class="button-disabled" type="submit" name="" value="{'Remove selected'|i18n( 'design/admin/node/view/full' )}" disabled="disabled" title="{'You cannot remove any locations because you do not have permission to edit the current item.'|i18n( 'design/admin/node/view/full' )}" />
    <input class="button-disabled" type="submit" name="" value="{'Add locations'|i18n( 'design/admin/node/view/full' )}" disabled="disabled" title="{'You cannot add new locations because you do not have permission to edit the current item.'|i18n( 'design/admin/node/view/full' )}" />
{/if}
</div>

<div class="button-right">
{if $can_edit_node}

{if $assignment_count|gt( 1 )}
    <input class="button" type="submit" name="UpdateMainAssignmentButton" value="{'Set main'|i18n( 'design/admin/node/view/full' )}" title="{'Select the desired main location using the radio buttons above then click this button to store the setting.'|i18n( 'design/admin/node/view/full' )}" />
{else}
    <input class="button-disabled" type="submit" name="UpdateMainAssignmentButton" value="{'Set main'|i18n( 'design/admin/node/view/full' )}" disabled="disabled" title="{'You cannot set the main location because there is only one location present.'|i18n( 'design/admin/node/view/full' )}" />
{/if}

{else}
    <input class="button-disabled" type="submit" name="" value="{'Set main'|i18n( 'design/admin/node/view/full' )}" disabled="disabled" title="{'You cannot set the main location because you do not have permission to edit the current item.'|i18n( 'design/admin/node/view/full' )}" />
{/if}
</div>

<div class="break"></div>
</div>

{* DESIGN: Control bar END *}</div></div></div></div></div></div>

</div>
</div>

</form>
{/let}
