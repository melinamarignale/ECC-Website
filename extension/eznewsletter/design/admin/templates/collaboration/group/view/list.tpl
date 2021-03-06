{default parent_group_id=0
         current_depth=0
         offset=$view_parameters.offset item_limit=10
         summary_indentation=10}

{let  group_item_count=fetch("collaboration","item_count",hash("parent_group_id",$collab_group.id))
      group_item_list=fetch("collaboration","item_list",hash("limit",$item_limit,"offset",$offset,"parent_group_id",$collab_group.id))}


<div class="context-block">

{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h1 class="context-title">{"Group list for '%1'"|i18n('design/admin/collaboration/group/view/list',,array($collab_group.title|wash))}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-bl"><div class="box-br"><div class="box-content">

{section show=$group_item_count}

{include uri="design:collaboration/item_list.tpl" item_list=$group_item_list}

{include name=Navigator
         uri='design:navigator/google.tpl'
         page_uri=concat("/collaboration/group/list/",$collab_group.id)
         item_count=$group_item_count
         view_parameters=$view_parameters
         item_limit=$item_limit}

{section-else}
<div class="block">
<p>{"No items in group."|i18n('design/admin/collaboration/group/view/list')}</p>
</div>
{/section}

{* DESIGN: Content END *}</div></div></div></div></div></div>

</div>

<div class="context-block">

{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h2 class="context-title">{"Group tree for '%1'"|i18n('design/admin/collaboration/group/view/list',,array($collab_group.title|wash))}</h2>

{* DESIGN: Mainline *}<div class="header-subline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-bl"><div class="box-br"><div class="box-content">

  {include uri="design:collaboration/group_tree.tpl" current_depth=$current_depth
           summary_indentation=$summary_indentation parent_group_id=$parent_group_id}

{* DESIGN: Content END *}</div></div></div></div></div></div>

</div>

{/let}
{/default}
