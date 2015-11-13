$(document).ready( function () {
	
	eZfranceInterface.init();
});
var eZfranceInterface = function(){
	function _init(){
		
	}
	function _trad(dataTable) {
		dataTable.setAttributeConfig("MSG_EMPTY", {
		   	 value: "Il n'y a pas de contenu ici."
		   });
		   dataTable.setAttributeConfig("MSG_LOADING", {
		        value: "Chargement..."
		    });
		   dataTable.setAttributeConfig("MSG_ERROR", {
		       value: "Erreur de chargement des données."
		   });
		   dataTable.setAttributeConfig("MSG_SORTDESC", {
		       value: "Trier par ordre décroissant"
		   });
		   dataTable.setAttributeConfig("MSG_SORTASC", {
		   	value: "Trier par ordre croissant"
		   });
	}
	return {init:_init,trad:_trad}
}();

