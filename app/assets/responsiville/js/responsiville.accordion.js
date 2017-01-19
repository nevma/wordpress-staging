/**
 * Creates and initialises the accordion. 
 * 
 * @class
 * @extends   Responsiville.Debug
 * @extends   Responsiville.Events
 * 
 * @author    Nevma, info@nevma.gr
 * @license   Nevma Copyright (c) http://www.nevma.gr
 * 
 * @fires     Responsiville.Accordion#init
 * 
 * @classdesc A responsive accordion for the Responsiville framework. An 
 *            accordion is a drawer-like user interface element with multiple
 *            container which can be open one or many at a time.
 *
 * @param {Object} options The initialisation options of the module.
 * 
 * @property {Object}  options           The options that define the object
 *                                       behaviour.
 * @property {boolean} options.exclusive Whether multiple accordion panels 
 *                                       accordion can be simultaneously open or
 *                                       not. 
 * @property {boolean} options.debug     Whether to print debug messages in the 
 *                                       browser console.
 * @property {string}  options.container Selector for the element that contains
 *                                       the accordion contents. It is also
 *                                       possible to pass a DOM element or a 
 *                                       jQuery object here as well.
 * @property {string}  options.panel     Selector for the element that contains
 *                                       each independent accordion part. 
 * @property {string}  options.openClass Class added to each accordion panel 
 *                                       when it is opened.
 * @property {string}  options.header    Selector for the header element of each
 *                                       accordion panel. 
 * @property {string}  options.excerpt   Selector for the optional excerpt 
 *                                       element of each panel.
 * @property {string}  options.content   Selector for the content element of
 *                                       each panel.
 * @property {string}  options.footer    Selector for the footer element of each
 *                                       accordion panel. 
 * @property {string}  options.effect    The effect to use when opening and 
 *                                       closing each accordion panel (none, 
 *                                       slide, fade).
 * @property {int}     options.duration  The amount of time that the opening and
 *                                       closing of each accordion panel takes.
 * @property {int}     options.delay     The amount of time to delay before
 *                                       beginning opening or closing each
 *                                       accordion panel.
 * @property {int}     options.startAt   The index of the panel to show as open
 *                                       in the beginning (zero or negative for
 *                                       none).
 * @property {string}  options.enter     Comma separated list of breakpoints in 
 *                                       which the accordion enters, wihch means
 *                                       it is enabled.
 * @property {string}  options.leave     Comma separated list of breakpoints in 
 *                                       which the accordion leaves, which means 
 *                                       it is disabled.
 */

Responsiville.Accordion = function ( options ) {

    // Responsiville must be initialised.

    if ( ! Responsiville.Main.getInstance() ) {

        throw new Error( 'Responsiville instantiation error: the framework has not been initialised, call new Responsiville::Main() and then Responsiville::init().' );

    }



    // General settings setup.

    this.options = jQuery.extend( this.options, Responsiville.Accordion.defaults, options );

    this.codeName = 'responsiville.accordion';

    this.responsiville = Responsiville.Main.getInstance();



    // Cache important DOM elements.

    this.$html   = this.responsiville.$html;
    this.$body   = this.responsiville.$body;
    this.$window = this.responsiville.$window;

    this.$container = jQuery( this.options.container );
    this.$panels    = this.$container.find( this.options.panel );



    // Check for developer settings inside main element's data attributes.

    for ( var key in this.options ) {

        var value = this.$container.data( 'responsiville-accordion-' + key.toLowerCase() );

        if ( typeof value !== 'undefined' ) {
            this.options[key] = value;
        }

    }
    
    
    
    // If no accordion found raise an error.
    
    if ( this.$container.length === 0 ) {

        this.log( 'Responsiville.Accordion instantiation error: no accordions found (' + this.options.container + ').' );

        return;

    }

    this.log( 'creating accordion' );



    // Initialises the accordion.
        
    this.enabled = false;

    this.setupEvents();



    /**
     * Called after the module has been initialised.
     * 
     * @event Responsiville.Accordion#init
     */

    this.fireEvent( 'init' );

};



// Extend with logging functions.

Responsiville.extend( Responsiville.Accordion, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Accordion, Responsiville.Events );



/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Accordion.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;



/**
 * @property {Object} defaults Default values for this module settings.
 */

