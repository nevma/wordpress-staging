/**
 * Creates and initialises the slideshow. 
 * 
 * @class
 * @extends   Responsiville.Debug
 * @extends   Responsiville.Events
 * 
 * @author    Nevma, info@nevma.gr
 * @license   Nevma Copyright (c) http://www.nevma.gr
 * 
 * @fires     Responsiville.Slideshow#init
 * 
 * @classdesc A responsive slideshow for the Responsiville framework. A 
 *            slideshow consists of a container for elements that iterate, ie 
 *            the slides, the slies themselves and some elements for controlling
 *            its behaviour, moving it back and forth and to next and previous 
 *            slide. It works with the Responsiville framework. It hides when
 *            necessary, re-appears when there is enough space, according to the
 *            given breakpoints configuration. People have been known to use it
 *            even for creating other functionalities, like tabs, etc.
 *
 * @param {Object} options The initialisation options of the module.
 * 
 * @property {Object}   options              The options that define the object
 *                                           behaviour.
 * @property {boolean}  options.debug        Whether to print debug messages in 
 *                                           the browser console.
 * @property {string}   options.enter        Comma separated list of breakpoints 
 *                                           in which the mobimenu enters, wihch 
 *                                           means it is enabled.
 * @property {string}   options.leave        Comma separated list of breakpoints
 *                                           in which the mobimenu leaves, which 
 *                                           means it is disabled.
 * @property {string}   options.container    The slideshow container element 
 *                                           selector.
 * @property {string}   options.slides       The slideshow slides elements 
 *                                           selector. If null given then the
 *                                           container's direct children are
 *                                           taken into account.
 * @property {string}   options.navigation   The slideshow navigation element,
 *                                           the one that holds the slide
 *                                           bullets and  the next and previous
 *                                           buttons. If null given then the
 *                                           module searches for a nav element
 *                                           inside the container.
 * @property {string}   options.bullets      The selector of the element that
 *                                           holds the slideshow navigation
 *                                           bullets.
 * @property {string}   options.bullet       The selector of the actual
 *                                           slideshow bullets.
 * @property {string}   options.next         The next slide button element 
 *                                           selector.
 * @property {string}   options.previous     The previous slide button element 
 *                                           selector.
 * @property {string}   options.loading      Class added to a the container
 *                                           before the first slide loads, while
 *                                           the user is under the impression
 *                                           that the slideshow itself is
 *                                           loading.
 * @property {string}   options.loaded       Class added to a the container
 *                                           after the first slide has loaded.
 *                                           "First" means the first selected
 *                                           slide, not the first in the row.
 * @property {string}   options.selecting    Class added to slides while 
 *                                           transitioning from non selectred to
 *                                           selected.
 * @property {string}   options.selected     Class added to a slide when it is
 *                                           selected. Only one slide can be
 *                                           selected.
 * @property {string}   options.bulletsPos   The position of the navigation 
 *                                           bullets, eg "bc" stands for "bottom
 *                                           center", etc.
 * @property {string}   options.bulletOn     The class of the selected bullet at 
 *                                           each time.
 * @property {string}   options.nextText     The text inside the slideshow next
 *                                           button.
 * @property {string}   options.previousText The text inside the slideshow
 *                                           previous button.
 * @property {string}   options.bulletText   The text inside the slideshow
 *                                           bullets.
 * @property {string}   options.resizeMode   How to resize the container, "none" 
 *                                           means do not resize it at all, 
 *                                           "slide" means give it the height of 
 *                                           the current slide, "maxSlide" means 
 *                                           resize it in the beginning to the 
 *                                           height of the biggest slide.
 * @property {int}      options.first        Slide to start from, counting from 
 *                                           zero.
 * @property {int}      options.direction    Whether the slide advances forwards 
 *                                           (a positive value) or goes
 *                                           backwards (a negative value).
 * @property {boolean}  options.start        Whether to start the automatic 
 *                                           slide iteration in the beginning.
 * @property {string}   options.effect       The visual effect to use when 
 *                                           transitioning from one slide to the 
 *                                           next, "none" means no effect simply 
 *                                           appear and disappear, "fade" means
 *                                           a fading effect, "slide" means a 
 *                                           sliding effect.
 * @property {int}      options.speed        The speed of the slideshow or how 
 *                                           much the each slide stays visible 
 *                                           before transitioning to the next.
 * @property {int}      options.transition   The speed of each slide transition 
 *                                           visual effect.
 * @property {boolean}  options.hover        Whether to pause the slideshow when 
 *                                           the user hovers their mouse over
 *                                           it.
 * @property {boolean}  options.wait         Whether to wait for the images of
 *                                           the first selected slide to fully
 *                                           load before beginning the
 *                                           slideshow. Useful to provide a
 *                                           loading indicator to the user while
 *                                           they wait.
 */

