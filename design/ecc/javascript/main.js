function newsletter(){
    $( ".formNewsletter" ).submit(function( event ) {
        //alert($(".champ").val());
        event.preventDefault();
        event.stopPropagation();
        $.get(
            "evecorpcenter/newsletter",
            {
                Cemail : $("#newsletter").val()
            },
            function( data ) {
                $('.formNewsletter label').html( data );
                $('#newsletter').val("");
                //alert( data );
            }
        );
        return false;
    });
}

$('document').ready(function(){
    //newsletter();
});