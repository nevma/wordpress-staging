/**
 * Creates and initialises the megamenu. 
 * 
 * @class
 * @extends   Responsiville.Debug
 * @extends   Responsiville.Events
 * 
 * @author    Nevma, info@nevma.gr
 * @license   Nevma Copyright (c) http://www.nevma.gr
 *
 * @fires     Responsiville.Megamenu#init
 * 
 * @classdesc The megamenu is either a real "mega" menu or simply a dropdown 
 *            menu. It makes no difference actually. It is a menu that opens 
 *            when an event (eg a mouseover) on an activator is triggered and 
 *            hides when the mouse hovers away from the activator or the actual
 *            menu itself. It is not designed to be multi level.
 * 
 * @param {Object} options The initialisation options of the module.
 *
 * @property {Object}  options              The options that define the object
 *                                          behaviour.
 * @property {boolean} options.debug        Whether to print debug messages in 
 *                                          the browser console.
 * @property {string}  options.activator    Selector for the element on whose 
 *                                          mouse over the megamenu opens.
 * @property {string}  options.element      Selector for the element that 
 *                                          actually is the megamenu. Has to be
 *                                          a sibling of the activator. If left
 *                                          null then the first sibling of the
 *                                          activator is taken into account as a
 *                                          best guess.
 * @property {string}  options.enter        Comma separated list of breakpoints 
 *                                          in which the megamenu enters, wihch
 *                                          means it is enabled.
 * @property {string}  options.leave        Comma separated list of breakpoints 
 *                                          in which the megamenu leaves, which
 *                                          means it is disabled.
 * @property {string}  options.effect       The effect to use when opening and 
 *                                          closing the megamenu (eg 'slide').
 * @property {string}  options.elementClass Class to add to the megamenu element
 *                                          when it is enabled.
 * @property {string}  options.parentClass  Class to add to the parent element
 *                                          of the megamenu activator.
 * @property {string}  options.parentActive Class to add to the parent element
 *                                          when the megamenu is open and the
 *                                          user is hovering over is children.
 * @property {string}  options.openClass    The class to add to the megamenu 
 *                                          while it is open.
 * @property {string}  options.openingClass The class to add to the megamenu 
 *                                          when it is being opened.
 * @property {string}  options.closingClass The class to add to the megamenu 
 *                                          when it is being closed.
 * @property {int}     options.delayShow    The amount of time to wait before 
 *                                          the action on the activator causes
 *                                          the opening of the megamenu.
 * @property {int}     options.delayHide    The amount of time to wait before
 *                                          the action on the activator causes 
 *                                          the closing of the megamenu.
 * @property {int}     options.duration     The amount of time that the opening 
 *                                          and closing of the megamenu lasts.
 * 
 * @todo Activate on hover or click, as a parameter.
 * @todo What strategy do we follow for cases where a device has a big enough 
 *       screen to be classified among the desktop devices but does not support 
 *       mouse events? Facts: there are tablets with 1024 and 1280 wide screens 
 *       in landscape orientation.
 */

Responsiville.Megamenu = function ( options ) {

    // Responsiville must be initialised.

    if ( ! Responsiville.Main.getInstance() ) {

        throw new Error( 'Responsiville instantiation error: the framework has not been initialised, call new Responsiville::Main() and then Responsiville::init().' );

    }



    // General settings setup.

    this.options = {};

    this.options = jQuery.extend( this.options, Responsiville.Megamenu.defaults, options );

    this.codeName = 'responsiville.megamenu';

    this.responsiville = Responsiville.Main.getInstance();



    //  Menu element behaviour flags.

    this.timeoutHandler        = null;
    this.enteringMenuActivator = false;
    this.leavingMenuActivator  = false;
    this.enteringMenuElement   = false;
    this.leavingMenuElement    = false;



    // Cache main DOM element.
    
    this.$menuActivator = jQuery( this.options.activator );



    // Check for developer settings inside main element's data attributes.

    for ( var key in this.options ) {

        var value = this.$menuActivator.data( 'responsiville-megamenu-' + key.toLowerCase() );

        if ( typeof value !== 'undefined' ) {
            this.options[key] = value;
        }

    }


    
    // Cache other important DOM elements.
    
    this.$body        = this.responsiville.$body;
    this.$menuElement = this.$menuActivator.siblings( this.options.element );



    // If no menu element is found take the first sibling of the activator as a best guess.
    
    if ( this.$menuElement.length === 0 ) {

        this.$menuElement = this.$menuActivator.siblings().eq( 0 );

    }
    
    
    
    // If no menu element found raise an error.
    
    if ( this.$menuElement.length === 0 ) {

        this.log( 'Responsiville.Megamenu instantiation error: no menu found (' + this.options.element + ').' );

        return;

    }



    // Initialise the mega menu events.
    
    this.setupEvents();



    this.log( 'creating megamenu' );



    /**
     * Called after the megamenu has been created.
     * 
     * @event Responsiville.Megamenu#created
     */

    this.fireEvent( 'init' );

};