Responsiville.Slideshow = function ( options ) {

    // Responsiville must be initiliased.

    if ( ! Responsiville.Main.getInstance() ) {

        throw new Error( 'Responsiville instantiation error: the framework has not been initialised, call new Responsiville::Main() and then Responsiville::init().' );

    }



    // General settings setup.

    this.options = jQuery.extend( this.options, Responsiville.Slideshow.defaults, options );

    this.codeName = 'responsiville.slideshow';
    
    this.responsiville = Responsiville.Main.getInstance();



    // Cache main DOM element.
    
    this.$container = jQuery( this.options.container );
    
    

    // Check for developer settings inside main element's data attributes.

    for ( var key in this.options ) {

        var value = this.$container.data( 'responsiville-slideshow-' + key.toLowerCase() );

        if ( typeof value !== 'undefined' ) {
            this.options[key] = value;
        }

    }


    
    // Cache other important DOM elements.
    
    this.$slides = this.$container.find( this.options.slides );


    
    // Slideshow coordination variables and flags.
    
    this.index          = null;
    this.paused         = null;
    this.enabled        = null;
    this.timeoutHandler = null;
    this.firstRun       = true;


    
    // If no slides found then take the container's direct children.
    
    if ( this.$slides.length === 0 ) {
        this.$slides = this.$container.children().not( this.$navigation );
    }



    // If no slides found raise an error.
    
    if ( this.$slides.length === 0 ) {

        this.log( 'Responsiville.Slideshow instantiation error: no slides found (' + this.options.slides + ').' );
        return;

    }



    // Setup slideshow navigation elements.
    
    this.$container.append(
        '<nav class = "responsiville-slideshow-navigation">' +
            '<button class = "responsiville-slideshow-next">' +
                '<span class = "responsiville-slideshow-next-icon"></span>' +
                '<span class = "responsiville-slideshow-next-text">' + this.options.nextText + '</span>' +
            '</button>' +
            '<button class = "responsiville-slideshow-previous">' +
                '<span class = "responsiville-slideshow-previous-icon"></span>' +
                '<span class = "responsiville-slideshow-previous-text">' + this.options.previousText + '</span>' +
            '</button>' +
        '</nav>'
    );



    // Setup slideshow bullet elements.
    
    var bulletsHTML = '';

    for ( var k=0, length = this.$slides.length; k<length; k++ ) {
        bulletsHTML +=
            '<button class = "responsiville-slideshow-bullet">' +
                '<span class = "responsiville-slideshow-bullet-icon"></span>' +
                '<span class = "responsiville-slideshow-bullet-text">' + this.options.bulletText + '</span>' +
                '<span class = "responsiville-slideshow-bullet-number">' + (k+1) + '</span>' +
            '</button>';
    }
    
    this.$container.append(
        '<nav class = "responsiville-slideshow-bullets ' + this.options.bulletsPos + '">' +
            bulletsHTML + 
        '</nav>'
    );



    // Cache DOM elements for slideshow navigation.
    
    this.$navigation = this.$container.find( this.options.navigation );
    this.$bullets    = this.$container.find( this.options.bullet );
    this.$next       = this.$container.find( this.options.next );
    this.$previous   = this.$container.find( this.options.previous );


    
    // Initialise and start the slideshow.
    
    this.$container.addClass( 'responsiville-slideshow' );
    this.setupEvents();

    this.log( 'slideshow initialised' );



    /**
     * Called after the module has been initialised.
     * 
     * @event Responsiville.Slideshow#init
     */

    this.fireEvent( 'init' );

};



// Extend with logging functions.

Responsiville.extend( Responsiville.Slideshow, Responsiville.Debug.Extensions );

// Extend with event handling mechanism.

Responsiville.extend( Responsiville.Slideshow, Responsiville.Events );



/**
 * @property {boolean} AUTO_RUN Controls whether this module should run by 
 *                              default, without the developer calling it, using
 *                              its default settings. Defaults to true.
 */

