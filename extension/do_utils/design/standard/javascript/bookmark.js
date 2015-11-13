function ez_bookmark_change(nodeID)
{
	$.ajax({
	  url: '/bookmark/star/' + nodeID,
	  success: function(data) {
		  eltID = '#star_'+nodeID;
		  $(eltID).html(data);
	}});
}