// Extend with logging functions.

Responsiville.extend( Responsiville.Megamenu, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Megamenu, Responsiville.Events );



/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Megamenu.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;



/**
 * @property {Object} defaults Default values for this module settings. Watch
 *                             out for the WordPress-aware activator option, 
 *                             which takes into account WordPress menus that
 *                             contain submenu. 
 */

Responsiville.Megamenu.defaults = {
    debug        : false,
    activator    : '.responsiville-megamenu',
    element      : '.responsiville-megamenu-element',
    enter        : 'laptop, desktop, large, xlarge',
    leave        : 'small, mobile, tablet',
    effect       : 'slide',
    elementClass : 'responsiville-megamenu-element',
    parentClass  : 'responsiville-megamenu-parent',
    parentActive : 'responsiville-megamenu-active',
    openClass    : 'responsiville-megamenu-open',
    openingClass : 'responsiville-megamenu-opening',
    closingClass : 'responsiville-megamenu-closing',
    delayShow    : 200,
    delayHide    : 200,
    duration     : 500 
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

Responsiville.Megamenu.autoRun = function () {

    jQuery( Responsiville.Megamenu.defaults.activator ).each( function () {

        new Responsiville.Megamenu({
            debug     : Responsiville.Main.getInstance().options.debug,
            activator : this
        });
        
    });

};



/**
 * Sets up event handlers necessary for the object to function properly. 
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.setupEvents = function () {

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




    // Menu activator mouse enter/leave events.

    this.$menuActivator.on( 'mouseenter', this.getBoundFunction( this.activatorMouseEnter ) );
    this.$menuActivator.on( 'mouseleave', this.getBoundFunction( this.activatorMouseLeave ) );

    // Menu container mouse enter/leave events.

    this.$menuElement.on( 'mouseenter', this.getBoundFunction( this.elementMouseEnter ) );
    this.$menuElement.on( 'mouseleave', this.getBoundFunction( this.elementMouseLeave ) );

};



/**
 * Enables the megamenu. It does not activate it, it does not open it. It simply
 * enables it, so when the necessary trigger is fired (ie the activator element 
 * is hovered upon) then the menu is activated (which means it opens). Useful in
 * responsive design where the megamenu might be a required feature in desktops
 * but useless in mobiles.
 * 
 * @fires Responsiville.Megamenu#enabled
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.enable = function () {

    this.log( 'enable megamenu' );



    // Make sure the megamenu is closed.

    this.close();

    // Add necessary classes to megamenu elements.

    this.$menuElement.parent().addClass( Responsiville.Megamenu.defaults.parentClass );
    this.$menuElement.addClass( Responsiville.Megamenu.defaults.elementClass );

    this.enabled = true;



    /**
     * Called after the megamenu has been enabled.
     * 
     * @event Responsiville.Megamenu#enabled
     */

    this.fireEvent( 'enabled' );

};



/**
 * Disables the megamenu. It does not deactivate it, it does not close it. It 
 * simply disables it, so it does not function any more when the necessary
 * trigger is fired. Useful in responsive design where the megamenu might be a 
 * required feature in desktops but useless in mobiles.
 * 
 * @fires Responsiville.Megamenu#disabled
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.disable = function () {

    this.log( 'disable megamenu' );



    // Make sure the megamenu is closed.

    this.close();

    // Remove necessary classes to megamenu elements.

    this.$menuElement.parent().removeClass( Responsiville.Megamenu.defaults.parentClass );
    this.$menuElement.removeClass( Responsiville.Megamenu.defaults.elementClass );

    this.enabled = false;



    /**
     * Called after the megamenu has been disabled.
     * 
     * @event Responsiville.Megamenu#disabled
     */
    
    this.fireEvent( 'disabled' );

};