Responsiville.Slideshow.AUTO_RUN = typeof RESPONSIVILLE_AUTO_INIT !== 'undefined' ? RESPONSIVILLE_AUTO_INIT : true;



/**
 * @property {Object} defaults Default values for this module settings.
 */

Responsiville.Slideshow.defaults = {
    debug        : false,
    enter        : 'laptop, desktop, large, xlarge',
    leave        : 'tablet, mobile, small',
    container    : '.responsiville-slideshow',
    slides       : '.responsiville-slideshow-slide',
    navigation   : '.responsiville-slideshow-navigation',
    bullets      : '.responsiville-slideshow-bullets',
    bullet       : '.responsiville-slideshow-bullet',
    next         : '.responsiville-slideshow-next',
    previous     : '.responsiville-slideshow-previous',
    loading      : 'responsiville-slideshow-loading',
    loaded       : 'responsiville-slideshow-loaded',
    selecting    : 'responsiville-slideshow-slide-selecting',
    selected     : 'responsiville-slideshow-slide-selected',
    bulletsPos   : 'bc',
    bulletOn     : 'responsiville-slideshow-bullet-selected',
    nextText     : 'Next',
    previousText : 'Previous',
    bulletText   : 'Slide',
    resizeMode   : 'slide',
    first        : 0,
    direction    : +1,
    start        : true,
    effect       : 'fade',
    speed        : 5000,
    transition   : 500,
    hover        : true,
    wait         : true
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

Responsiville.Slideshow.autoRun = function () {

    jQuery( Responsiville.Slideshow.defaults.container ).each( function () {

        new Responsiville.Slideshow({
            debug     : Responsiville.Main.getInstance().options.debug,
            container : this
        });
        
    });

};



/**
 * Sets up slideshow events when the slideshow is initialised. Gets called 
 * automatically by the constructor.
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.setupEvents = function () {

    var k;

    var breakpointsEnter;

    // Register to be enabled on the required breakpoints.
    
    if ( this.options.wait ) {

        breakpointsEnter = Responsiville.splitAndTrim( this.options.enter );

        for ( k=0, length=breakpointsEnter.length; k<length; k++ ) {
            this.responsiville.on( 'enter.' + breakpointsEnter[k], this.getBoundFunction( this.enableOnFirstSlideLoad ) );
        }

    } else {
        
        breakpointsEnter = Responsiville.splitAndTrim( this.options.enter );

        for ( k=0, length=breakpointsEnter.length; k<length; k++ ) {
            this.responsiville.on( 'enter.' + breakpointsEnter[k], this.getBoundFunction( this.enable ) );
        }

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



    // Slideshow container mouse enter/leave events.
    
    this.$container.on( 'mouseenter', this.getBoundFunction( this.containerMouseEnter ) );
    this.$container.on( 'mouseleave', this.getBoundFunction( this.containerMouseLeave ) );

    
    
    // Slideshow navigation events.
    
    this.$bullets.on( 'click', this.getBoundFunction( this.bulletMouseClick ) );
    this.$next.on( 'click', this.getBoundFunction( this.nextMouseClick ) );
    this.$previous.on( 'click', this.getBoundFunction( this.previousMouseClick ) );

    this.$container.hammer().bind( 'swiperight', this.getBoundFunction( this.previousMouseClick ) );
    this.$container.hammer().bind( 'swipeleft', this.getBoundFunction( this.nextMouseClick ) );
    
    
    
    // Adjust slideshow container to current slide height on window resize.
    
    this.responsiville.on( 'resize', this.getBoundFunction( this.adjustContainer ) );

    // Adjust slideshow container when images inside slides finish loading.
    
    this.$container.find( 'img' ).on( 'load', this.getBoundFunction( this.imageLoaded ) );

};



/**
 * Enable the slideshow when the images of the first slide have loaded.
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.enableOnFirstSlideLoad = function () {

    // If first slide has images then wait for them to load.

    var imageOnFirstSlide = this.$slides.eq( this.options.first ).find( 'img' );

    if ( imageOnFirstSlide.length > 0 ) {

        var imageOnFirstSlideLoaded = Responsiville.hasImageLoaded( imageOnFirstSlide.get( 0 ) );

        if ( ! imageOnFirstSlideLoaded ) {

            imageOnFirstSlide.on( 'load', this.getBoundFunction( this.enable ) );
            return;

        }

    }

    // Otherwise go on and enable the slideshow right away.

    this.enable();

};



/**
 * Enables the slideshow. Means it creates the slideshow functionality on the 
 * selected containers and slides from scratch. Particularly useful when one 
 * wants to enable and disable the slideshow at certain responsive breakpoints.
 *
 * @fires Responsiville.Slideshow#enabled
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.enable = function () {

    if ( this.enabled ) {
        return;
    }
    


    this.log( 'enabling the slideshow' );



    // Mark slideshow as enabled.
    
    this.enabled = true;


    
    // Add classes to slideshow container and slides.

    this.$container.addClass( 'responsiville-slideshow-enabled' );
    this.$container.addClass( this.options.loading );
    this.$slides.addClass( 'responsiville-slideshow-slide' );
    


    // Add classes to slideshow navigation.

    this.$navigation.addClass( this.options.bulletsPos );
    this.$bullets.addClass( 'responsiville-slideshow-navigation-bullet' );
    this.$next.addClass( 'responsiville-slideshow-next' );
    this.$previous.addClass( 'responsiville-slideshow-previous' );

    
    
    // Cache slide numbering for future usage.
    
    var k;
    var length;
    
    for ( k=0, length=this.$slides.length; k<length; k++ ) {
        this.$slides.eq( k ).data( 'responsiville-slideshow-slide-number', k );
    }
    
    // Cache bullets numbering for future usage.
    
    for ( k=0, length=this.$bullets.length; k<length; k++ ) {
        this.$bullets.eq( k ).data( 'responsiville-slideshow-bullet-number', k );
    }
    


    // Hide all slides at first. 
    
    this.hideAll( true );



    // Resume slideshow or select correct slide.

    if ( this.options.start ) {
        this.start();
    } else {
        var index = this.calculateNext();
        this.select( index );
    }



    /**
     * Called after the slideshow has been enabled.
     * 
     * @event Responsiville.Slideshow#enabled
     */

    this.fireEvent( 'enabled' );

};



