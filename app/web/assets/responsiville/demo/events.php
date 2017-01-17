<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Events</h1>

        <p>
            All the Responsiville modules inherit all the functions from the <code>Responsiville.Event</code> scope. This scopes works like an abstract class/interface, from which the modules inherit their basic event handling mechanism. The whole framework itself, via its <code>Responsiville.Main</code> object, is based on this event handling mechanism as well.
        </p>

        <p>
            This event handling mechanism is based on the simple idea that <strong>event callback functions</strong> are set based on the event code-names, which each module knows for itself, and then, when the modules fire these events, all the attached callback functions are executed in the scope of the module. Just as you would expect it to happen in any HTML element that is accessible via a Javascript API.
        </p>

        <p>
            Responsiville Main events example:
        </p>

        <pre><code class = "language-javascript">
            // Acquire the Responsiville singleton instance.
            var responsiville = Responsiville.Main.getInstance();

            // Do something when the current breakpoint changes.
            responsiville.on( 'change', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The breakpoint has changed to => ' + this.currentBreakpoint.name );

            });

            // Do something when entering the tablet breakpoint.
            responsiville.on( 'enter.tablet', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The breakpoint has changed to "tablet"' );

            });
        </code></pre>

        <p>
            Responsiville Slideshow events example:
        </p>
            
        <pre><code class = "language-javascript">
            // Create a slideshow on a designated container.
            var slideshow = Responsiville.Slideshow({container: '#slideshow'});

            // So something when a slide of the slideshow is shown.
            slideshow.on( 'slideShown', function () {

                // The "this" scope refers to the slideshow instance.
                console.dir( 'The slide has been shown' );

            });

            // So something when a slide of the slideshow is hidden.
            slideshow.on( 'slideHidden', function () {

                // The "this" scope refers to the slideshow instance.
                console.dir( 'The slide has been hidden' );

            });
        </code></pre>

        <p>
            Responsiville Megamenu events example:
        </p>
            
        <pre><code class = "language-javascript">
            // Create a megamenu on a designated element.
            var megamenu = Responsiville.Megamenu({activator: '#megamenu'});

            // So something when the megamenu is opened.
            megamenu.on( 'menuOpened', function () {

                // The "this" scope refers to the megamenu instance.
                console.dir( 'The megamenu has been opened' );

            });

            // So something when the megamenu is closed.
            megamenu.on( 'menuClosed', function () {

                // The "this" scope refers to the megamenu instance.
                console.dir( 'The megamenu has been closed' );

            });
        </code></pre>



        <h2>Main#init event</h2>

        <p>
            One of the most important events of the Responsiville framework is <code>init</code> of the <code>Responsiville.Main</code> object. It fires when the framework has finished initialising, which means that it has detected all the screen dimensions related properties and that it is ready to support the framework&apos;s responsive behaviour. You are advised to run your responsive code upon this event.
        </p>

        <pre><code class = "language-javascript">
            // Acquire the Responsiville singleton instance.
            var responsiville = Responsiville.Main.getInstance();

            // Do something when the framework has initialised.
            responsiville.on( 'init', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The Responsiville framework has initialised' );

            });
        </code></pre>



        <h2>Main#change event</h2>

        <p>
            Another important event of the Responsiville framework is <code>init</code> of the <code>Responsiville.Main</code> object. It fires when the browser viewport has changed breakpoint. It is one of the main entry points for implementing responsive behaviour, not just for your code, but for the whole framework itself. All the framework&apos;s modules and their behaviour depend on such events.
        </p>

        <pre><code class = "language-javascript">
            // Acquire the Responsiville singleton instance.
            var responsiville = Responsiville.Main.getInstance();

            // Do something when the current breakpoint changes.
            responsiville.on( 'change', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The breakpoint has changed to => ' + this.currentBreakpoint.name );

            });
        </code></pre>



        <h2>Main#[enter|leave].&lt;breakpoint&gt; events</h2>

        <p>
            A very important set of events of the Responsiville framework is are those who refer to the viewport entering and leaving specific breakpoints. The code naems for these events follow the pattern <code>enter</code> or <code>leave</code> followed by a <code>.</code> and then followed by the breakpoint name. For instance:
        </p>

        <pre><code class = "language-javascript">
            // Acquire the Responsiville singleton instance.
            var responsiville = Responsiville.Main.getInstance();

            // Do something when the tablet breakpoint is entered.
            responsiville.on( 'enter.tablet', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The breakpoint has changed to tablet' );

            });

            // Do something when the tablet breakpoint is left.
            responsiville.on( 'leave.tablet', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The breakpoint is not tablet any more' );

            });

            // Do something when the laptop breakpoint is entered.
            responsiville.on( 'enter.laptop', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The breakpoint has changed to laptop' );

            });

            // Do something when the laptop breakpoint is left.
            responsiville.on( 'leave.laptop', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The breakpoint is not laptop any more' );

            });
        </code></pre>



    </article>



<?php include( 'footer.php' ); ?>