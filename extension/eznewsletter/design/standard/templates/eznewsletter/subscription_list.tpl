{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{* eZNewsletter - subscriptions list *}
{def $base_uri=concat( 'newsletter/subscription_list/', $subscriptionList.url_alias )}

<div class="context-block">
{* DESIGN: Header START *}
<div class="box-header">
    <div class="box-tc">    
        <div class="box-ml">
            <div class="box-mr">
                <div class="box-tl">
                    <div class="box-tr">
                        <h1 class="context-title">{'Subscription list <%subscription_list_name>'|i18n( 'eznewsletter',, hash( '%subscription_list_name', $subscriptionList.name ) )|wash}</h1>
{* DESIGN: Mainline *}
                    <div class="header-mainline">
                    </div>
{* DESIGN: Header END *}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{* DESIGN: Content START *}
<div class="box-ml">
    <div class="box-mr">
        <div class="box-content">
            <div class="context-attributes">
                <div class="block float-break">
                    {* Name. *}
                    <div class="element">
                        <label>{"Name"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {$subscriptionList.name|wash}
                    </div>
                    
                    {* Creator. *}
                    <div class="element">
                        <label>{"Creator"|i18n( 'design/eznewsletter/subscription_list' )}:</label> <a href={$subscriptionList.creator.contentobject.main_node.url_alias|ezurl}>{$subscriptionList.creator.contentobject.name|wash}</a>
                    </div>
                    
                    {* Created. *}
                    <div class="element">
                        <label>{"Created"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {$subscriptionList.created|l10n( datetime )}
                    </div>
                    
                    {* Description *}
                    <div class="block float-break">
                        <label>{"Description"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {$subscriptionList.description|wash|nl2br}
                    </div>
                    
                    {* URL *}
                    <div class="block float-break">
                        <label>{"URL"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {concat( 'newsletter/register_subscription/', $subscriptionList.url_alias )|ezurl(no)}
                    </div>
                    
                    
                    <div class="block float-break">
                    
                    {* Login steps. *}
                    <div class="element">
                        <label>{"Login steps"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {$loginSteps_map[$subscriptionList.login_steps]|wash}
                    </div>
                    
                    {* Require passowrd. *}
                    <div class="element">
                        <label>{"Require password"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {cond( $subscriptionList.require_password, 'Yes'|i18n( 'design/eznewsletter/subscription_list' ), 'No'|i18n( 'design/eznewsletter/subscription_list' ) )}
                    </div>
                    </div>
                    <div class="block float-break">
                    {* Allow anonymous. *}
                    <div class="element">
                        <label>{"Allow anonymous users"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {cond( $subscriptionList.allow_anonymous, 'Yes'|i18n( 'design/eznewsletter/subscription_list' ), 'No'|i18n( 'design/eznewsletter/subscription_list' ) )}
                    </div>
                    
                    {* Auto confirm registered users. *}
                    <div class="element">
                        <label>{"Automatically confirm registered users"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {cond( $subscriptionList.auto_confirm_registered, 'Yes'|i18n( 'design/eznewsletter/subscription_list' ), 'No'|i18n( 'design/eznewsletter/subscription_list' ) )}
                    </div>
                    
                    {* Auto approve registered users. *}
                    <div class="element">
                        <label>{"Automatically approve registered users"|i18n( 'design/eznewsletter/subscription_list' )}:</label> {cond( $subscriptionList.auto_approve_registered, 'Yes'|i18n( 'design/eznewsletter/subscription_list' ), 'No'|i18n( 'design/eznewsletter/subscription_list' ) )}
                    </div>
                    </div>
{*
                    <div class="block">
                        <label>{'Related objects'|i18n( 'design/eznewsletter/subscription_list' )}:</label>
                            <div class="element">
                                1. {cond( $subscriptionList.related_object_id_1, concat( '<a href=', $subscriptionList.related_object_1.main_node.url_alias|ezurl, '>', $subscriptionList.related_object_1.name, '</a>' ),
                                                                    'No related object specified'|i18n( 'design/eznewsletter/subscription_list' ) )}
                            </div>
                            <div class="element">
                                2. {cond( $subscriptionList.related_object_id_2, concat( '<a href=', $subscriptionList.related_object_2.main_node.url_alias|ezurl, '>', $subscriptionList.related_object_2.name, '</a>' ),
                                                                    'No related object specified'|i18n( 'design/eznewsletter/subscription_list' ) )}
                            </div>
                            <div class="element">
                                3. {cond( $subscriptionList.related_object_id_3, concat( '<a href=', $subscriptionList.related_object_3.main_node.url_alias|ezurl, '>', $subscriptionList.related_object_3.name, '</a>' ),
                                                                    'No related object specified'|i18n( 'design/eznewsletter/subscription_list' ) )}
                            </div>
                    </div>
*}
                    <div class="block">
                        <label>{'Allowed siteaccesses'|i18n( 'design/eznewsletter/subscription_list' )}:</label>
                            <ul>
                                {foreach $subscriptionList.allowed_siteaccesses_array as $siteaccess}
                                     <li>{$siteaccess|wash}</li>
                                {/foreach}
                            </ul>
                        </div>
                
                        <div class="break">
                        </div>
                    

{* DESIGN: Content END *}
                </div>
            </div>
{* Buttons. *}
    <div class="controlbar" >
{* DESIGN: Control bar START *}
        <div class="box-bc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tc">
                        <div class="box-bl">
                            <div class="box-br">
                                {* Edit *}
                                <div class="left">
                                    <form name="edit_subscription_list" method="post" action={concat( '/newsletter/edit_subscription_list/', $subscriptionList.url_alias )|ezurl} style="display:inline">
                                        <input class="button" type="submit" name="EditButton" value="{'Edit'|i18n( 'design/admin/rss/edit_import' )}" title="{'Edit current subscription list.'|i18n( 'design/eznewsletter/subscription_list' )}" />
                                    </form>
                                    <form name="import_csv" method="post" action={concat( 'newsletter/subscription_import/', $subscriptionList.url_alias )|ezurl} style="display:inline">
                                        <input class="button" type="submit" name="importcsv" value="{'Import CSV'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Import contact from CSV file.'|i18n( 'design/eznewsletter/subscription_list' )}" />
                                    </form>
                                </div>
{* DESIGN: Control bar END *}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="context-block">

{* DESIGN: Header START *}
    <div class="box-header">
        <div class="box-tc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tl">
                        <div class="box-tr">
                            <h2 class="context-title">{'Subscriber list'|i18n( 'design/eznewsletter/subscription_list' )}</h2>
{* DESIGN: Subline *}
                            <div class="header-subline">
                            </div>
{* DESIGN: Header END *}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{* DESIGN:  START *}
    <div class="box-ml">
        <div class="box-mr">
            <div class="box-content">
                <div class="context-attributes">
                    {* Subscriber list *}
                  <form name="subscription_list" method="post" action={concat( '/newsletter/subscription_list/', $subscriptionList.url_alias )|ezurl} style="display:inline">
                    <div class="context-toolbar subscriber-list">
                        <div class="right-subscriber">
                             <div class="element">
                                    <label>{'Status:'|i18n( 'design/eznewsletter/subscription_list' )}</label>
                                    <select name="statusFilter[]" {*multiple="multiple" size="8"*}>
                                        <option value="-1" {cond( $statusFilter|contains( -1 ), 'selected="selected"', '' )}>{'Show all'|i18n( 'design/eznewsletter/subscription_list' )}
                                        </option>
                                            {foreach $status_map as $value => $name}
                                                <option value="{$value}" {cond( $statusFilter|contains( $value ), 'selected="selected"', '' )} >{$name|wash}</option>
                                            {/foreach}
                                    </select>
                                    <input class="button" type="submit" name="SubmitFilter" value="{'Filter'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Filter  subscription list.'|i18n( 'design/eznewsletter/subscription_list' )}" />
                                </div>
{*
                                <div class="element">
                                        <label>{'VIP:'|i18n( 'design/eznewsletter/subscription_list' )}
                                        </label>
                                        <select name="(vipFilter)[]" multiple="multiple" size="8">
                                            <option value="-1" {cond( $view_parameters.statusFilter|contains( -1 ), 'selected="selected"', '' )}>{'Show all'|i18n( 'design/eznewsletter/subscription_list' )}
                                            </option>
                                             {foreach $vip_map as $value => $name}
                                                <option value="{$value}" {cond( $view_parameters.vipFilter|contains( $value ), 'selected="selected"', '' )} >{$name|wash}</option>
                                             {/foreach}
                                        </select>
                                        <input class="button" type="submit" name="Submit" value="{'Filter'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Filter  subscription list.'|i18n( 'design/eznewsletter/subscription_list' )}" />
                                </div>
*}
                        </div>
                        <p>
                        {switch match=$limit}
                            {case match=25}
                                <a href={'/user/preferences/set/admin_list_limit/1'|ezurl} title="{'Show 10 items per page.'|i18n( 'design/admin/node/view/full' )}">10</a>
                                <span class="current">25</span>
                                <a href={'/user/preferences/set/admin_list_limit/3'|ezurl} title="{'Show 50 items per page.'|i18n( 'design/admin/node/view/full' )}">50</a>
                            {/case}
                            {case match=50}
                                <a href={'/user/preferences/set/admin_list_limit/1'|ezurl} title="{'Show 10 items per page.'|i18n( 'design/admin/node/view/full' )}">10</a>
                                <a href={'/user/preferences/set/admin_list_limit/2'|ezurl} title="{'Show 25 items per page.'|i18n( 'design/admin/node/view/full' )}">25</a>
                                <span class="current">50</span>
                            {/case}
                            {case}
                                <span class="current">10</span>
                                <a href={'/user/preferences/set/admin_list_limit/2'|ezurl} title="{'Show 25 items per page.'|i18n( 'design/admin/node/view/full' )}">25</a>
                                <a href={'/user/preferences/set/admin_list_limit/3'|ezurl} title="{'Show 50 items per page.'|i18n( 'design/admin/node/view/full' )}">50</a>
                            {/case}
                        {/switch}
                        </p>
                        <div class="break">
                        </div>
                </div>

                {* Subscription list table. *}
                <div class="overflow-table">
                    <table class="list" cellspacing="0">
                        <tr>
                            <th class="tight"><img src={'toggle-button-16x16.gif'|ezimage} alt="{'Invert selection'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Invert selection'|i18n( 'design/eznewsletter/subscription_list' )}" onclick="ezjs_toggleCheckboxes( document.subscription_list, 'SubscriptionIDArray[]' ); return false;" /></th>
                            <th class="tight">{'ID'|i18n('eznewslettert')}</th>
                            <th>{'First name'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                            <th>{'Last name'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                            <th>{'Email'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                        {*  <th>{'VIP'|i18n( 'design/eznewsletter/subscription_list' )}</th> *}
                            <th>{'Status'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                            <th>{'Created'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                            <th>{'Confirmed'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                            <th>{'Approved'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                            <th>{'Removed'|i18n( 'design/eznewsletter/subscription_list' )}</th>
                            <th></th>
                        </tr>
                            {foreach $subscriberList as $subscriber
                                    sequence array( bglight, bgdark ) as $seq}
                            
                                <tr class="{$seq}">
                                    <td>
                                        <input type="checkbox" name="SubscriptionIDArray[]" value="{$subscriber.id}" title="{'Select subscriber for removal'|i18n( 'design/eznewsletter/subscription_list' )}" />
                                    </td>
                                    <td class="number" align="right">{$subscriber.id}
                                    </td>
                                    <td> 
                                        {cond( $subscriber.user_id|gt(0), concat( '<a href=', $subscriber.user.contentobject.main_node.url_alias|ezurl, '>' ), '' )}{$subscriber.firstname|wash}{cond(  $subscriber.user_id|gt(0), '</a>', '' )}
                                    </td>
                                    <td>
                                        {cond( $subscriber.user_id|gt(0), concat( '<a href=', $subscriber.user.contentobject.main_node.url_alias|ezurl, '>' ), '' )}{$subscriber.name|wash}{cond( $subscriber.user_id|gt(0), '</a>', '' )}
                                    </td>
                                    <td>
                                        <a href="mailto:{$subscriber.email|wash}">{$subscriber.email|wash}
                                        </a>
                                    </td>
                                {*    <td>{$vip_map[$subscriber.vip]|wash}</td> *}
                                    <td>
                                        {$status_map[$subscriber.status]|wash}
                                    </td>
                                    <td>
                                        {cond( $subscriber.created|gt(0), $subscriber.created|l10n( shortdatetime ), 'n/a'|i18n( 'design/eznewsletter/subscription_list' ) )}
                                    </td>
                                    <td>
                                        {cond( $subscriber.confirmed|gt(0), $subscriber.confirmed|l10n( shortdatetime ), 'n/a'|i18n( 'design/eznewsletter/subscription_list' ) )}
                                    </td>
                                    <td>
                                        {cond( $subscriber.approved|gt(0), $subscriber.approved|l10n( shortdatetime ), 'n/a'|i18n( 'design/eznewsletter/subscription_list' ) )}
                                    </td>
                                    <td>
                                        {cond( $subscriber.removed|gt(0), $subscriber.removed|l10n( shortdatetime ), 'n/a'|i18n( 'design/eznewsletter/subscription_list' ) )}
                                    </td>
                                    <td>
                                            <a href={concat( '/newsletter/edit_subscription/', $subscriber.id )|ezurl}><img src={'edit.gif'|ezimage} alt="{'Edit'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Edit the <%newsletter_name> subscription.'|i18n( 'eznewsletter',, hash( '%newsletter_name', $subscriber.name ) )|wash}" /></a>
                                    </td>
                                </tr>
                            {/foreach}
                    </table>
                </div>

{* Navigator. *}
<div class="context-toolbar">
    {include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=$base_uri
         item_count=$subscriptionCount
         view_parameters=$view_parameters
         item_limit=$limit}
</div>



    <div class="controlbar">
{* DESIGN: Control bar START *}
        <div class="box-bc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tc">
                        <div class="box-bl">
                            <div class="box-br">
                                <input class="button" type="submit" name="RemoveSingleSubscriptionButton" value="{'Remove selected subscription'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Remove selected subscription.'|i18n( 'design/eznewsletter/subscription_list' )}" />
                                <input class="button" type="submit" name="CreateSubscriptionButton" value="{'New subscription'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Create a new subscription.'|i18n( 'design/eznewsletter/subscription_list' )}" />
                                <input class="button" type="submit" name="RemoveSubscriptionButton" value="{'Remove all subscriptions for the selected user'|i18n( 'design/eznewsletter/subscription_list' )}" title="{'Remove selected subscription.'|i18n( 'design/eznewsletter/subscription_list' )}" />
{* DESIGN: Control bar END *}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{* DESIGN: Table END *}
        </div>
    </div>
</div>
{* DESIGN: Content END *}</div></div></div></div></div>
</div>
