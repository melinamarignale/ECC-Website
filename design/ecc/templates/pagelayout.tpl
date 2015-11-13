<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        {include uri="design:common/page_head.tpl"}
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=false;">

        <link rel="stylesheet" type="text/css" href={concat('stylesheets/roadmap.css')|ezdesign} />

        {*section var=css_file loop=ezini( 'StylesheetSettings', 'FrontendCSSFileList', 'design.ini' )}
            <link rel="stylesheet" type="text/css" href={concat( 'stylesheets/',$css_file )|ezdesign} />
        {/section*}

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>


    <body id="roadmap">
        <div class="wrapper">
            {include uri="design:common/header.tpl"}
            {$module_result.content}
            {include uri="design:common/footer.tpl"}
        </div>
        {ezscript(ezini('JavaScriptSettings', 'FrontendJavaScriptList', 'design.ini'))}
        <script type="text/javascript">
            {literal}
                var _paq = _paq || [];
                _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
                _paq.push(["setCookieDomain", "*.evecorpcenter.com"]);
                _paq.push(["setDomains", ["*.evecorpcenter.com","*.fr.evecorpcenter.com"]]);
                _paq.push(['trackPageView']);
                _paq.push(['enableLinkTracking']);
                (function() {
                    var u="//analytics.fnev.eu/";
                    _paq.push(['setTrackerUrl', u+'piwik.php']);
                    _paq.push(['setSiteId', 2]);
                    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
            {/literal}
        </script>
        <noscript><p><img src="//analytics.fnev.eu/piwik.php?idsite=2" style="border:0;" alt="" /></p></noscript>
    </body>
</html>