Responsiville.Accordion.defaults = {
    debug     : false, 
    exclusive : false, 
    container : '.responsiville-accordion',
    panel     : '.responsiville-accordion-panel',
    openClass : 'responsiville-accordion-panel-open',
    header    : '.responsiville-accordion-header',
    excerpt   : '.responsiville-accordion-excerpt',
    content   : '.responsiville-accordion-content',
    footer    : '.responsiville-accordion-footer',
    effect    : 'slide',
    duration  : 300,
    delay     : 50,
    startAt   : -1,
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

Responsiville.Accordion.autoRun = function () {

    jQuery( Responsiville.Accordion.defaults.container ).each( function () {

        new Responsiville.Accordion({
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

Responsiville.Accordion.prototype.setupEvents = function () {

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

    

    // Which panel to open in the beginning.
    
    if ( this.options.startAt > 0 ) {
        this.openPanel( this.$panels.eq( this.options.startAt-1 ) );
    }

};



/**
 * Enables the accordion.
 *
 * @fires Responsiville.Accordion#enabled
 * 
 * @return {void}
 */

Responsiville.Accordion.prototype.enable = function () {

    if ( this.enabled ) {
        return;
    }



    this.log( 'enable accordion' );



    this.enabled = true;

    this.$container.addClass( 'responsiville-accordion-enabled' );

    this.$panels.
        find( this.options.header ).
        on( 'click', this.getBoundFunction( this.headerClick ) ).
        end().
            find( this.options.content ).
            css( 'display', 'none' );



    /**
     * Called after the accordion has been enabled.
     * 
     * @event Responsiville.Accordion#enabled
     */

    this.fireEvent( 'enabled' );

};



/**
 * Disables the accordion.
 * 
 * @fires Responsiville.Accordion#disabled
 * 
 * @return {void}
 */

Responsiville.Accordion.prototype.disable = function () {

    if ( ! this.enabled ) {
        return;
    }



    this.log( 'disable accordion' );

    

    this.enabled = false;

    this.$container.removeClass( 'responsiville-accordion-enabled' );

    this.$panels.
        find( this.options.header ).
        off( 'click', this.getBoundFunction( this.headerClick ) ).
        end().
            find( this.options.content ).
            css( 'display', 'block' );



    /**
     * Called after the accordion has been disabled.
     * 
     * @event Responsiville.Accordion#disabled
     */
    
    this.fireEvent( 'disabled' );

};



/**
 * Handles the click event on an accordion panel header element.
 * 
 * @param {Event} event The user click event sent by the browser.
 * 
 * @return {void}
 */

Responsiville.Accordion.prototype.headerClick = function ( event ) {

    this.log( 'accordion header clicked' );



    var $header    = jQuery( event.target );
    var $panel     = $header.closest( this.options.panel );
    var $content   = $panel.find( this.options.content );
    var $tempPanel = null;

    if ( $content.is( ':visible' ) ) {

        this.closePanel( $panel );
        
    } else {

        this.openPanel( $panel );

        if ( this.options.exclusive ) {

            for ( var k = 0, length = this.$panels.length; k < length; k++ ) {

                $tempPanel = this.$panels.eq( k );

                if (  $tempPanel.get( 0 ) === $panel.get( 0 ) ) {
                    continue;
                }

                this.closePanel( $tempPanel );
            }

        }

    }

    return false;

};



/**
 * Opens and shows the contents of an accordion panel.
 * 
 * @fires Responsiville.Accordion#panelOpened
 * @fires Responsiville.Accordion#panelOpening

 * @param {jQuery} $panel The accordion panel jQuery object whose contents are
 *                        to be shown.
 * 
 * @return {void}
 */

Responsiville.Accordion.prototype.openPanel = function ( $panel ) {

    this.log( 'accordion opening panel' );



    /**
     * Called before opening the panel.
     * 
     * @event Responsiville.Accordion#panelOpening
     */
    
    this.fireEvent( 'panelOpening' );

    

    $content = $panel.find( this.options.content );

    if ( this.options.effect == 'slide' ) {

        $content.velocity( 
            'slideDown', { 
                delay: this.options.delay, 
                duration: this.options.duration 
            }
        );
        
    } else if ( this.options.effect == 'fade' ) {

        $content.velocity( 
            'fadeIn', { 
                delay: this.options.delay,
                duration: this.options.duration
            }
        );
        
    } else if ( this.options.effect == 'none' ) {

        $content.velocity(
            'slideDown', { 
                delay: this.options.delay, 
                duration: 0 
        });
        
    }

    $panel.addClass( this.options.openClass );



    /**
     * Called after the panel has been opened.
     * 
     * @event Responsiville.Accordion#panelOpened
     */
    
    this.fireEvent( 'panelOpened' );

};



/**
 * Closes and hides the contents of an accordion panel.
 * 
 * @fires Responsiville.Accordion#panelClosing
 * @fires Responsiville.Accordion#panelClosed
 * 
 * @param {jQuery} $panel The accordion panel jQuery object whose contents are
 *                        to be hidden.
 * 
 * @return {void}
 */

Responsiville.Accordion.prototype.closePanel = function ( $panel ) {

    this.log( 'accordion closing panel' );



    /**
     * Called before closing the panel.
     * 
     * @event Responsiville.Accordion#panelClosing
     */
    
    this.fireEvent( 'panelClosing' );



    $content = $panel.find( this.options.content );

    if ( this.options.effect == 'slide' ) {

        $content.velocity( 'slideUp', { delay: this.options.delay, duration: this.options.duration });

    } else if ( this.options.effect == 'fade' ) {

        $content.velocity( 'fadeOut', { delay: this.options.delay, duration: this.options.duration });
        
    } else if ( this.options.effect == 'none' ) {

        $content.velocity( 'slideUp', { delay: this.options.delay, duration: 0 });
        
    }

    $panel.removeClass( this.options.openClass );



    /**
     * Called after the panel has closed.
     * 
     * @event Responsiville.Accordion#panelClosed
     */

    this.fireEvent( 'panelClosed' );

};