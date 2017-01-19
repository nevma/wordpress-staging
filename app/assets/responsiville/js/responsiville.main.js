/**
 * Creates and initialises the main Responsiville object. 
 * 
 * @class
 * @extends   Responsiville.Debug
 * @extends   Responsiville.Events
 * 
 * @author    Nevma, info@nevma.gr
 * @license   Nevma Copyright (c) http://www.nevma.gr
 * 
 * @fires     Responsiville.Main#init
 * 
 * @classdesc This is the main object of the Responsiville framework. The whole 
 *            Responsiville framework depends on this object to function and so
 *            do all the plugins that belong to the framework as well. It 
 *            contains core functions that handle the breakpoints and the 
 *            responsiveness of the web page in development.
 *
 * @param {Object} options The initialisation options of the module.
 *
 * @property {Object}  options             The options that define the object
 *                                         behaviour.
 * @property {boolean} options.debug       Whether to print debug messages in 
 *                                         the browser console.
 * @property {boolean} options.debugUI     Whether to show the debug panel at 
 *                                         the edge of the screen.
 * @property {string}  options.debugPos    Where to position the debug panel (br
 *                                         means bottom-right, tl means top-left
 *                                         and so on).
 * @property {int}     options.throttle    Time delay to throttle expensive 
 *                                         function calls as a result of 
 *                                         repeated operations like the browser 
 *                                         resize event.
 * @property {Array}   options.breakpoints Array of extra breakpoints to include
 *                                         to the framework. Each breakpoint is 
 *                                         an associative array like { name: 
 *                                         'small', width: 320, icon: 'uE800' }.
 *                                         One might need to add breakpoints to 
 *                                         this array but they probably should
 *                                         not remove any beacuse this might
 *                                         break behaviour of other code that
 *                                         depends on them.
 */

Responsiville.Main = function ( options ) {

    // Responsiville is a singleton.

    if ( ! Responsiville.Main.instance ) {

        Responsiville.Main.instance = this;
        
    } else {

        throw new Error( 'Responsiville instantiation error: the framework has already been initialised, new Responsiville.Main is a singleton.' );

    }



    // General settings setup.
    
    this.options  = {};
    this.options  = jQuery.extend( this.options, Responsiville.Main.defaults, options );
    this.codeName = 'responsiville.main';



    // Cache important DOM elements (note that it might be too early for the body here).

    this.$window = jQuery( window );
    this.$html   = jQuery( 'html' );

    

    // Flag which checks whether the resize callbacks have been called. 
    
    this.adjustCallbacksCalled = false;

    // The previous and current breakpoint of the page.
    
    this.previousBreakpoint = null;
    this.currentBreakpoint  = null;

    

    // Log some crap.
    
    var toLog = 
        '\n' +
        '    ____                                   _       _ ____\n' +
        '   / __ \\___  _________  ____  ____  _____(_)   __(_) / /__\n' +
        '  / /_/ / _ \\/ ___/ __ \\/ __ \\/ __ \\/ ___/ / | / / / / / _ \\\n' +
        ' / _, _/  __(__  ) /_/ / /_/ / / / (__  ) /| |/ / / / /  __/\n' +
        '/_/ |_|\\___/____/ .___/\\____/_/ /_/____/_/ |___/_/_/_/\\___/\n' +
        '               /_/\n' +
        '                                               version ' + Responsiville.VERSION + '\n\n';

    toLog += 'breakpoints:\n';

    for ( var k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        var breakpoint = this.options.breakpoints[k];
        toLog += breakpoint.name + '\t' + breakpoint.width + 'px' + ( k < length-1 ? '\n' : '' );

    }

    this.log( toLog );


    
    this.$debugControls    = null;
    this.$debugPerformance = null;
    this.$debugToggle      = null;



    // Adjust to the current viewport and device characteristics for the first time.

    this.adjust();

};



// Extend with logging functions.

Responsiville.extend( Responsiville.Main, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Main, Responsiville.Events );



/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Main.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;



/**
 * @property {Object} defaults Default values for this module settings.
 */

