{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{* eZNewsletter - list bounces *}
{def $bounceTypes=hash( 0, 'Soft bounce'|i18n( 'design/eznewsletter/view_newsletter_bounce' ),
                        1, 'Hard bounce'|i18n( 'design/eznewsletter/view_newsletter_bounce' ) )}

<div class="context-block">
{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
<h1 class="context-title">{'Newsletter bounces'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

{* Bounced sendnewsletteritem entry. *}
<div class="context-attributes">
<h3>{'Sent item data:'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</h3>
<div class="block">

<div class="element">
<label>{'ID'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$sendnewsletteritem_bounced.id|wash}
</div>

<div class="element">
<label>{'Sent'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$sendnewsletteritem_bounced.send_ts|l10n( shortdatetime )}
</div>

<div class="element">
<label>{'Newsletter ID'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$sendnewsletteritem_bounced.newsletter_id|wash}
</div>

<div class="element">
<label>{'Subscription ID'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$sendnewsletteritem_bounced.subscription_id|wash()} (<a href={concat("/newsletter/edit_subscription/", $sendnewsletteritem_bounced.subscription_id)|ezurl()}">{'edit'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</a>)
</div>

<div class="element">
<label>{'Newsletter name'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$sendnewsletteritem_bounced.newsletter.name|wash}
</div>

</div>

<div class="block">
<h3>{'Subscriber data:'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</h3>
<div class="element">
<label>{'Subscriber name'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$sendnewsletteritem_bounced.user_data.name|wash}
</div>

<div class="element">
<label>{'Email'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$sendnewsletteritem_bounced.user_data.email|wash}

</div>
</div>

{if $bounce_object}
<div class="block">
<h3>{'Bounce details:'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</h3>
<label>{'Bounce response message:'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
<pre>
{$bounce_object.bounce_message|wash}
</pre>
</div>
{/if}

{*
{if $subscription_object}
<div class="block">
<h3>{'Subscription data:'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</h3>
<div class="element">
<label>{'Subscription list name'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$subscription_object.subscription_list.name|wash}
</div>

<div class="element">
<label>{'Status'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$statusNames[$subscription_object.status]|wash}

</div>
<div class="element">
<label>{'Bounce count'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
{$subscription_object.bounce_count|wash}
</div>
</div>
<div class="block">
<form name="subscription_entry" method="post" action={concat( 'newsletter/list_bounce/all/', $sendnewsletteritem_bounced.id, '/' )|ezurl}>
<label>{'Set new subscription status'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}</label>
<select name="NewSubscriptionStatus">
{foreach $statusNames as $key => $status}
    <option {cond( $subscription_object.status|eq( $key ), 'selected="selected"', '' )} value="{$key}">{$status|wash}</option>
{/foreach}
</select>

<input class="button" type="submit" name="EditButton" value="{'Set'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}" />
</form>
</div>
{/if}
*}
{* DESIGN: Content END *}</div></div></div>

{* Buttons. *}
<div class="controlbar">
{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
<div align="right"><input type=button value="{'Back to bounce list'|i18n( 'design/eznewsletter/view_newsletter_bounce' )}" onClick="history.back()"></a></div>
{* DESIGN: Control bar END *}</div></div></div></div></div></div>
</div>
</div>
