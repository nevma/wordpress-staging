/**
 * Creates and initialises the scrollmenu. 
 * 
 * @class
 * @extends   Responsiville.Debug
 * @extends   Responsiville.Events
 * 
 * @author    Nevma, info@nevma.gr
 * @license   Nevma Copyright (c) http://www.nevma.gr
 * 
 * @fires     Responsiville.Scrollmenu#init
 * 
 * @classdesc A responsive scrollmenu for the Responsiville framework. It makes 
 *            a menu, or any HTML element for that matter, stay fixed on top of 
 *            the screen as the user scrolls down the page. Pretty useful in 
 *            responsive web design and in long web pages in general.
 *
 * @param {Object} options The initialisation options of the module.
 * 
 * @property {Object}  options              The options that define the object
 *                                          behaviour.
 * @property {boolean} options.debug        Whether to print debug messages in
 *                                          the browser console.
 * @property {string}  options.element      Selector for the element that
 *                                          actually is the element to be fixed.
 * @property {string}  options.wrapper      The class of the wrapper element
 *                                          that will wrap around the actual
 *                                          element. 
 * @property {string}  options.enabled      The class added to the cloned
 *                                          element when the scrollmenu is 
 *                                          enabled. Note that the scrollmenu
 *                                          might be there without being
 *                                          enabled. Enabled does not mean
 *                                          active and visible. Enabled means
 *                                          having the readiness to become 
 *                                          active  upon the desired page 
 *                                          scroll.
 * @property {string}  options.active       The class added to the scrollmenu 
 *                                          whenit becomes active. 
 * @property {string}  options.activeBody   The class added to the body element 
 *                                          when the scrollmenu becomes active.
 * @property {string}  options.zIndex       Specify a z-index property different
 *                                          than the the default.
 * @property {string}  options.offsetTop    The extra space to wait for the user
 *                                          to scroll down to, after the
 *                                          original element is out of sight, 
 *                                          before showing the scrollmenu.
 * @property {string}  options.offsetBottom The reverse of offsetTop, the extra
 *                                          space before the original element
 *                                          would be back in sight, as the user 
 *                                          scrolls up, where the scrollmenu
 *                                          will be hidden.
 * @property {string}  options.enter        Comma separated list of breakpoints
 *                                          in which the module enters, wihch
 *                                          means it is enabled (not activated).
 * @property {string}  options.leave        Comma separated list of breakpoints
 *                                          in which the module leaves, which
 *                                          means it is disabled.
 */

Responsiville.Scrollmenu = function ( options ) {

    // Responsiville must be initialised.

    if ( ! Responsiville.Main.getInstance() ) {

        throw new Error( 'Responsiville instantiation error: the framework has not been initialised, call new Responsiville::Main() and then Responsiville::init().' );

    }



    // General settings setup.

    this.options  = jQuery.extend( this.options, Responsiville.Scrollmenu.defaults, options );
    this.codeName = 'responsiville.scrollmenu';

    this.responsiville = Responsiville.Main.getInstance();

    

    // Cache important DOM elements.

    this.$body   = this.responsiville.$body;
    this.$window = this.responsiville.$window;

    this.$element = jQuery( this.options.element );



    // Check for developer settings inside main element's data attributes.

    for ( var key in this.options ) {

        var value = this.$element.data( 'responsiville-scrollmenu-' + key.toLowerCase() );

        if ( typeof value !== 'undefined' ) {
            this.options[key] = value;
        }

    }
    
    
    
    // If no menu found raise an error.
    
    if ( this.$element.length === 0 ) {

        this.log( 'Responsiville.Scrollmenu instantiation error: no menus found (' + this.options.menu + ').' );
        return;

    }

    this.log( 'creating scrollmenu' );



    // Clone the element and work on the clone.

    this.$elementCloned = this.$element.clone( false ).
                                        wrap( '<div class = "' + this.options.wrapper + '" ' + ( this.options.zIndex > 0 ? 'style="z-index: ' + this.options.zIndex + ';"' : '' ) + '>' ).
                                        parent().
                                        appendTo( this.$body );



    // Initialises the scroll element.
    
    this.$element.data( 'offsetTop', Math.ceil( this.$element.offset().top ) );
        
    this.enabled   = false;
    this.activated = false;

    this.setupEvents();



    // Cache element initial position.
    
    this.$element.data( 'offsetTop', Math.ceil( this.$element.offset().top ) );



    // Search for a megamenu inside the cloned scroll element.
    
    this.$elementCloned.
        find( Responsiville.Megamenu.defaults.activator ).
        each( function () {

            new Responsiville.Megamenu({ 
                debug     : Responsiville.Main.getInstance().options.debug,
                activator : this 
            });
            
        });

    // Search for a mobimenu inside the cloned scroll element.
    
    this.$elementCloned.
        find( Responsiville.Mobimenu.defaults.element ).
        each( function () {

            new Responsiville.Mobimenu({ 
                debug   : Responsiville.Main.getInstance().options.debug,
                element : this 
            });
            
        });



    /**
     * Called after the scrollmenu has been created.
     * 
     * @event Responsiville.Scrollmenu#created
     */

    this.fireEvent( 'created' );

};



// Extend with logging functions.

Responsiville.extend( Responsiville.Scrollmenu, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Scrollmenu, Responsiville.Events );



/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Scrollmenu.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;



