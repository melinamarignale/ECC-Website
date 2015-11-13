{if $link_parameters.href|contains( 'http' ) , ne( $link_parameters.href , '')}
	{def $href = $link_parameters.href}
{elseif ne( $link_parameters.href , '')}
	{def $href = concat('/' , $link_parameters.href)}
{/if}

{attribute_view_gui attribute=$object.data_map.image
image_class=$object_parameters.size
href=$href
target=$link_parameters.target
css_class=image-right}