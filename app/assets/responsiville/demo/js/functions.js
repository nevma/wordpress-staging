jQuery( function () {

    // Set the selected menu element.

    var page = document.location.href;

    var from = page.lastIndexOf( '/' ) + 1;
    var to   = page.indexOf( '#' );

    if ( to > -1 ) {
        page = page.substring( from, to );
    } else {
        page = page.substring( from );
    }

    $( '.sidebar a[href="' + page + '"]' ).
        addClass( 'selected' ).
        closest( 'ul' ).
        siblings( 'a' ).
        addClass( 'selected-parent' );



    // Create the in-page navigation.

    var counter = 1;
    
    var menuHTML = '<nav class = "navigation-inner navigation horizontal clear"><ul>';

    $( 'h1, h2' ).each( function () {
    
        menuHTML += '<li><a href = "#' + counter + '">' + $( this ).text() + '</a></li>';

        $( this ).before( '<a name = "' + counter + '"></a>' );

        counter++;
        
    })

    menuHTML += '</ul></nav>';

    $( '.header-credits' ).after( menuHTML );



    // Make it a scrollmenu.

    var navigationInnerScrollmenu = new Responsiville.Scrollmenu({
        element : '.navigation-inner',
        enter   : 'small, mobile, tablet, laptop, desktop, large, xlarge',
        leave   : ''
    });

    $( '.navigation-inner a' ).click( function () {

        var href = $( this ).attr( 'href' );
        var name = href.substring( 1 );
        $( 'a[name="' + name + '"]' ).velocity( 'scroll', { duration: 300, offset: -50 });
        
    });

    var hash = document.location.href.substring( document.location.href.indexOf( '#' ) + 1 );

    if ( hash !== '' ) {
        $( 'a[name="' + hash + '"]' ).velocity( 'scroll', { duration: 300, offset: -50 });
    }

});