Responsiville.Main.defaults = {
    debug       : false,
    debugUI     : false,
    debugPos    : 'br',
    throttle    : 250,
    breakpoints : [
        { name: 'small',   width:   320, icon: '\uE800' }, // Screens    0 -  320
        { name: 'mobile',  width:   599, icon: '\uE801' }, // Screens  321 -  599
        { name: 'tablet',  width:  1023, icon: '\uE802' }, // Screens  600 - 1023
        { name: 'laptop',  width:  1279, icon: '\uE803' }, // Screens 1024 - 1279
        { name: 'desktop', width:  1439, icon: '\uE804' }, // Screens 1280 - 1439
        { name: 'large',   width:  1679, icon: '\uE804' }, // Screens 1440 - 1679
        { name: 'xlarge',  width: 99999, icon: '\uE804' }  // Screens 1601 - infinity
    ]
};



/**
 * Automatically initialises the Responsiville framework. It is dependendent on
 * the fact that the jQuery and the main Responsiville scripts (not the modules)
 * have loaded. It is activated via the global RESPONSIVILLE_AUTO_INIT and it 
 * uses the global RESPONSIVILLE_DEBUG.
 *
 * @function
 * @static
 * 
 * @return {void}
 */

Responsiville.Main.autoRun = function () {

    // Create, but not yet initialise the Responsiville framework main singleton instance.

    var responsiville = new Responsiville.Main({
        debug   : RESPONSIVILLE_DEBUG,
        debugUI : RESPONSIVILLE_DEBUG
    });



    // On DOMContentLoaded fully initialise the instance.

    jQuery( (function () {

        this.init();

    }).bind( responsiville ) );

};



/**
 * Get the singleton responsiville instance. Oh, did we mention? Responsiville
 * is a singleton, because in a browser you only get one responsive web page at
 * a time.
 * 
 * @function
 * @static
 *
 * @return {Responsiville.Main} The singleton Responsiville object instance
 *                              which is responsible for the current page.
 */

Responsiville.Main.getInstance = function () {

    return Responsiville.Main.instance;

};



/**
 * Initilalises the responsive magic. Sets up the necessary event handlers on 
 * browser window resize that assist in controlling the desired responsive
 * behaviour. Runs exactly once.
 * 
 * @return {void}
 */

Responsiville.Main.prototype.init = function () {

    // In the case the framework was initialised automatically in the HEAD before the BODY was created.

    var bodyElementNotCreated = typeof this.$body === 'undefined' || this.$body.length === 0;

    if ( bodyElementNotCreated ) {
        this.$body = jQuery( 'body' );
    }



    // Setup the debugging tools of the framework.

    Responsiville.Debug.setupDebug();



    // General debounced resize handler so that the rest of the code hooks to it instead of directly on window resize.

    this.$window.on( 'resize', Responsiville.debounce( this.windowResize, this.options.throttle, this ) );




    // Run responsive adjustments once immediately.

    this.adjust();

    

    /**
     * Called after the module has been initialised.
     * 
     * @event Responsiville.Main#init
     */

    this.fireEvent( 'init' );



    // A de facto breakpoint has occured after init, so run the breakpoint change callbacks.

    this.runBreakpointChangeCallbacks();



    this.log( 'framework Responsiville has initialised' );

};



/**
 * Registers a new, non-default, breakpoint in the system.
 *
 * @param {string} breakpointName  The code name of the new breakpoint.
 * @param {int}    breakpointWidth The window width of the new breakpoint.
 * 
 * @return {void}
 */

Responsiville.Main.prototype.registerBreakpoint = function ( breakpointName, breakpointWidth ) {

    var index = 0;

    for ( var k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        // Breakpoints have to be sorted by ascending screen width.

        var breakpoint = this.options.breakpoints[k];

        if ( breakpointWidth < breakpoint.width ) {
            
            index = k;
            break;

        }

    }

    this.options.breakpoints.splice( k, 0, { name: breakpointName, width: breakpointWidth } );

    this.dir( 'breakpoint registered:', { name: breakpointName, width: breakpointWidth }, 'breakpoints:', this.options.breakpoints );

};



