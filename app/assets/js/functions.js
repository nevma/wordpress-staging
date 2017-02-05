jQuery( function () {

    $( '.action-log' ).on( 'click', function () {

        document.location.href = $( this ).attr( 'href' ) + '&log-length=' + window.parseInt( $( '#log-length' ).val() );
        return false;

    });

    $( '#websites-select' ).on( 'change', function () {

        $( '#path' ).val( $( this ).val() );

    });

});