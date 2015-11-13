{if eq($star, 1)}
	Supprimer de ma présentation
	<script type="text/javascript">
  alert('Ce document a été ajouté à votre présentation');
</script>
{else}
	Ajouter à ma présentation
{/if}
{def $bookmarks=fetch( 'content', 'bookmarks' )}
<script type="text/javascript">
  $('#nb_notifications').html(' {count($bookmarks)} document(s)');
</script>