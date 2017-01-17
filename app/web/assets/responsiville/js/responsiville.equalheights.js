/**
 * Creates and initialises the equal heights elements. 
 * 
 * @class
 * @extends   Responsiville.Debug
 * @extends   Responsiville.Events
 * 
 * @author    Nevma, info@nevma.gr
 * @license   Nevma Copyright (c) http://www.nevma.gr
 * 
 * @fires     Responsiville.Equalheights#init
 * 
 * @classdesc A utility class that takes a set of elements and gives them all
 *            the same height, ie the height of the tallest of them. It is 
 *            responsive and allows for grouping the elements in rows. It can 
 *            run in an automatic way so that it groups elements in the same 
 *            way that they naturally flow in rows as they are being rendered by
 *            the browser.
 *
 * @param {Object} options The initialisation options of the module.
 * 
 * @property {Object}  options           The options that define the object 
 *                                       behaviour.
 * @property {boolean} options.debug     Whether to print debug messages in the 
 *                                       browser console.
 * @property {string}  options.container The parent element under which the 
 *                                       elements will be found. If null then 
 *                                       the direct parent of the elements will
 *                                       be taken into account.
 * @property {string}  options.elements  The element that contains the elements
 *                                       which will eventually take up the same 
 *                                       height. If left null then the direct 
 *                                       elements if the parent will be taken 
 *                                       into account.
 * @property {string}  options.children  Sometimes it's not the actual elements
 *                                       themselves that we want to make equal
 *                                       height but some other elements inside
 *                                       them, so that we can have consistent
 *                                       rows of of content. This option is a 
 *                                       selector that defines which children
 *                                       inside the specified elements should
 *                                       become equal height.
 * @property {string}  options.resize    Whether to also run on window resize,
 *                                       as well as each breakpoint change. Of 
 *                                       course, throttled.
 * @property {string}  options.enter     Comma separated list of breakpoints in 
 *                                       which the module enters, wihch means it
 *                                       is enabled.
 * @property {string}  options.leave     Comma separated list of breakpoints in 
 *                                       which the module leaves, which means it
 *                                       is disabled.
 */

Responsiville.Equalheights = function ( options ) {

    // Responsiville must be initialised.

    if ( ! Responsiville.Main.getInstance() ) {

        throw new Error( 'Responsiville instantiation error: the framework has not been initialised, call new Responsiville::Main() and then Responsiville::init().' );

    }



    // General settings setup.

    this.options       = jQuery.extend( this.options, Responsiville.Equalheights.defaults, options );
    this.codeName      = 'responsiville.equalheights';
    this.responsiville = Responsiville.Main.getInstance();
    this.imagesLoaded  = 0;



    // Cache important DOM elements.

    this.$body = this.responsiville.$body;

    this.$container = jQuery( this.options.container );



    // Check for developer settings inside main element's data attributes.

    for ( var key in this.options ) {

        var value = this.$container.data( 'responsiville-equalheights-' + key );

        if ( typeof value !== 'undefined' ) {
            this.options[key] = value;
        }

    }
    


    // Main equal heights elements.
    
    this.$elements = this.$container.find( this.options.elements );

    if ( this.$elements.length === 0 ) {
        this.$elements = this.$container.children();
    }

    
    
    // If no elements found raise an error.
    
    if ( this.$elements.length === 0 ) {

        this.log( 'Responsiville.Equalheights instantiation error: no elements found (' + this.options.elements + ').' );
        return;

    }



    // Images inside equal heights elements.

    this.$images = this.$elements.find( 'img' );



    // Initialises the equalheights.
        
    this.setupEvents();

    this.log( 'creating equalheights' );



    /**
     * Called after the module has been initialised.
     * 
     * @event Responsiville.Equalheights#init
     */

    this.fireEvent( 'init' );

};



// Extend with logging functions.

Responsiville.extend( Responsiville.Equalheights, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Equalheights, Responsiville.Events );



/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Equalheights.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;



/**
 * @property {Object} defaults Default values for this module settings.
 */

Responsiville.Equalheights.defaults = {
    debug     : false,
    container : '.responsiville-equalheights',
    elements  : '.responsiville-equalheights-element',
    children  : null,
    resize    : true,
    enter     : 'small, mobile, tablet, laptop, desktop, large, xlarge',
    leave     : ''
};