/**
 * Disable slideshow. Means it completely invalidates the slideshow behaviour
 * trying to restore things to their previous state, before the slideshow was 
 * enabled in the first place. Particularly useful when one wants to enable and
 * disable the slideshow at certain responsive breakpoints.
 *
 * @fires Responsiville.Slideshow#disabled
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.disable = function () {
    
    if ( ! this.enabled ) {
        return;
    }



    this.log( 'disabling the slideshow' );


    
    // Mark slideshow as disabled.
    
    this.enabled = false;
    
    
    
    // Stop the slideshow.
    
    this.pause();
    

    
    // Remove classes from slideshow container.

    this.$container.
        removeClass( 'responsiville-slideshow-enabled' ).
        css( 'height', 'auto' );


    
    // Remove classes from slideshow slides.
    
    this.$slides.removeClass( 'responsiville-slideshow-slide' );
    
    if ( this.options.effect == 'none' ) {
        
        // No transition effect was used.
        
        this.$slides.removeClass( 'responsiville-slideshow-slide-hidden' );
        
    }  else if ( this.options.effect == 'fade' ) {
        
        // The fade transition effect was used.
            
        this.$slides.css( 'opacity', 1 );

    }  else if ( this.options.effect == 'slide' ) {

        /**
         * @todo Slideshow horizontal slide effect.
         */
        
    }


    
    // Remove classes from slideshow navigation.
    
    this.$navigation.removeClass( this.options.bulletsPos );
    this.$bullets.removeClass( 'responsiville-slideshow-navigation' );
    this.$next.removeClass( 'responsiville-slideshow-next' );
    this.$previous.removeClass( 'responsiville-slideshow-previous' );



    /**
     * Called after the slideshow has been disabled.
     * 
     * @event Responsiville.Slideshow#disabled
     */
    
    this.fireEvent( 'disabled' );
    
};



/**
 * Starts the slideshow.
 *
 * @fires Responsiville.Slideshow#starting
 * @fires Responsiville.Slideshow#started
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.start = function () {

    /**
     * Called when the slideshow is starting.
     * 
     * @event Responsiville.Slideshow#starting
     */
    
    this.fireEvent( 'starting' );


    
    // Calculate whether the slideshow advances automatically or not.

    if ( this.paused === null ) {
        this.paused = ! this.options.start;
    } else {
        this.paused = false;
    }
    

    
    // Calculate the slide to show and selects it.

    var index = this.calculateNext();

    this.log( 'start from ' + index );

    this.adjustContainer();
    this.select( index );



    /**
     * Called after the slideshow has started.
     * 
     * @event Responsiville.Slideshow#started
     */
    
    this.fireEvent( 'started' );

};



