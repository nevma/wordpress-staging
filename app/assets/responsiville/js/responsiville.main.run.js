/**
 * Responsiville Main possible early auto initialise. This is here in an
 * independent Javascript file so that it can be separated from the
 * initialisation of the rest of the Responsiville modules, so that it can run
 * even in the head of the page if speed is of the essence and the page needs to
 * be enabled with the responsiville classes very early.
 */

if ( Responsiville.Main.AUTO_RUN ) {
    Responsiville.Main.autoRun();
}