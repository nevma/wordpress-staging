/**
 * Creates and initialises the mobile menu.
 * 
 * @class
 * @extends   Responsiville.Debug
 * @extends   Responsiville.Events
 * 
 * @author    Nevma, info@nevma.gr
 * @license   Nevma Copyright (c) http://www.nevma.gr
 * 
 * @fires     Responsiville.Mobimenu#init
 * 
 * @classdesc A responsive mobile burger menu for the Responsiville framework, 
 *            which has come to be known as a burger menu in responsive web 
 *            design. But this is just a name. The mobile menu may have any 
 *            shape and visual effect the developer decides that it should have.
 *            It is enabled and disabled according to the given breakpoints 
 *            configuration.
 *
 * @param {Object} options The initialisation options of the module.
 * 
 * @property {Object}  options            The options that define the object
 *                                        behaviour.
 * @property {boolean} options.debug      Whether to print debug messages in the 
 *                                        browser console.
 * @property {string}  options.element    The element that contains the whole of
 *                                        the mobimenu.
 * @property {string}  options.enter      Comma separated list of breakpoints in 
 *                                        which the mobimenu enters, wihch means
 *                                        it is enabled.
 * @property {string}  options.leave      Comma separated list of breakpoints in 
 *                                        which the mobimenu leaves, which means 
 *                                        it is disabled.
 * @property {string}  options.menuTitle  The title of the anchor element which
 *                                        will hold the burger menu when it is
 *                                        enabled. 
 * @property {string}  options.menuText   The text of the anchor element which
 *                                        will hold the burger menu when it is
 *                                        enabled. 
 * @property {string}  options.closeText  The text of the anchor element which
 *                                        will hold the burger menu when it is
 *                                        enabled. 
 * @property {string}  options.closeTitle The title of the anchor element which
 *                                        will hold the burger menu when it is
 *                                        enabled. 
 * @property {bool}    options.styled     Controls if extended (more than the
 *                                        absolutely necessary) styling will be
 *                                        applied, for example on <ul> and <li>
 *                                        elements and their contents.
 *                                        Default: true.
 * @property {int}     options.transition The speed of the transitions of the 
 *                                        mobimenu.
 * @property {string}  options.detectHash Detects whether the mobimenu treats 
 *                                        anchor elements inside the menu which
 *                                        start with a "#" in a special way.
 *                                        This means that when they are clicked
 *                                        the mobile menu needs to close because
 *                                        no new page will be loaded.
 */

Responsiville.Mobimenu = function ( options ) {

    // Responsiville must be initialised.

    if ( ! Responsiville.Main.getInstance() ) {

        throw new Error( 'Responsiville instantiation error: the framework has not been initialised, call new Responsiville::Main() and then Responsiville::init().' );

    }



    // General settings setup.
    
    this.options       = {};
    this.options       = jQuery.extend( this.options, Responsiville.Mobimenu.defaults, options );
    this.codeName      = 'responsiville.mobimenu';
    this.responsiville = Responsiville.Main.getInstance();
    this.enabled       = false;

    

    // Cache important DOM elements.

    this.$body = this.responsiville.$body;
    this.$menu = jQuery( this.options.element );



    // Check for developer settings inside main element's data attributes.

    for ( var key in this.options ) {

        var value = this.$menu.data( 'responsiville-mobimenu-' + key.toLowerCase() );

        if ( typeof value !== 'undefined' ) {
            this.options[key] = value;
        }

    }
    
    
    
    // If no menu found raise an error.
    
    if ( this.$menu.length === 0 ) {

        this.log( 'Responsiville.Mobimenu instantiation error: no menus found (' + this.options.element + ').' );
        return;

    }

    // Ensure that the appropriate class is assigned to the menu element (in case the module is called on an arbitrary element)
    this.$menu.addClass( 'responsiville-mobimenu' );

    // Wrap the original menu in a container wrapper.
    
    this.$wrapper = this.$menu.wrap( '<div class = "responsiville-mobimenu-wrapper" />' ).parent();

    // Clone the wrapper so that it's the clone that actually opens and closes.
    
    this.$wrapperCloned = this.$wrapper.clone( false ).addClass( 'responsiville-mobimenu-wrapper-clone' ).appendTo( this.$body );

    if ( ! this.options.styled ) {

    	this.$wrapperCloned.addClass( 'responsiville-mobimenu-unstyled' );

    }



    // Remove possible scrollmenu selector from cloned menu so as no cloned scrollmenu is triggered.

    if ( typeof Responsiville.Scrollmenu !== 'undefined' ) {

        var scrollMenuSelectorClass = Responsiville.Scrollmenu.defaults.element.replace( '.', '' );
        this.$wrapperCloned.find( '.' + scrollMenuSelectorClass ).removeClass( scrollMenuSelectorClass );

    }

    

    // Add the burger menu next to the original menu.
    
    this.$menu.before( 
       '<button class = "responsiville-mobimenu-burger" title = "' + this.options.menuTitle + '">' + 
           '<span>' + this.options.menuText + '</span>' + 
       '</button>'
    );

    // Add the close button the cloned wrapper.

    this.$wrapperCloned.prepend( 
        '<button class = "responsiville-mobimenu-close" title = "' + this.options.closeTitle + '">' + 
            '<span>' + this.options.closeText + '</span>' + 
        '</button>' 
    );



    // Initialises the mobimenu.
    
    this.setupEvents();

    this.log( 'creating mobimenu' );



    /**
     * Called after the mobimenu has been created.
     * 
     * @event Responsiville.Mobimenu#init
     */

    this.fireEvent( 'init' );

};