/**
 * Runs through the page and searches for elements that apply to the current 
 * module in order to apply it to them automatically. Useful for automatically
 * creating elements with this module's behaviour just by setting up the
 * predefined classes and data attributes in HTML elements of the page.
 *
 * @function
 * @static
 * 
 * @return {void}
 */

Responsiville.Equalheights.autoRun = function () {

    jQuery( Responsiville.Equalheights.defaults.container ).each( function () {

        new Responsiville.Equalheights({
            debug     : Responsiville.Main.getInstance().options.debug,
            container : this
        });
        
    });

};



/**
 * Sets up event handlers necessary for the object to function properly. 
 * 
 * @return {void}
 */

Responsiville.Equalheights.prototype.setupEvents = function () {

    var k, length;

    // Register to be enabled on the required breakpoints.
    
    var breakpointsEnter = Responsiville.splitAndTrim( this.options.enter );

    for ( k=0, length=breakpointsEnter.length; k<length; k++ ) {
        this.responsiville.on( 'enter.' + breakpointsEnter[k], this.getBoundFunction( this.enable ) );
    }

    // Register to be disabled on the required breakpoints.

    var breakpointsLeave = Responsiville.splitAndTrim( this.options.leave );

    for ( k=0, length=breakpointsLeave.length; k<length; k++ ) {
        this.responsiville.on( 'enter.' + breakpointsLeave[k], this.getBoundFunction( this.disable ) );
    }

    // Enable right away if necessary.
    
    if ( this.responsiville.is( this.options.enter ) ) {
        this.enable();
    }



    // Re-arrange elements on breakpoint change.
    
    this.responsiville.on( 'change', this.getBoundFunction( this.runElements ) );

    // Also on window resize if requested.
    
    if ( this.options.resize ) {
        this.responsiville.on( 'resize', this.getBoundFunction( this.runElements ) );
    }



    // Check which images have loaded and wait for the rest of them.
    
    for ( k=0, length=this.$images.length; k < length; k++ ) {

        var image = this.$images.eq( k ).get( 0 );

        if ( Responsiville.hasImageLoaded( image ) ) {

            this.imagesLoaded++;

        } else {

            image.onload  = this.getBoundFunction( this.imageLoaded );
            image.onerror = this.getBoundFunction( this.imageError );

        }

    }

};



/**
 * Enables the equalheights.
 *
 * @fires Responsiville.Equalheights#enabled
 * 
 * @return {void}
 */

Responsiville.Equalheights.prototype.enable = function () {

    this.log( 'enable equalheights' );



    /**
     * Called after the module has been enabled.
     * 
     * @event Responsiville.Equalheights#enabled
     */

    this.fireEvent( 'enabled' );
    
    this.runElements();

};



/**
 * Disables the equalheights.
 * 
 * @fires Responsiville.Equalheights#disabled
 * 
 * @return {void}
 */

Responsiville.Equalheights.prototype.disable = function () {

    this.log( 'disable equalheights' );



    // Restore elements' height to auto.

    if ( this.options.children ) {
        this.$elements.find( this.options.children ).css( 'height', 'auto' );
    } else {
        this.$elements.css( 'height', 'auto' );
    }



    /**
     * Called after the module has been disabled.
     * 
     * @event Responsiville.Equalheights#disabled
     */
    
    this.fireEvent( 'disabled' );

};



/**
 * Callback that runs when an image inside an element in the equal heights 
 * module has successfully loaded.
 * 
 * @fires Responsiville.Equalheights#imageLoaded
 * 
 * @param {Event} event The image loaded event that originally fired.
 * 
 * @return {void}
 */

Responsiville.Equalheights.prototype.imageLoaded = function ( event ) {

    this.imagesLoaded++;

    if ( this.imagesLoaded == this.$images.length ) {

        this.runElements();

    }



    /**
     * Called after an image inside an equal heights element has loaded.
     * 
     * @event Responsiville.Equalheights#imageLoaded
     */

    this.fireEvent( 'imageLoaded', [ event ] );

};



/**
 * Runs when an image inside an element in the equal heights module has aborted
 * loading due to any error.
 * 
 * @fires Responsiville.Equalheights#imageError
 * 
 * @param {Event} event The image error event that originally fired.
 * 
 * @return {void}
 */

Responsiville.Equalheights.prototype.imageError = function ( event ) {

    this.imagesLoaded++;

    if ( this.imagesLoaded == this.$images.length ) {

        this.runElements();

    }



    /**
     * Called after an image inside an equal heights element was unable to load
     * due to an error.
     * 
     * @event Responsiville.Equalheights#imageError
     */

    this.fireEvent( 'imageError', [ event ] );

};