/**
 * Handles the event of the mouse entering the menu activator element which is
 * meant to open the megamenu.
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.activatorMouseEnter = function () {

    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        
        return;
        
    }

    this.log( 'menu activator mouse enter' );

    this.enteringMenuActivator = true;
    this.leavingMenuActivator  = false;



    // Make sure no other scheduled animations will run.

    window.clearTimeout( this.timeoutHandler );

    // Open the menu after a small delay.

    this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.open ), this.options.delayShow );

};



/**
 * Handles the event of the mouse leaving the menu activator element which is 
 * meant to close the megamenu.
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.activatorMouseLeave = function () {

    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        
        return;
        
    }

    this.log( 'menu activator mouse leave' );

    this.enteringMenuActivator = false;
    this.leavingMenuActivator  = true;

    
    
    // Make sure no other scheduled animations will run.

    window.clearTimeout( this.timeoutHandler );

    // Close the menu after a small delay.

    this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.close ), this.options.delayHide );
    
};



/**
 * Handles the event of the mouse entering the menu element which is meant to
 * ensure that that the megamenu stays open in case the user accidentally took
 * their mouse away from the megamenu for a moment.
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.elementMouseEnter = function () {

    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        
        return;
        
    }

    this.log( 'menu element mouse enter' );

    this.enteringMenuElement = true;
    this.leavingMenuElement  = false;

    // Make sure no other scheduled animations will run.

    window.clearTimeout( this.timeoutHandler );

    // Open the menu after a small delay.

    this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.open ), this.options.delayShow );

};



/**
 * Handles the event of the mouse leaving the menu container which is meant to
 * close the megamenu.
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.elementMouseLeave = function () {

    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        
        return;
        
    }

    this.log( 'menu element mouse leave' );

    this.enteringMenuElement = false;
    this.leavingMenuElement  = true;

    // Make sure no other scheduled animations will run.

    window.clearTimeout( this.timeoutHandler );

    // Close the menu after a small delay.

    this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.close ), this.options.delayHide );

    
};



/**
 * Opens the megamenu. Actually opens and shows the megamenu with the required
 * visual effect.
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.open = function () {

    // Check if a new open action is really necessary.

    var doNotOpen = 
        ( this.leavingMenuActivator && this.enteringMenuElement ) || 
        ( this.leavingMenuElement   && this.enteringMenuActivator );

    //  Reset menu activator behaviour flags.

    this.enteringMenuActivator = false;
    this.leavingMenuActivator  = false;
    this.enteringMenuElement   = false;
    this.leavingMenuElement    = false;
    
    if ( doNotOpen ) {

        return;

    }

    this.log( 'open megamenu' );



    // Stop other pending animations.

    this.$menuElement.velocity( 'stop', true );

    this.beforeOpening();

    // Go on with new open action.

    if ( this.options.effect == 'slide' ) {

        // Menu slide effect.

        this.$menuElement.velocity({
            properties : { height: this.calculateHeight() }, 
            options : { 
                duration: this.options.duration,
                display : '',
                complete: this.getBoundFunction( this.afterOpening )
            }
        });

    } else if ( this.options.effect == 'fade' ) {

        // Menu fade effect.

        this.$menuElement.velocity({ 
            properties : { opacity: 1 }, 
            options : { 
                duration: this.options.duration,
                display : '',
                complete: this.getBoundFunction( this.afterOpening )
            } 
        });

    } else {

        // No menu effects.

    }

};



/**
 * Closes the megamenu. Actually closes and shows the megamenu with the required
 * visual effect.
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.close = function () {

    // Check if a new close action is really necessary.

    var doNotClose = 
        ( this.leavingMenuActivator && this.enteringMenuElement ) || 
        ( this.leavingMenuElement   && this.enteringMenuActivator );

    //  Reset menu element behaviour flags.

    this.enteringMenuActivator = false;
    this.leavingMenuActivator  = false;
    this.enteringMenuElement   = false;
    this.leavingMenuElement    = false;

    if ( doNotClose ) {

        return;

    }

    this.log( 'close megamenu' );



    // Stop other pending animations.

    this.$menuElement.velocity( 'stop', true );

    this.beforeClosing();

    // Go on with new close action.

    if ( this.options.effect == 'slide' ) {

        // Menu slide effect.

        this.$menuElement.velocity({
            properties : { height: 0 }, 
            options    : { 
                duration: this.options.duration, 
                display : '',
                complete: this.getBoundFunction( this.afterClosing )
            } 
        });

    } else if ( this.options.effect == 'fade' ) {

        // Menu fade effect.
        
        this.$menuElement.velocity({
            properties : { opacity: 0 }, 
            options    : { 
                duration: this.options.duration, 
                display : '',
                complete: this.getBoundFunction( this.afterClosing )
            } 
        });

    } else {

        // No menu effects.

        this.afterClosing();

    }

};



/**
 * Runs just before the megamenu begins opening.
 * 
 * @fires Responsiville.Megamenu#menuOpening
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.beforeOpening = function () {

    /**
     * Called before opening the menu.
     * 
     * @event Responsiville.Megamenu#menuOpening
     */
    
    this.fireEvent( 'menuOpening' );



    // In case a previous closing operation was unfinished.
     
    this.$menuElement.removeClass( this.options.closingClass );
    
    // Set the opening menu container CSS class.

    this.$menuElement.addClass( this.options.openingClass );

    // Mark the menu activator as active.
    
    this.$menuActivator.addClass( this.options.parentActive );

};