/**
 * @property {Object} defaults Default values for this module settings.
 */

Responsiville.Scrollmenu.defaults = {
    debug        : false, 
    element      : '.responsiville-scrollmenu',
    wrapper      : 'responsiville-scrollmenu-wrapper',
    enabled      : 'responsiville-scrollmenu-enabled',
    active       : 'responsiville-scrollmenu-active',
    activeBody   : 'responsiville-scrollmenu-active-body',
    zIndex       : -1,
    offsetTop    : 0,
    offsetBottom : 0,
    enter        : 'small, mobile, tablet, laptop, desktop, large, xlarge',
    leave        : ''
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

Responsiville.Scrollmenu.autoRun = function () {

    jQuery( Responsiville.Scrollmenu.defaults.element ).each( function () {

        new Responsiville.Scrollmenu({
            debug   : Responsiville.Main.getInstance().options.debug,
            element : this
        });
        
    });

};



/**
 * Sets up event handlers necessary for the object to function properly. 
 * 
 * @return {void}
 */

Responsiville.Scrollmenu.prototype.setupEvents = function () {

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

    

    // Add window scroll and resize handler
    
    var scrollThrottled = this.getBoundFunction( Responsiville.throttle( this.scroll ) );

    this.$window.on( 'scroll', scrollThrottled );
    this.$window.on( 'resize', scrollThrottled );

};



/**
 * Enables the scrollmenu. It does not activate it, it does not open it. It 
 * simply enables it, so when the necessary trigger is fired (ie the user 
 * scrolls down enough for the element to be hidden) then the element is
 * activated (which means it is fixed at the top of the screen). Useful in
 * responsive  web design.
 * 
 * @fires Responsiville.Scrollmenu#enabled
 * 
 * @return {void}
 */

Responsiville.Scrollmenu.prototype.enable = function () {

    this.log( 'enable scrollmenu' );

    this.enabled = true;

    this.$elementCloned.addClass( this.options.enabled );

    this.scroll();



    /**
     * Called after the scrollmenu has been enabled.
     * 
     * @event Responsiville.Scrollmenu#enabled
     */

    this.fireEvent( 'enabled' );

};



/**
 * Disables the scrollmenu. It does not deactivate it, it does not close it. It 
 * simply disables it, so it does not function any more when the necessary
 * trigger is fired. Useful in responsive web design.
 * 
 * @fires Responsiville.Scrollmenu#disabled
 * 
 * @return {void}
 */

Responsiville.Scrollmenu.prototype.disable = function () {

    this.log( 'disable scrollmenu' );

    this.deactivate();

    this.enabled = false;

    this.$elementCloned.removeClass( this.options.enabled );



    /**
     * Called after the scrollmenu has been disabled.
     * 
     * @event Responsiville.Scrollmenu#disabled
     */
    
    this.fireEvent( 'disabled' );

};



/**
 * Activates the scrollmenu, which means fixes it on top of the screen as the 
 * user keeps scrolling down.
 * 
 * @fires Responsiville.Scrollmenu#activating
 * @fires Responsiville.Scrollmenu#activated
 * 
 * @return {void}
 */

Responsiville.Scrollmenu.prototype.activate = function () {

    if ( ! this.enabled ) {
        return;
    }

    if ( this.activated )    {
        return;
    }



    this.log( 'activate scrollmenu' );

    

    /**
     * Called before the scrollmenu has been activated.
     * 
     * @event Responsiville.Scrollmenu#activating
     */
    
    this.fireEvent( 'activating' );



    this.$body.addClass( this.options.activeBody );
    this.$elementCloned.addClass( this.options.active );
    this.activated = true;

};



/**
 * Deactivates the scrollmenu, which means restoring it to its original state.
 *
 * @fires Responsiville.Scrollmenu#deactivating
 * @fires Responsiville.Scrollmenu#deactivated
 * 
 * @return {void}
 */

Responsiville.Scrollmenu.prototype.deactivate = function () {

    if ( ! this.enabled ) {
        return;
    }

    if ( ! this.activated )    {
        return;
    }



    this.log( 'deactivate scrollmenu' );



    /**
     * Called before the scrollmenu has been deactivated.
     * 
     * @event Responsiville.Scrollmenu#deactivating
     */
    
    this.fireEvent( 'deactivating' );



    this.$body.removeClass( this.options.activeBody );
    this.$elementCloned.removeClass( this.options.active );
    this.activated = false;



    /**
     * Called after the scrollmenu has been deactivated.
     * 
     * @event Responsiville.Scrollmenu#deactivated
     */
    
    this.fireEvent( 'deactivated' );

};



/**
 * Window scroll event handler which checks when the scrollmenu should be 
 * activated and deactivated. Can also be called on demand, if necessary.
 * 
 * @return {void}
 */

Responsiville.Scrollmenu.prototype.scroll = function () {

    if ( ! this.enabled ) {
        return;
    }



    this.log( 'scrollmenu scroll' );

    

    if ( this.$window.get( 0 ).scrollY > this.$element.data( 'offsetTop' ) + this.options.offsetTop ) {

        this.activate();
        
    } else if ( this.$window.get( 0 ).scrollY <= this.$element.data( 'offsetTop' ) + this.options.offsetBottom ) {

        this.deactivate();
        this.$element.data( 'offsetTop', Math.ceil( this.$element.offset().top ) );

    }

};