/**
 * Pauses the slideshow.
 *
 * @fires Responsiville.Slideshow#paused
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.pause = function () {
    
    // Raises the paused flag.
    
    this.log( 'pause at ' + this.index );

    this.paused = true;

    
    
    // Stops any running and scheduled animations on slide container and slides.
    
    window.clearTimeout( this.timeoutHandler );

    // When a slide change is under way
    // and this code is reached
    // the slide which is being hidden finishes its animation
    // but this animation leads to the slide be totally hidden

    this.$container.velocity( 'finish', true );
    this.$slides.velocity( 'finish', true );
    


    /**
     * Called after the slideshow has paused.
     * 
     * @event Responsiville.Slideshow#paused
     */
    
    this.fireEvent( 'paused' );

};



/**
 * Adjusts the slideshow container to the correct height.
 * 
 * @fires Responsiville.Slideshow#containerAdjusted
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.adjustContainer = function () {

    // If slideshow disabled do nothing. 

    if ( ! this.enabled ) {

        return; 

    }



    // Stops any residual animations on the slideshow container.
    
    this.$container.velocity( 'finish', true );
    
    
    
    // Animates its height to the height correct size.
    
    if ( this.options.resizeMode == 'none' ) {
        
        // Nothing.
        
    } else if ( this.options.resizeMode == 'slide' ) {
        
        // Takes up the height of the current slide.
        
        this.$container.velocity({
            properties : { 
                height : this.$slides.eq( this.index ).height() 
            },
            options    : { 
                duration : this.options.transition/2, 
                complete: (function () { 

                    // Unfinished animations might have been scheduled on window resize before the enabled flag was set to false.

                    if ( ! this.enabled ) {

                        this.$container.css( 'height', 'auto' );

                    }



                    /**
                     * Called after the slideshow container has been adjusted.
                     * 
                     * @event Responsiville.Slideshow#containerAdjusted
                     */
                    
                    this.fireEvent( 'containerAdjusted' );

                }).bind( this )
            }
         });

    } else if ( this.options.resizeMode == 'maxSlide' ) {
        
        // Takes up the height of the tallest slide.
        
        var maxHeight = 0;
        
        for ( var k = 0, length = this.$slides.length; k < length; k++ ) {
            
            var slideHeight = this.$slides.eq( k ).height();
            
            maxHeight = slideHeight > maxHeight ? slideHeight : maxHeight ;

        }
        
        this.$container.velocity({
            properties : { height : maxHeight },
            options    : { duration : this.options.transition/2 }
        });



        /**
         * Called after the slideshow container has been adjusted.
         * 
         * @event Responsiville.Slideshow#containerAdjusted
         */
        
        this.fireEvent( 'containerAdjusted' );
        
    }
    
};