/**
 * Deregisters an existing breakpoint.
 *
 * @param {string} breakpointName The code name of the breakpoint to deregister.
 * 
 * @return {void}
 */

Responsiville.Main.prototype.deregisterBreakpoint = function ( breakpointName ) {

    for ( var k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        var breakpoint = this.options.breakpoints[k];

        if ( breakpointName == breakpoint.name ) {
            
            this.options.breakpoints.splice( k+1, 1 );
            break;

        }

    }

    this.dir( 'breakpoint deregistered: ' + breakpointName, 'new breakpoints: ', this.options.breakpoints );

};



/**
 * Window resize event handler which takes care of manipulating the breakpoints, 
 * setting and unsetting them accordingly.
 * 
 * @return {void}
 */

Responsiville.Main.prototype.adjust = function () {

    this.log( 'adjusting to viewport' );



    // Calculate the classes to remove from the HTML element based on the current breakpoint.

    var removeClasses = '';

    var k;
    var breakpoint;

    for ( k = this.options.breakpoints.length - 1; k >= 0; k-- ) {

        breakpoint = this.options.breakpoints[k];
        removeClasses += breakpoint.name + ' ';

    }



    // Calculate the classes to add to the HTML element based on the current breakpoint.

    var addClasses = '';

    for ( k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        breakpoint = this.options.breakpoints[k];

        if ( window.innerWidth > breakpoint.width ) {
            addClasses += breakpoint.name + ' ';
        } else {
            break;
        }

    }

    if ( window.innerWidth <= breakpoint.width ) {
        addClasses += breakpoint.name + ' ';
    }



    // Add a class that indicates whether we are on a touch device or not.
    
    if ( this.isDevice() ) {
        addClasses += 'device ';
    } else {
        removeClasses += 'device ';
    }



    // Adds a class that indicates the current browser orientation.
    
    if ( window.innerWidth >= window.innerHeight ) {
        addClasses    += 'landscape ';
        removeClasses += 'portrait ';
    } else {
        addClasses    += 'portrait ';
        removeClasses += 'landscape ';
    }



    // Adds a class that indicates whether the current device is a PC or phone/tablet.
    
    if ( this.isDevice() ) {
        addClasses    += 'device ';
        removeClasses += 'pc ';
    } else {
        addClasses    += 'pc ';
        removeClasses += 'device ';
    }

    this.$html.removeClass( removeClasses );
    this.$html.addClass( addClasses );



    // Sets up current breakpoint the first time the framework runs.
    
    var firstRun = false;

    if ( ! this.currentBreakpoint ) {

        firstRun = true;
        this.currentBreakpoint = this.calculateCurrentBreakpoint();

    }



    // Checks if and what kind of breakpoint change has occured.

    var newBreakpoint = this.calculateCurrentBreakpoint();
    var oldBreakpoint = this.currentBreakpoint;

    var breakpointChanged = 
        firstRun ||
        oldBreakpoint.name != newBreakpoint.name || 
        ! this.adjustCallbacksCalled;

    if ( breakpointChanged ) {

        this.previousBreakpoint = this.currentBreakpoint;
        this.currentBreakpoint = newBreakpoint;

    }



    // Calls event handlers that run on breakpoint changes.

    if ( breakpointChanged ) {
        
        // Run the breakpoint change callbacks.
        
        this.runBreakpointChangeCallbacks();


        
        /**
         * Called after a breakpoint change has occured.
         * 
         * @event Responsiville.Main#change
         */

        this.fireEvent( 'change' );
        
        this.adjustCallbacksCalled = true;

    }



    this.log( 
        'window resized', 'window width: ' + window.innerWidth, 
        ( breakpointChanged ? 'breakpoint changed from: ' + this.previousBreakpoint.name + '' : 'no breakpoint change' ),
        'current breakpoint: ' + this.currentBreakpoint.name
    );

};



/**
 * Runs all callbacks registered on breakpoint change events (either entering or
 * leaving a breakpoint).
 * 
 * @return {void}
 */

