<link rel="icon" type="image/png" href={"favicon.png"|ezimage()} />
<link rel="shortcut icon" type="image/x-icon" href={"favicon.ico"|ezimage()} />

{default enable_help=true() enable_link=true() disable_meta_language=false()}

{let name=Path
     path=$module_result.path
     reverse_path=array()}
  {if is_set($module_result.title_path)}
    {set path=$module_result.title_path}
  {/if}
  {section loop=$:path}
    {set reverse_path=$:reverse_path|array_prepend($:item)}
  {/section}

{set-block scope=root variable=site_title}
{section loop=$Path:reverse_path}{$:item.text|wash}{delimiter} / {/delimiter}{/section} - {$site.title|wash}
{/set-block}

{/let}

    {if is_set($module_result.node_id)}
    {def $tags = fetch( 'metatag', 'get_tags', hash( 'node_id', $module_result.node_id , 'view_parameters', $view_parameters ) )}
    {/if}

    {if and(is_set($tags), not(eq($tags.name , '')))}
    {set $site_title=$tags.name}
    {/if}

    <title>{$site_title}</title>

    {section show=and(is_set($#Header:extra_data),is_array($#Header:extra_data))}
      {section name=ExtraData loop=$#Header:extra_data}
      {$:item}
      {/section}
    {/section}

    {* check if we need a http-equiv refresh *}
    {if $site.redirect}
    <meta http-equiv="Refresh" content="{$site.redirect.timer}; URL={$site.redirect.location}" />

    {/if}

    {foreach $site.http_equiv as $key => $value}
    {if and( $disable_meta_language, $key|eq('Content-language') )}{continue}{/if}
    <meta http-equiv="{$key|wash}" content="{$value|wash}" />

    {/foreach}

{if is_set($tags)}
<meta name="description" content="{$tags.description|wash()}" />
<meta name="keywords" content="{$tags.keywords|wash()}" />
{else}
    {foreach $site.meta as $key => $value}
    {if is_set( $module_result.content_info.persistent_variable[$key] )}
        <meta name="{$key|wash}" content="{$module_result.content_info.persistent_variable[$key]|wash}" />
    {else}
        <meta name="{$key|wash}" content="{$value|wash}" />
    {/if}
    {/foreach}
{/if}



{/default}
