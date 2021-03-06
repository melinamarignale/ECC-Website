{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{* eZNewsletter - edit newslettertype *}
<form method="post" action={concat( '/newsletter/edit_type/', $newsletter_type.id, '/' )|ezurl}>

{if $warning|count}
    <div class="message-warning">
    <h2>{'The validation of your entries failed.'|i18n( 'design/eznewsletter/edit_newslettertype' )}</h2>
    <ul>
    {foreach $warning as $warningmessage}
        <li>{$warningmessage|wash}</li>
    {/foreach}
    </ul>
    </div>
{/if}


<div class="context-block">
{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
<h1 class="context-title">{'Edit newsletter type'|i18n( 'design/eznewsletter/edit_newslettertype' )}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

<input type="hidden" name="NewsletterTypeID" value ="{$newsletter_type.id}"/>

<div class="context-attributes">

{* Name. *}
<div class="block">
<label>{'Name'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<input class="box" id="newsletterTypeName" type="text" name="NewsletterTypeName" value="{$newsletter_type.name|wash}" />
</div>

{* Description *}
<div class="block">
    <label>{"Description"|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
    <textarea class="halfbox" name="NewsletterTypeDescription" rows="3" title="{'Use the description field to explaining the purpose of this newslettertype.'|i18n('design/eznewsletter/edit_newslettertype')}">{$newsletter_type.description|wash}</textarea>
</div>

<div class="block">
<label>{'Sender address'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<input class="box" id="newsletterTypeName" type="text" name="NewsletterTypeSenderAddress" value="{$newsletter_type.sender_address|wash}" />
</div>

{* Newsletter send date *}
<div class="block">
<fieldset>
<legend>{'Send date modifier'|i18n( 'design/eznewsletter/edit_newslettertype' )}</legend>

<div class="date">

<div class="element">
<label>{'Days'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<input type="text" name="SendModifierDays" size="3" value="{$newsletter_type.send_date_modifier_list.days}" />
</div>

<div class="element">
<label>{'Hours'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<input type="text" name="SendModifierHours" size="5" value="{$newsletter_type.send_date_modifier_list.hours}" />
</div>

<div class="element">
<label>{'Minutes'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<input type="text" name="SendModifierMinutes" size="3" value="{$newsletter_type.send_date_modifier_list.minutes}" />
</div>

</div>

</fieldset>
</div>

<div class="block">
<label>{'Default pretext'|i18n( 'design/eznewsletter/edit_newslettertype' ) }</label>
<textarea cols="60" rows="10" name="preText">{$newsletter_type.pretext}</textarea>

<label>{'Default posttext'|i18n( 'design/eznewsletter/edit_newslettertype' ) }</label>
<textarea cols="60" rows="10" name="postText">{$newsletter_type.posttext}</textarea>
</div>

<div class="block">
<label>{'Personalize newsletter'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<input type="checkbox" name="PersonaliseNewsletter" value="PersonaliseNewsletter" {if eq($newsletter_type.personalise,'1')}{' checked=checked'}{/if}>
</div>

<div class="block">

<div class="element">
<label>{'Valid content classes'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
{def $contentClassArray=fetch( class, list )
     $class_limitation=ezini( 'NewsletterTypeSettings', 'ClassLimitation', 'eznewsletter.ini' )}
<select name="ValidContentClassIDArray[]" multiple="multiple">
{foreach $contentClassArray as $contentClass}
    {if eq( $class_limitation|count, 0 )}
        <option value="{$contentClass.id}" {cond( $contentclass_list|contains( $contentClass.id ), 'selected="selected"', '' )}>{$contentClass.name|wash}</option>
    {elseif $class_limitation|contains( $contentClass.identifier )}
        <option value="{$contentClass.id}" {cond( $contentclass_list|contains( $contentClass.id ), 'selected="selected"', '' )}>{$contentClass.name|wash}</option>
    {/if}
{/foreach}
</select>
</div>

<div class="element">
<label>{'Subscription lists'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<select name="SubscriptionListIDArray[]" multiple="multiple" size="5">
{foreach $subscription_list_array as $subscriptionList}
    <option value="{$subscriptionList.id}" {cond( $newsletter_type.subscription_id_list|contains($subscriptionList.id), 'selected="selected"', '' )}>{$subscriptionList.name|wash}</option>
{/foreach}
</select>
</div>

<div class="element">
<label>{'Allowed siteaccesses'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
{def $siteaccesses_list = ezini( 'SiteAccessSettings', 'AvailableSiteAccessList' )}
<select name="AllowedSiteaccesses[]" multiple="multiple" size="10">
{foreach $siteaccesses_list as $siteaccess_name}
    <option value="{$siteaccess_name}" {cond( or( $newsletter_type.allowed_siteaccesses_array|contains($siteaccess_name), eq( $siteaccess_name, current_siteaccess() ) ), 'selected="selected"', '' )}>{$siteaccess_name|wash}</option>
{/foreach}
</select>
</div>

</div>

<div class="block">

<label>{'Allowed designs'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<script language="javascript">
{literal}
    function hidePreview(  )
    {
        document.getElementById( 'previewDesign' ).style.display = "none";
    }
    function showPreview( image )
    {
        previewArea = document.getElementById( 'previewDesign' );
        previewArea.innerHTML = '<img src="' + image + '" style="border:1px solid #C0C0C0"" />'
        previewArea.style.display = 'inline';
    }
{/literal}
</script>
{def $available_designs = ezini( 'Designs', 'Design', 'newsletterdesigns.ini' )}
{def $design_image = false()}
{def $design_name = false()}
<select name="AllowedDesigns[]" onMouseOut="hidePreview()" multiple="multiple" size="7">
{foreach $available_designs as $design}
    {set $design_image = ezini( $design, 'PreviewImage', 'newsletterdesigns.ini' )}
    {set $design_name = ezini( $design, 'Description', 'newsletterdesigns.ini' )}
    {$design_image|ezimage( 'no' )}
    <option onMouseOver="showPreview('{$design_image|ezimage('no')}')" value="{$design}" {cond( $selected_designs|contains( $design ), 'selected="selected"', '' )}>{$design_name|wash}</option>
{/foreach}
</select>
<span id="previewDesign" style="display:none">
</span>
</div>

{*
<div class="block">
<label>{'Related objects'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
<div class="element">
    {if $newsletter_type.related_object_id_1}
        <ul><li>{$newsletter_type.related_object_1.name}</li></ul>
        <input class="button" type="submit" name="BrowseRelatedObject_1" value="{'Add related object'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
        <input class="button" type="submit" name="DeleteRelatedObject_1" value="{'Remove object location'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
        {else}
            {'No object relation selected'|i18n( 'design/eznewsletter/edit_newslettertype' )}&nbsp;
            <input class="button" type="submit" name="BrowseRelatedObject_1" value="{'Add related object'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
    {/if}
</div>
<div class="element">
    {if $newsletter_type.related_object_id_2}
        <ul><li>{$newsletter_type.related_object_2.name}</li></ul>
        <input class="button" type="submit" name="BrowseRelatedObject_2" value="{'Add related object'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
        <input class="button" type="submit" name="DeleteRelatedObject_2" value="{'Remove object location'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
        {else}
            {'No object relation selected'|i18n( 'design/eznewsletter/edit_newslettertype' )}&nbsp;
            <input class="button" type="submit" name="BrowseRelatedObject_2" value="{'Add related object'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
    {/if}
</div>
<div class="element">
    {if $newsletter_type.related_object_id_3}
        <ul><li>{$newsletter_type.related_object_3.name}</li></ul>
        <input class="button" type="submit" name="BrowseRelatedObject_3" value="{'Add related object'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
        <input class="button" type="submit" name="DeleteRelatedObject_3" value="{'Remove object location'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
        {else}
            {'No object relation selected'|i18n( 'design/eznewsletter/edit_newslettertype' )}&nbsp;
            <input class="button" type="submit" name="BrowseRelatedObject_3" value="{'Add related object'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
    {/if}
</div>
</div>
*}
<br />
<div class="block">
<label>{'Newsletter suggestion inbox'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
{if $newsletter_type.inbox_object}
<ul><li>{$newsletter_type.inbox_object.name|wash()}</li></ul>
<input class="button" type="submit" name="BrowseInbox" value="{'Change inbox placement'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
<input class="button" type="submit" name="DeleteInbox" value="{'Delete inbox placement'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
{else}
{'No newsletter placement is specified'|i18n( 'design/eznewsletter/edit_newslettertype' )}&nbsp;
<input class="button" type="submit" name="BrowseInbox" value="{'Add inbox placement'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
{/if}
</div>


<div class="block">
<label>{'Newsletter placement'|i18n( 'design/eznewsletter/edit_newslettertype' )}:</label>
{if $newsletter_type.article_pool_object}
<ul><li>{$newsletter_type.article_pool_object.name|wash()}</li></ul>
<input class="button" type="submit" name="BrowseArticlePool" value="{'Change newsletter placement'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
<input class="button" type="submit" name="DeleteArticlePool" value="{'Delete newsletter placement'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
{else}
{'No newsletter placement is specified'|i18n( 'design/eznewsletter/edit_newslettertype' )}&nbsp;
<input class="button" type="submit" name="BrowseArticlePool" value="{'Add newsletter placement'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
{/if}
</div>


</div>

{* DESIGN: Content END *}</div></div></div>

<div class="controlbar">
{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
<div class="block">
<input class="button" type="submit" name="StoreButton" value="{'OK'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
<input class="button" type="submit" name="CancelButton" value="{'Cancel'|i18n( 'design/eznewsletter/edit_newslettertype' )}" />
</div>
{* DESIGN: Control bar END *}</div></div></div></div></div></div>
</div>

</div>
</form>


{literal}
<script language="JavaScript" type="text/javascript">
<!--
    window.onload=function()
    {
        document.getElementById('newsletterTypeName').select();
        document.getElementById('newsletterTypeName').focus();
    }
-->
</script>
{/literal}

