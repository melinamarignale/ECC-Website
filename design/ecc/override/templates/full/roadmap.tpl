<div id="content">
    <section id="what-is-ecc">
        <div class="description">
            {attribute_view_gui attribute=$node.data_map.description}
        </div>
    </section>
    <section id="list-roadmap">
        <div class="description">
            {attribute_view_gui attribute=$node.data_map.roadmap}
        </div>
    </section>

    <form class="formNewsletter" action="/newsletter/register_subscription/success" method="POST">
        <label for="newsletter">Newsletter</label>
        <input type="text" name="Email" id="newsletter" placeholder="{"votre_email"|i18n('ecc')}">
        <input type="submit" value="OK"  name="StoreButton">
    </form>
</div>