/**
 * Runs right after the megamenu has opened.
 * 
 * @fires Responsiville.Megamenu#menuOpened
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.afterOpening = function () {

    // Set the open menu container CSS class.

    this.$menuElement.removeClass( this.options.openingClass );
    this.$menuElement.addClass( this.options.openClass );



    /**
     * Called after opening the menu.
     * 
     * @event Responsiville.Megamenu#menuOpened
     */
    
    this.fireEvent( 'menuOpened' );

};



/**
 * Runs right before the megamenu begins to closing.
 * 
 * @fires Responsiville.Megamenu#menuClosing
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.beforeClosing = function () {

    /**
     * Called before closing the menu.
     * 
     * @event Responsiville.Megamenu#menuClosing
     */
    
    this.fireEvent( 'menuClosing' );



    // Set the closing menu container CSS class.

    this.$menuElement.addClass( this.options.closingClass );

};



/**
 * Runs right after the megamenu has been closed.
 * 
 * @fires Responsiville.Megamenu#menuClosed
 * 
 * @return {void}
 */

Responsiville.Megamenu.prototype.afterClosing = function () {

    // Mark the menu activator as no longer active.

    this.$menuActivator.removeClass( this.options.parentActive );

    // In case a previous opening operation was unfinished.

    this.$menuElement.removeClass( this.options.openingClass );

    // Set the closed menu container CSS class to closed.

    this.$menuElement.removeClass( this.options.closingClass );
    this.$menuElement.removeClass( this.options.openClass );

    // Make sure megamenu is restored to its natural dimensions after being disabled. 

    if ( this.responsiville.is( this.options.leave.split( ', ' ) ) ) {

        // Its height has probably been set to zero.

         this.$menuElement.css( 'height', 'auto' );

    }



    /**
     * Called after closing the menu.
     * 
     * @event Responsiville.Megamenu#menuClosed
     */
    
    this.fireEvent( 'menuClosed' );

};



/**
 * Calculates the height of the menu element dynamically at the particular time
 * it is being requested..
 *
 * @return {int} The height of the menu element.
 */

Responsiville.Megamenu.prototype.calculateHeight = function () {

    // Forces the menu to momentarily gain dimensions so that its height may be calculated.

    this.$menuElement.addClass( 'responsiville-megamenu-calculating' );

    var height = 
        this.$menuElement.height() + 
        parseInt( this.$menuElement.css( 'border-top-width' ) ) + 
        parseInt( this.$menuElement.css( 'border-bottom-width' ) ) + 
        parseInt( this.$menuElement.css( 'padding-top' ) ) + 
        parseInt( this.$menuElement.css( 'padding-bottom' ) );

    this.$menuElement.removeClass( 'responsiville-megamenu-calculating' );

    return height;

};