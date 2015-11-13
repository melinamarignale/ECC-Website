{*
	The first block leaves the "addToBasket" button working the next two disable the button. 
	You can have an out of stock warning while still allow it to be purchaced it up to you.
	
	This example is for a training course
	
*}

{switch match=$node.object.data_map.quantity.content} 
	{case match=-1} 
		<h3>The Course is full</h3>
		<div class="content-action">
			<form method="post" action={"content/action"|ezurl}>
				<input type="submit" class="defaultbutton" name="ActionAddToBasket" value="{"Add to basket "|i18n("design/base")}" disabled />
				<input type="hidden" name="ContentNodeID" value="{$node.node_id}" />
				<input type="hidden" name="ContentObjectID" value="{$node.object.id}" />
				<input type="hidden" name="ViewMode" value="full" />
			</form>
		</div>
	{/case}  
	
	{case match=-2} 
		<h3>This Course has been cancelled</h3>
		<div class="content-action">
			<form method="post" action={"content/action"|ezurl}>
				<input type="submit" class="defaultbutton" name="ActionAddToBasket" value="{"Add to basket "|i18n("design/base")}" disabled />
				<input type="hidden" name="ContentNodeID" value="{$node.node_id}" />
				<input type="hidden" name="ContentObjectID" value="{$node.object.id}" />
				<input type="hidden" name="ViewMode" value="full" />
			</form>
		</div>
	{/case}  

	{case} 
		<div class="content-action">
		<h3>There are {$node.object.data_map.quantity.content} places left</h3>
			<form method="post" action={"content/action"|ezurl}>
				<input type="submit" class="defaultbutton" name="ActionAddToBasket" value="{"Add to basket"|i18n("design/base")}" />
				<input type="hidden" name="ContentNodeID" value="{$node.node_id}" />
				<input type="hidden" name="ContentObjectID" value="{$node.object.id}" />
				<input type="hidden" name="ViewMode" value="full" />
			</form>
		</div>
	{/case}  
	
{/switch}
											