/**
 * Makes all elements inside the given range take up equal height.
 *
 * @param {int} startIndex The starting point of the range inside the given
 *                         elements array.
 * @param {int} endIndex   The ending point of the range inside the given
 *                         elements array.
 * 
 * @return {void}
 */

Responsiville.Equalheights.prototype.equalise = function ( startIndex, endIndex ) {

    var k                = 0;
    var m                = 0;
    var height           = 0;
    var maxHeight        = 0;
    var $element         = null;
    var childrenSelector = null;

    if ( this.options.children ) {

        // Case where children of the elements inside the container are to be equalised.
        
        var childrenSelectors = Responsiville.splitAndTrim( this.options.children );

        for ( m = 0, length = childrenSelectors.length; m < length; m++ ) {

            childrenSelector = childrenSelectors[m];

            maxHeight = 0;

            for ( k = startIndex; k <= endIndex; k++ ) {

                $element = this.$elements.eq( k ).find( childrenSelector );
                $element.css( 'height', 'auto' );
                height = $element.outerHeight();
                maxHeight = height > maxHeight ? height : maxHeight;

            }

            this.$elements.
                slice( startIndex, endIndex+1 ).
                find( childrenSelector ).
                css( 'height', maxHeight + 'px' );

        }

    } else {

        // Case where the elements inside the container themselves are to be equalised.

        for ( k = startIndex; k <= endIndex; k++ ) {

            $element = this.$elements.eq( k );
            $element.css( 'height', 'auto' );
            height = $element.outerHeight();
            maxHeight = height > maxHeight ? height : maxHeight;

        }

        this.$elements.
            slice( startIndex, endIndex+1 ).
            css( 'height', maxHeight + 'px' );

    }

};



/**
 * Runs through elements and groups them in bunches, ie groups that take up full
 * rows of content pertaining to the given container and for each breakpoint, in
 * order to make them take up equal heights. The algorithm used to achieve this
 * is based on iterating over the given elements and detecting where a new row
 * of elements has begun (row refers to what the user sees according to what the
 * browser has rendered).
 *
 * @fires Responsiville.Equalheights#runningElements
 * @fires Responsiville.Equalheights#runElements
 * 
 * @return {void}
 */

Responsiville.Equalheights.prototype.runElements = function () {

    // Check if the call is inside a breakpoint where the modules should not run. 

    if ( this.responsiville.is( Responsiville.splitAndTrim( this.options.leave ) ) ) {

        this.log( 'not equalising heights' );
        return;

    }

    this.log( 'equalising heights' );



    /**
     * Called before running through the elements to equalise heights.
     * 
     * @event Responsiville.Equalheights#runningElements
     */

    this.fireEvent( 'runningElements' );



    var k             = 0;
    var length        = 0;
    var startIndex    = 0;
    var endIndex      = 0;
    var isLastElement = false;
    var stopWhile     = false;

    // Calculate elements that take up whole rows of elements dynamically.
    
    while ( ! stopWhile ) {

        for ( k = startIndex, length = this.$elements.length; k < length; k++ ) {

            isLastElement = (k == length-1);
            stopWhile     = isLastElement;

            // Bypass the first element of each row.
            
            if ( k == startIndex ) {
                continue;
            }



            var $currentElement     = this.$elements.eq( k );
            var currentElementRect  = $currentElement.get( 0 ).getBoundingClientRect();
            var $previousElement    = this.$elements.eq( k-1 );
            var previousElementRect = $previousElement.get( 0 ).getBoundingClientRect();

            var isChangingRow = Math.round( currentElementRect.left ) < Math.round( previousElementRect.right );

            if ( isChangingRow ) {

                endIndex = k-1;
                break;
                
            }

            if ( isLastElement ) {
                
                endIndex = k;
                break;

            }

        }



        // Make the selected range of elements, which fill up a row, take up equal height.
        
        this.equalise( startIndex, endIndex );

        if ( stopWhile ) {

            if ( endIndex < length-1 ) {
                this.equalise( endIndex+1, length-1 );
            }

            break;

        }

        // Continue to the rest of the elements or stop altogether.

        startIndex = endIndex + 1;

    }



    /**
     * Called after running through the elements to equalise heights.
     * 
     * @event Responsiville.Equalheights#runElements
     */

    this.fireEvent( 'runElements' );

};