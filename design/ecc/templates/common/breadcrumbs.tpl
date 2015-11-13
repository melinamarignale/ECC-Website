{def $currentLang = ezini( 'RegionalSettings', 'Locale', 'site.ini' )}
<ul class="breadcrumb breadcrumbs_ctnt">
    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href={""|ezurl()} itemprop="url" title="">
            <span itemprop="title">{if eq($currentLang, 'fre-FR')}Accueil{else}Home{/if}</span>
        </a>
    </li>
    {if $node.path|count|gt(1)}
        {foreach $node.path as $elt max 3 offset 1}
            {if $elt.node_id|ne(137)}
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href={$elt.url|ezurl()} itemprop="url">
                        <span itemprop="title">{$elt.name}</span>
                    </a>
                </li>
            {/if}
        {/foreach}
    {/if}
    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active">
        <a href={$node.url_alias|ezurl()}><span itemprop="title" class="act">{$node.name}</span></a>
    </li>
</ul>
{undef $currentLang}