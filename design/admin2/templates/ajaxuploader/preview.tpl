{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<form action={'ezjscore/call'|ezurl} method="post" class="ajaxuploader-preview">
    <fieldset>
        <legend>{"Step 3/3: Preview of '%name' (%class)"|i18n( 'design/admin2/ajaxuploader', '', hash( '%name', $object.name|wash(), '%class', $object.class_name|wash() ) )}</legend>

        {node_view_gui content_node=$object.main_node view=ajaxuploader_preview}

        <p class="ajaxuploader-button-bar">
            <input type="submit" class="defaultbutton" value="{'Add'|i18n( 'design/admin2/ajaxuploader' )}" />
            <a href="#" class="window-cancel">{'Close'|i18n( 'design/admin2/ajaxuploader' )}</a>
            <span class="ajaxuploader-error"></span>
        </p>
    </fieldset>
</form>
