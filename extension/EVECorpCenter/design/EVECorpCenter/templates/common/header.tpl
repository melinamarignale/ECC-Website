{def $languageUrl = ezini( 'RegionalSettings', 'LanguageUrl', 'site.ini')}
<div id='layout'>
    <header>
        <h1><a href="/">EVE Corp Center</a></h1>

        <ul class="countryswitch">
            <li><a href="{$languageUrl.eng-US}{get_url_alias_by_lang($module_result.node_id, 'eng-US')}">EN</a></li>
            <li><a href="{$languageUrl.fre-FR}{get_url_alias_by_lang($module_result.node_id, 'fre-FR')}">FR</a></li>
        </ul>
    </header>