/**
 * Runs when an image -any image- inside a slide has loaded.
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.imageLoaded = function () {

    // Adjust slideshow container to current slide height.

    this.adjustContainer();

};



/**
 * Shows the given slide.
 * 
 * @fires Responsiville.Slideshow#slideShowing
 * @fires Responsiville.Slideshow#slideShown
 * 
 * @param {int} index    The index of the slide to show.
 * @param {int} previous The index of the slide previously shown.
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.show = function ( index, previous ) {

    /**
     * Called before the slide begins to show.
     * 
     * @event Responsiville.Slideshow#containerAdjusted
     */
    
    this.fireEvent( 'slideShowing' );


    
    // Stops any future scheduled actions.

    window.clearTimeout( this.timeoutHandler );
        
    
    
    // Hides the previous slide.

    if ( index != previous && ! this.firstRun ) {

        this.hide( previous );

    }
    
    
    
    // Sets the selected navigation bullets.
    
    this.$bullets.eq( previous ).removeClass( this.options.bulletOn );
    this.$bullets.eq( index ).addClass( this.options.bulletOn );

    this.$slides.removeClass( this.options.selecting );
    this.$slides.eq( index ).addClass( this.options.selecting );
    
    
    
    // Shows the currently selected slide with the correct visual effect.

    this.log( 'show slide ' + index );

    if ( this.options.effect == 'none' ) {
        
        // No slide transition effect.

        this.$slides.eq( index ).removeClass( 'responsiville-slideshow-slide-hidden' );

        this.slideShown( index );



        // Schedule the next slide.

        if ( this.options.start && ! this.paused ) {

            this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.selectNext ), this.options.speed );

        }



        /**
         * Called after the slide has been shown.
         * 
         * @event Responsiville.Slideshow#slideShown
         */
        
        this.fireEvent( 'slideShown' );
        
    } else if ( this.options.effect == 'fade' ) {
        
        // Fade slide transition effect.

        this.adjustContainer();

        this.$slides.eq( index ).velocity({ 
            properties : { opacity: 1, zIndex: 1 }, 
            options    : { 
                duration : this.options.transition, 
                easing   : 'easeInOutSine',
                complete : (function () {

                    this.slideShown( index );



                    // Schedule the next slide.

                    if ( this.options.start && ! this.paused ) {
                        this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.selectNext ), this.options.speed );
                    }



                    /**
                     * Called after the slide has been shown.
                     * 
                     * @event Responsiville.Slideshow#slideShown
                     */
                    
                    this.fireEvent( 'slideShown' );

                }).bind( this )
            } 
        });
        
    } else if ( this.options.effect == 'slide' ) {

        /**
         * @todo Slideshow horizontal slide effect.
         */
        
        this.slideShown( index );



        // Schedule the next slide.

        if ( this.options.start && ! this.paused ) {
            this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.selectNext ), this.options.speed );
        }



        /**
         * Called after the slide has been shown.
         * 
         * @event Responsiville.Slideshow#slideShown
         */
        
        this.fireEvent( 'slideShown' );

    }

};



/**
 * Runs when the process of showing a slide is complete, thus the slide is fully
 * shown, no matter whether the process took zero or more time.
 *
 * @param {int} index The index of the slide that was shown.
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.slideShown = function ( index ) {

    // Mark slide elements appropriately.

    this.firstRun = false;
    this.$container.removeClass( this.options.loading );
    this.$container.addClass( this.options.loaded );
    this.$slides.removeClass( this.options.selected );
    this.$slides.removeClass( this.options.selecting );
    this.$slides.eq( this.index ).addClass( this.options.selected );

};



/**
 * Hides the given slide. 
 *
 * @fires Responsiville.Slideshow#slideHiding
 * @fires Responsiville.Slideshow#slideHidden
 * 
 * @param {int}     index       The index of the slide to hide.
 * @param {boolean} immediately Whether to hide the slide immediately, without
 *                              using any transition effects, or not.
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.hide = function ( index, immediately ) {

    // Hides the given slide with the correct visual effect.

    this.log( 'hide slide ' + index );



    /**
     * Called before the slide starts hiding.
     * 
     * @event Responsiville.Slideshow#slideHiding
     */
    
    this.fireEvent( 'slideHiding' );


    
    if ( this.options.effect == 'none' ) {

        this.$slides.eq( index ).addClass( 'responsiville-slideshow-slide-hidden' );


        /**
         * Called after the slide has been hidden.
         * 
         * @event Responsiville.Slideshow#slideHidden
         */
        
        this.fireEvent( 'slideHidden' );

    } else if ( this.options.effect == 'fade' ) {

        this.$slides.eq( index ).velocity({ 
            properties : { opacity: 0, zIndex: 0 }, 
            options    : { 
                duration : immediately ? 0 : this.options.transition,
                easing   : 'easeInOutSine',
                complete : (function () {

                    /**
                     * Called after the slide has been hidden.
                     * 
                     * @event Responsiville.Slideshow#slideHidden
                     */
                    
                    this.fireEvent( 'slideHidden' );

                }).bind( this )
            } 
        });

    } else if ( this.options.effect == 'slide' ) {

        /**
         * @todo Slide close effect.
         */
        


        /**
         * Called after the slide has been hidden.
         * 
         * @event Responsiville.Slideshow#slideHidden
         */
        
        this.fireEvent( 'slideHidden' );

    }

};



/**
 * Hides all slides simultaneously.
 * 
 * @param {boolean} immediately Whether to hide the slides immediately, without
 *                              using any transition effects, or not.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.hideAll = function ( immediately ) {

    this.log( 'hide all slides' );
    
    // Hides one slide after the other.

    for ( var k = 0, length = this.$slides.length; k < length; k++ ) {
        this.hide( k, immediately );
    }

};



/**
 * Sets the given slide as selected and triggers the command to show it.
 *
 * @param {int} index The index of the slide to set as selected.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.select = function ( index ) {
    
    // Sets the given slide index as selected.
    
    var previous = this.index;

    this.index = index;

    this.log( 'selected slide ' + this.index );
    
    
    
    // Shows the given slide.

    this.show( index, previous );

};



/**
 * Selects and shows the next slide in row.
 *
 * @return {void}
 */

