/**
 * Special scope which contains functions that may be injected in any object's
 * prototype so that it is extended with event mechanisms (event register, 
 * deregister, fire). Not meant to be used autonomously.
 * 
 * @namespace Responsiville.Events
 */

Responsiville.Events = {};



/**
 * Registers an event in the scope of the calling object. Simply makes the 
 * object aware of that particular event and prepares its structures.
 * 
 * @param {String} eventName The name of the event to register.
 */

Responsiville.Events.registerEvent = function ( eventName ) {

    if ( typeof this.events === 'undefined' ) {
        this.events = {};
    }

    if ( typeof this.events[eventName] === 'undefined' ) {
        this.events[eventName] = [];
    }

};



/**
 * Deregisters an event in the scope of the calling object. Simply makes the 
 * object no longer aware of that particular event and cleans its structures.
 * 
 * @param {String} eventName The name of the event to deregister.
 */

Responsiville.Events.deregisterEvent = function ( eventName ) {

    if ( typeof this.events !== 'undefined' ) {
        delete this.events[eventName];
    }

};



/**
 * Registers a callback function to be called when an event is fired on the
 * calling object inside the scope of the object.
 *
 * @param {String}   eventName The name of the event in which to attach the
 *                             callback function.
 * @param {Function} callback  The callback function to attach to the event.
 */

Responsiville.Events.on = function ( eventName, callback ) {

    this.registerEvent( eventName );
    this.events[eventName].push( callback );

};



/**
 * Deregisters a callback function from being called when the event is fired on
 * the calling object.
 *
 * @param {String}   eventName The name of the event in which to detach the
 *                             callback function.
 * @param {Function} callback  The callback function to detach to the event.
 */

Responsiville.Events.off = function ( eventName, callback ) {

    var index = this.events[eventName].indexOf( callback );
    this.events[eventName].splice( index, 1 );

};



/**
 * Calls all the callbacks registered on the given event on the calling object.
 * The callback will be called in the scope of that object.
 *
 * @param {String} eventName The name of the event whose callbacks are to be
 *                           called. 
 * @param {array}  args      Array of argument values to pass to the callback
 *                           functions when they are called. It is up to the 
 *                           callback function to know what these arguments are
 *                           and how to use them in runtime.
 */

Responsiville.Events.fireEvent = function ( eventName, args ) {

    if ( typeof this.events === 'undefined' ) {
        return;
    }

    for ( var k in this.events[eventName] ) {
        this.events[eventName][k].apply( this, args );
    }

};



/**
 * Takes a function, binds it in the scope of the current object and returns the
 * bound function. If the same function has been bound to the current object
 * before, then that bound instance is returned and no new bound function is 
 * created. Useful when registering and deregistering bound functions to the
 * Responsiville framework's events where you do not want to register the same
 * bound function to an event twice by accident.
 *
 * @param {Function} theFunction The function to bind to the current object 
 *                               scope.
 */

Responsiville.Events.getBoundFunction = function ( theFunction ) {

    if ( typeof this.boundFunctions === 'undefined' ) {

        // Holds the bound functions of this object.
        
        this.boundFunctions = [];

        // Holds the original functions used for the bound functions above.
        
        this.originalFunctions = [];

    }



    // Check if the given function has been bound already.

    var index = jQuery.inArray( theFunction, this.originalFunctions );

    if ( index > -1 ) {
        return this.boundFunctions[index];
    }



    // Bind, keep for future use and return the bound function.

    var theFunctionBound = theFunction.bind( this );

    this.boundFunctions.push( theFunctionBound );
    this.originalFunctions.push( theFunction );

    return theFunctionBound;

};