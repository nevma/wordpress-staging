/**
 * The main Responsiville framework scope. It defines the scope and some general
 * usage important functions used throughout the framework in responsive web 
 * development.
 *
 * @namespace Responsiville
 */

var Responsiville = {};



/**
 * @property {String} VERSION The current version of the framework.
 */

Responsiville.VERSION = '1.1';



/**
 * Extends a given function/class with the functions of a given namespace. The
 * given namespace has to contain proper functions designed to extend a
 * prototype, otherwise unexpected behaviour might occur.
 * 
 * @param {Object} prototype The function/class that is to be extended. Has to
 *                           be a class defining function.
 * @param {Object} namespace The namespace of functions which will extend the
 *                           given function/class prototype.
 *                           
 * @return {void}
 */

Responsiville.extend = function ( object, namespace ) {

    for ( var key in namespace ) {

        object.prototype[key] = namespace[key];

    }

};



/**
 * Takes a function and returns a version of it that, when called repeatedly, 
 * will not run more often than a given time threshold. This way the given 
 * function, when called repeatedly, is guaranteed to run, in the worst case, no
 * more often thant the given interval.
 *
 * @param {Function} theFunction The function to throttle.
 * @param {int}      threshold   The time threshold more often than which the 
 *                               given function should not run, that is to be
 *                               throttled
 * @param {Object}   scope       The object scope in which the throttled 
 *                               function is required to run.
 *
 * @return {Function} The throttled function.
 */

Responsiville.throttle = function ( theFunction, threshold, scope ) {

    // Set a default throttle duration.
    
    if ( typeof threshold === 'undefined' ) {
        threshold = 250;
    }

    

    // Time of last call of the function.

    var last = null;

    // Handler that controls the next execution of the function.

    var timeoutHandler = null;



    // Return a throttled function to use.

    return function () {

        // The context within which the function will be executed and the arguments to pass to it.

        var context = scope || this;
        var args    = arguments;



        // Check how much time has passed since the last call.

        var now = new Date().getTime();

        if ( last && now < last + threshold ) {

            // Cancel previous scheduled execution.

            clearTimeout( timeoutHandler );

            // And schedule a new one.

            timeoutHandler = setTimeout( function () {

                last = now;
                theFunction.apply( context, args );

            }, threshold );

        } else {

            // Enough time has passed, time for a new execution.

            last = now;
            theFunction.apply( context, args );

        }

    };

};



/**
 * Takes a function and returns a version of it that, when called repeatedly, 
 * its execution is postponed for at least as much as the given interval 
 * indicates. This means that, when called repeatedly, if the repetitions of its
 * calls are within the given interval with each other, the function will only
 * run once, in the end.
 *
 * @param {Function} theFunction The function to debounce.
 * @param {int}      delay       The time delay inside which the given function
 *                               should not be executed more than once, that is
 *                               be debounced.
 * @param {Object}   scope       The object scope in which the debounced 
 *                               function is required to run.
 *
 * @return {Function} The throttled function.
 */

Responsiville.debounce = function ( theFunction, delay, scope ) {

    // Set a default debounce duration.

    if ( typeof delay === 'undefined' ) {
        delay = 250;
    }



    // Handler that controls the next execution of the function.

    var timeoutHandler = null;

    // Returns a debounced function to use.

    return function () {

        // The context within which the function will be executed and the arguments to pass to it.

        var context = scope || this;
        var args    = arguments;

        // Cancel previous scheduled execution.

        clearTimeout( timeoutHandler );

        // And schedule a new one.

        timeoutHandler = setTimeout( function () {

            theFunction.apply( context, args );

        }, delay );

    };

};



/**
 * Checks whether a given IMG element is fully loaded.
 * 
 * @param  {HTMLImageElement} image The IMG element to check.
 * 
 * @return {Boolean} Whether the given IMG element is fully loaded.
 */

Responsiville.hasImageLoaded = function ( image ) {

    return typeof image.complete     !== 'undefined' && image.complete     === true || 
           typeof image.naturalWidth !== 'undefined' && image.naturalWidth !== 0;

};




/**
 * Takes an input and, if it is not an array, it first converts it to an array
 * by splitting it by the given separator, then takes each element of the
 * resulting array and removes the whitespace from its beginning and end and
 * returns that array. Only applies to strings or arrays of strings. Useful when
 * transforming an unknown input that might contain a single string, a comma
 * separated list of string or an array of strings to a trimmed array of
 * strings.
 *
 * @param {Array<string>|string} input The string to split and then trim or the
 *                                     array to simply trim its elements.
 * 
 * @return {Array<string>} The resulting array of trimmed strings.
 */

Responsiville.splitAndTrim = function ( input, separator ) {

    if ( typeof separator === 'undefined' ) {
        separator = ',';
    }

    var inputArray = jQuery.isArray( input ) ? input : input.split( separator );

    for ( var k = 0, length=inputArray.length; k < length; k++ ) {
        inputArray[k] = inputArray[k].replace( /^\s+|\s+$/, '' );
    }

    return inputArray;

};