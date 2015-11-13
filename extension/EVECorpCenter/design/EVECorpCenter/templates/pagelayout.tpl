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
    </body>
</html>