Responsiville.Slideshow.prototype.selectNext = function () {

    var index = this.calculateNext();

    this.select( index );

};



/**
 * Calculates the index of the next slide to be shown based on the current slide
 * and the slideshow direction.
 *
 * @return {int} The index of the next slide to be shown.
 */

Responsiville.Slideshow.prototype.calculateNext = function () {
    
    // If this is the first run of the slideshow initialize the index.

    if ( this.index === null ) {

        this.index = this.options.direction ? 
                         this.options.first - 1 : 
                         this.options.first + 1;
        
    }
    
    
    
    // Calculates the next slide to show.

    var index = this.index;

    // Resolve forward or backwards direction of slideshow.
    
    if ( this.options.direction > 0 ) {
        index = index+1 >= this.$slides.length ? 0 : index+1; 
    } else {
        index = index-1 < 0 ? this.$slides.length-1 : index-1;
    }

    

    // Return the calculated index.
    
    this.log( 'next calculated index is ' + index );
    
    return index;

};



/**
 * Selects and shows the next slide in the literal sense, the one on the right 
 * of the current slide.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.next = function () {
    
    this.log( 'go to slide on the right' );
    
    // Set direction momentarily to forward.

    var direction = this.options.direction;
    this.options.direction = +1;
    
    // Calculate next (forward) slide.

    var index = this.calculateNext();

    // Restore original direction.
 
    this.options.direction = direction;
    
    // Selects the slide at this index.

    this.select( index );

};



/**
 * Selects and shows the previous slide in the literal sense, the one on the 
 * left of the current slide.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.previous = function () {
    
    this.log( 'go to slide on the left' );

    // Set direction momentarily to backwards.
    
    var direction = this.options.direction;
    this.options.direction = -1;
 
    // Calculate previous slide.

    var index = this.calculateNext();
 
    // Restore original direction.
 
    this.options.direction = direction;
    
    // Selects the slide at this index.

    this.select( index );

};



/**
 * Event handler for when a user clicks on a slideshow navigation bullet.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.bulletMouseClick = function ( event ) {
    
    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        return;
    }


    
    // Gets the index of the clicked navigation bullet.

    var $bullet = jQuery( event.target );
    var index   = $bullet.data( 'responsiville-slideshow-bullet-number' );
    
    // Selects the slide at this index.

    this.log( 'bullet mouse click ' + index );

    this.select( index );

    return false;

};



/**
 * Event handler for when a user clicks on a slideshow next link.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.nextMouseClick = function () {
    
    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        return;
    }


    
    // Go to next slide.

    this.log( 'next mouse click' );

    this.next();

    return false;

};



/**
 * Event handler for when a user clicks on a slideshow previous link.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.previousMouseClick = function () {
    
    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        return;
    }

    // Go to previous slide. 

    this.log( 'previous mouse click' );

    this.previous();

    return false;

};



/**
 * Event handler for when a user's mouse enters their mouse inside the area of
 * the slideshow container.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.containerMouseEnter = function () {

    // If this is the first run do nothing.

    if ( this.firstRun ) {
        return;
    }

    // If slideshow is not enabled do nothing.
    
    if ( ! this.enabled ) {
        return;
    }



    // Start slideshow if hover option is active and slideshow was not previously paused.

    this.log( 'container mouse enter' );
    
    if (   this.options.hover && 
           this.options.start && 
         ! this.options.paused ) {

        this.pause();

    }

};



/**
 * Event handler for when a user's mouse leaves the area of the slideshow
 * container.
 * 
 * @return {void}
 */

Responsiville.Slideshow.prototype.containerMouseLeave = function () {

    // If slideshow is not enabled do nothing.

    if ( ! this.enabled ) {
        return;
    }


    
    // Start slideshow if hover option is active and slideshow was not previously paused.

    this.log( 'container mouse leave' );
    
    if (   this.options.hover && 
           this.options.start && 
         ! this.options.paused ) {

        this.timeoutHandler = window.setTimeout( this.getBoundFunction( this.start ), this.options.speed );

    }

};