Responsiville.Main.prototype.runBreakpointChangeCallbacks = function () {

    // Run all callbacks set on leaving the previous breakpoint.

    this.fireEvent( 'leave.' + this.previousBreakpoint.name );

    // Run all callbacks set on entering the current breakpoint.
    
    this.fireEvent( 'enter.' + this.currentBreakpoint.name );

};



/**
 * Runs all the function callbacks which are attached to the Responsiville Main
 * object's resize event. The call to this function has been registered as
 * throttled to begin with, so that the browser is protected from repeated calls
 * of the same callbacks.
 *
 * @fires Responsiville.Main#resize
 * 
 * @return void
 */

Responsiville.Main.prototype.windowResize = function () {

    this.adjust();

    /**
     * Called after a breakpoint change has occured.
     * 
     * @event Responsiville.Main#resize
     */
    
    this.fireEvent( 'resize' );

};



/**
 * Checks whether the current screen has a high devide pixel ratio, that is 
 * greater than 1 (HiDPI, retina, etc).
 *
 * @return {boolean} Whether the current screen has a high device pixel ratio.
 */

Responsiville.Main.prototype.isHiDPI = function () {

    if ( window.devicePixelRatio > 1 ) {
    
        return true;

    }

    // High resolution screen check regular expression.

    var mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';

    if ( window.matchMedia && window.matchMedia( mediaQuery ).matches ) {

        return true;

    }

    return false;

};



/**
 * Checks whether the current device is a mobile and not a desktop one based on
 * the user agent of the browser.
 * 
 * @return {boolean} Whether the current device is a mobile one.
 */

Responsiville.Main.prototype.isDevice = function () {

    var deviceAgentQuery = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i;

    return deviceAgentQuery.test( navigator.userAgent );

};



/**
 * Checks whether the current browser window size is currently at the given 
 * breakpoint(s). Useful in order to check if we are inside the range of a 
 * specific breakpoint.
 *
 * @param {Array<string>|string} breakpointNames The breakpoint name(s) against
 *                                               which to check. Can be just a
 *                                               single breakpoint name or a 
 *                                               comma separated list of 
 *                                               breakpoint names or an array of
 *                                               breakpoint names.
 * 
 * @return {boolean} Whether the browser window is at the given breakpoint(s).
 */

Responsiville.Main.prototype.is = function ( breakpointNames ) {

    var k;
    var testBreakpointName;
    var breakpointNamesArray = Responsiville.splitAndTrim( breakpointNames );

    for ( k in breakpointNamesArray ) {

        testBreakpointName = breakpointNamesArray[k];

        if ( this.currentBreakpoint && this.currentBreakpoint.name == testBreakpointName ) {
            return true;
        }
        
    }

    return false;

};



/**
 * Checks whether the current window is at a size smaller than the given 
 * breakpoint. Remember that we are checking mobile first.
 * 
 * @param {string} testBreakpointName The breakpoint name against which to 
 *                                    check. 
 * 
 * @return {boolean} Whether the browser window is at a smaller breakpoint.
 */

Responsiville.Main.prototype.isSmallerThan = function ( testBreakpointName ) {

    for ( var k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        var breakpoint = this.options.breakpoints[k];

        if ( breakpoint.name == testBreakpointName ) {
            return window.innerWidth < breakpoint.width;
        }

    }

};



/**
 * Checks whether the current window is at a size equal or smaller than the 
 * given breakpoint.
 *
 * @param {string} testBreakpointName The breakpoint name against which to 
 *                                    check. 
 * 
 * @return {boolean} Whether the browser window is at an equal or smaller 
 *                   breakpoint.
 */

Responsiville.Main.prototype.isEqualOrSmallerThan = function ( testBreakpointName ) {

    return this.is( testBreakpointName ) || this.isSmallerThan( testBreakpointName );

};



/**
 * Checks whether the current window is at a size bigger than the given 
 * breakpoint.
 * 
 * @param {string} testBreakpointName The breakpoint name against which to 
 *                                    check. 
 *                                    
 * @return {boolean} Whether the browser window is at bigger breakpoint. 
 */

