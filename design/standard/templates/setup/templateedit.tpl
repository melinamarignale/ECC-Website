{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<form method="post" action={concat('/setup/templateedit/',$template)|ezurl}>
<h1>{"Template edit"|i18n("design/standard/setup")} {$template}</h1>

<textarea name=TemplateContent cols="80" rows="30">{$template_content|wash(xhtml)}</textarea>

<div class="buttonblock">
<input class="button" type="submit" value="{"Save"|i18n("design/standard/setup")}" name="SaveButton" />
<input class="button" type="submit" value="{"Discard"|i18n("design/standard/setup")}" name="DiscardButton" />
</div>

</form>