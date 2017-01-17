/**
 * Scope which encapsulates and runs the initialisation scripts of the main
 * Responsiville object and all the Responsiville modules.
 *
 * @namespace Responsiville.Run
 */



// Responsiville Mobimenu auto initialise.

if ( Responsiville.Mobimenu.AUTO_RUN ) {

    Responsiville.Main.getInstance().on( 'init', function () {
        Responsiville.Mobimenu.autoRun();
    });

}



// Responsiville Megamenu auto initialise.

if ( Responsiville.Megamenu.AUTO_RUN ) {

    Responsiville.Main.getInstance().on( 'init', function () {
        Responsiville.Megamenu.autoRun();
    });

}



// Responsiville Scrollmenu auto initialise.

if ( Responsiville.Scrollmenu.AUTO_RUN ) {

    Responsiville.Main.getInstance().on( 'init', function () {
        Responsiville.Scrollmenu.autoRun();
    });

}



// Responsiville Slideshow auto initialise.

if ( Responsiville.Slideshow.AUTO_RUN ) {

    Responsiville.Main.getInstance().on( 'init', function () {
        Responsiville.Slideshow.autoRun();
    });

}



// Responsiville Accordion auto initialise.

if ( Responsiville.Accordion.AUTO_RUN ) {

    Responsiville.Main.getInstance().on( 'init', function () {
        Responsiville.Accordion.autoRun();
    });

}



// Responsiville Equalheights auto initialise.

if ( Responsiville.Equalheights.AUTO_RUN ) {

    Responsiville.Main.getInstance().on( 'init', function () {
        Responsiville.Equalheights.autoRun();
    });

}