Responsiville.Main.prototype.isBiggerThan = function ( testBreakpointName ) {

    for ( var k = this.options.breakpoints.length-1; k >= 0; k-- ) {

        var breakpoint = this.options.breakpoints[k];

        if ( breakpoint.name == testBreakpointName ) {
            return window.innerWidth > breakpoint.width;
        }

    }

};



/**
 * Checks whether the current window is at a size equal or bigger than the given
 * breakpoint.
 *
 * @param {string} testBreakpointName The breakpoint name against which to 
 *                                    check. 
 *                                    
 * @return {boolean} Whether the browser window is at an equal or bigger
 *                   breakpoint. 
 */

Responsiville.Main.prototype.isEqualOrBiggerThan = function ( testBreakpointName ) {

    return this.is( testBreakpointName ) || this.isBiggerThan( testBreakpointName );

};



/**
 * Checks whether the last breakpoint change was towards a bigger screen.
 * 
 * @return {boolean} Whether the last breakpoint change was towards a bigger 
 *                   screen.
 */

Responsiville.Main.prototype.hasGrown = function () {

    if ( this.currentBreakpoint.name == this.previousBreakpoint.name ) {
        return false;
    }



    // Calculate the current and previous breakpoint widths.

    var currentBreakpointWidth  = 0;
    var previousBreakpointWidth = 0;

    for ( var k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        var breakpoint = this.options.breakpoints[k];

        if ( this.currentBreakpoint.name == breakpoint.name ) {
            currentBreakpointWidth = breakpoint.width;
        } else if ( this.previousBreakpoint.name == breakpoint.name ) {
            previousBreakpointWidth = breakpoint.width;
        }

    }



    // In case of the first load of the page.

    if ( previousBreakpointWidth === 0 ) {
        return true;
    }


    // All other usual cases. 

    return currentBreakpointWidth > previousBreakpointWidth;

};



/**
 * Calculate the current breakpoint according to the current browser window 
 * size.
 *
 * @return {Object} The current breakpoint.
 */

Responsiville.Main.prototype.calculateCurrentBreakpoint = function () {

    var tempBreakpoint;

    for ( var k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        var breakpoint = this.options.breakpoints[k];
        
        // The current breakpoint is the one closest but bigger than the window width.

        if ( window.innerWidth <= breakpoint.width ) {

            tempBreakpoint = breakpoint;
            break;

        }

    }

    return tempBreakpoint;

};



/**
 * Gets a property from the browser local storage.
 *
 * @param {string} name The key name of the property to retrieve from the
 *                      browser local storage.
 *
 * @return {Object} The value that corresponds to the given property from the
 *                  browser local storage.
 */

Responsiville.Main.prototype.getProperty = function ( name ) {

    var localStorage = window.localStorage;

    var settings = localStorage.getItem( this.codeName );

    if ( settings ) {

        settings = JSON.parse( settings );
        return settings[name];

    }

};



/**
 * Sets a property in the browser local storage.
 *
 * @param {string} name  The key name of the property to set in the browser 
 *                       local storage.
 * @param {Object} value The value that is to be set for the given property code
 *                       name in the browser local storage.
 *                       
 * @return {void}
 */

Responsiville.Main.prototype.setProperty = function ( name, value ) {

    var localStorage = window.localStorage;

    var settings = localStorage.getItem( this.codeName );

    
    
    // Makes sure the settings object is created.

    if ( ! settings ) {
        settings = {};
    } else {
        settings = JSON.parse( settings );
    }

    settings[name] = value;



    // Stores one big settings object in local storage.

    localStorage.setItem( this.codeName, JSON.stringify( settings ) );

};



/**
 * Prints the current registered breakpoints in the browser console.
 *                       
 * @return {void}
 */

Responsiville.Main.prototype.printBreakpoints = function () {

    var debug = this.options.debug;

    this.options.debug = true;

    var toLog = [ 'Breakpoints' ];

    for ( var k = 0, length = this.options.breakpoints.length; k < length; k++ ) {

        var breakpoint = this.options.breakpoints[k];
        toLog.push( breakpoint.name + ' - ' + breakpoint.width );
        
    }

    this.log.apply( this, toLog );

    this.options.debug = debug;

};