// Extend with logging functions.

Responsiville.extend( Responsiville.Mobimenu, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Mobimenu, Responsiville.Events );




/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Mobimenu.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;



/**
 * @property {Object} defaults Default values for this module settings.
 */

Responsiville.Mobimenu.defaults = {
    debug      : false,
    element    : '.responsiville-mobimenu',
    enter      : 'small, mobile, tablet',
    leave      : 'laptop, desktop, large, xlarge',
    menuTitle  : 'Menu',
    menuText   : 'Menu',
    closeTitle : 'Close',
    closeText  : '&times;',
    styled     : true,
    transition : 500,
    detectHash : true
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

Responsiville.Mobimenu.autoRun = function () {

    jQuery( Responsiville.Mobimenu.defaults.element ).each( function () {

        new Responsiville.Mobimenu({
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

Responsiville.Mobimenu.prototype.setupEvents = function () {

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



    // Burger icon button open menu handler.

    this.$menu.parent().find( '.responsiville-mobimenu-burger' ).on( 'click', this.getBoundFunction( this.openButtonClick ) );
    
    // Menu close button handler.

    this.$wrapperCloned.find( '.responsiville-mobimenu-close' ).on( 'click', this.getBoundFunction( this.closeButtonClick ) );

    // Escape key close menu handler.

    this.$body.on( 'keyup', this.getBoundFunction( this.escapeKeyUp ) );

    // Clicking anywhere, not on a link, closes the menu.

    this.$wrapperCloned.on( 'click', this.getBoundFunction( this.menuContainerClick ) );



    // Clicking on anchor elements with a "#" closes the menu to allow for in-page navigation.

    if ( this.options.detectHash ) {
        this.$wrapperCloned.find( 'a[href^="#"]' ).on( 'click', this.getBoundFunction( this.anchorHashClick ) ); 
    }

};



/**
 * Enables the mobimenu. It does not activate it, it does not open it. It simply
 * enables it, so when the necessary trigger is fired (ie the burger menu is 
 * tapped) then the menu is activated (which means it opens). Useful in 
 * responsive design where the mobimenu might be a required feature in desktops 
 * but useless in mobile devices.
 * 
 * @return {void}
 */

Responsiville.Mobimenu.prototype.enable = function () {

    if ( this.enabled ) {
        return;
    }



    this.log( 'enable mobimenu' );



    this.enabled = true;

    this.$wrapper.addClass( 'responsiville-mobimenu-enabled' );
    this.$wrapperCloned.addClass( 'responsiville-mobimenu-enabled' );

};



/**
 * Disables the mobimenu. It does not deactivate it, it does not close it. It 
 * simply disables it, so it does not function any more when the necessary
 * trigger is fired. Useful in responsive design where the mobimenu might be a 
 * required feature in desktops but useless in mobile devices.
 * 
 * @return {void}
 */

Responsiville.Mobimenu.prototype.disable = function () {

    if ( ! this.enabled ) {
        return;
    }



    this.log( 'disable mobimenu' );



    this.enabled = false;

    this.close();

    this.$wrapper.removeClass( 'responsiville-mobimenu-enabled' );
    this.$wrapperCloned.removeClass( 'responsiville-mobimenu-enabled' );

    return false;

};



/**
 * Opens the mobimenu. Actually opens and shows the mobimenu with the required 
 * visual effect.
 * 
 * @return {void}
 */

Responsiville.Mobimenu.prototype.open = function () {

    this.log( 'open mobimenu' );

    this.$body.addClass( 'responsiville-mobimenu-open-body' );
    this.$wrapperCloned.addClass( 'responsiville-mobimenu-open' );

    this.$wrapperCloned.
        css({
            top  : 0,
            left : '-100%'
        }).
        velocity({
            properties : { 
                left : 0
            },
            options : { 
                duration : this.options.transition
            }
         });

};



/**
 * Closes the mobimenu. Actually closes and shows the mobimenu with the required
 * visual effect.
 *
 * @param {Event} event The event that fired on the element which closes the 
 *                      mobimenu.
 * 
 * @return {void}
 */

Responsiville.Mobimenu.prototype.close = function ( event ) {

    this.log( 'close mobimenu' );

    this.$wrapperCloned.velocity({
        properties : { 
            top  : 0,
            left : '-100%'
        },
        options : { 
            duration : this.options.transition, 
            complete : (function () { 

                this.$wrapperCloned.removeClass( 'responsiville-mobimenu-open' );
                this.$body.removeClass( 'responsiville-mobimenu-open-body' );

            }).bind( this )
        }
     });

};



/**
 * Handles the click event on the mobimenu open butoon. The menu opens and the
 * handler always returns true.
 * 
 * @return {boolean} Whether the event should propagate and allow default
 *                   behaviour. 
 */

Responsiville.Mobimenu.prototype.openButtonClick = function ( event ) {

    this.open();
    return false;
    
};



/**
 * Handles the click event on an anchor element inside the mobimenu which has an
 * internal link, ie starts with a "#". The menu is closed and the handler
 * always returns true.
 * 
 * @return {boolean} Whether the event should propagate and allow default
 *                   behaviour.
 */

Responsiville.Mobimenu.prototype.anchorHashClick = function () {

    this.close();
    
};



/**
 * Handles the click event on the mobimenu close button. The menu is closed and
 * the handler always returns false to stop default behaviour.
 * 
 * @return {boolean} Whether the event should propagate and allow default
 *                   behaviour. 
 */

Responsiville.Mobimenu.prototype.closeButtonClick = function (  ) {

    this.close();
    return false;
    
};



/**
 * Handles the click event on the mobimenu container body. The menu is closed
 * and the handler always returns false to stop default behaviour.
 * 
 * @param {Event} event The mouse click event that fired.
 * 
 * @return {boolean} Whether the event should propagate and allow default
 *                   behaviour.
 */

Responsiville.Mobimenu.prototype.menuContainerClick = function ( event ) {

    // If the event was propagated from a clicked link stop and let the link do what it was programmed to do.

    if ( event && event.target.nodeName.toLowerCase() == 'a' ) {
        return true;
    }

    // Otherwise close the mobimenu.

    this.close();
    return false;
    
};



/**
 * Handles the escape key up event to close the mobimenu via the keyboard
 * when it is open. One could argue thath it is pointless in mobile devices, but
 * burger menus have been used in desktop devices often as well.
 * 
 * @param {Event} event The event that fired on the keyboard.
 *                      
 * @return {boolean} Whether the event should propagate and allow default
 *                   behaviour.
 */

Responsiville.Mobimenu.prototype.escapeKeyUp = function ( event ) {

    // Check if escape key has been pressed.

    var ESCAPE_KEY = 27;

    if ( event && event.keyCode == ESCAPE_KEY ) {

        this.close();
        return false;

    }

    return true;

};