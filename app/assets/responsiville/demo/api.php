<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville API</h1>

        <p>
            Here is the Responsiville Javascript API:
        </p>

        <p>
            <a href = "http://vanilla.nevma.gr/wp-content/docs/responsiville-jsdoc/" title = "Responsiville Javascript API" target = "_blank" class = "button">Responsiville Javascript API</a>
        </p>

        <p>
            You can find the Responsiville icon fonts here:
        </p>

        <p>
            <a href = "../fonts/demo.html" title = "Responsiville icon fonts" target = "_blank" class = "button">Responsiville icon fonts</a>
        </p>



        <h2>The Responsiville.Main Object</h2>

        <p>
            The Responsiville framework defines and depends on the <code>Responsiville.Main</code> object which is a singleton. This means that only one instance of it is available in each web page. This object is initialised as shown in the previous section.
        </p>

        <p>
            After having been initialised one can access it like this:
        </p>

        <pre><code class = "language-javascript">
            // Acquire the Responsiville singleton instance.
            var responsiville = Responsiville.Main.getInstance();
        </code></pre>

        <p>
            And then use it like:
        </p>

        <pre><code class = "language-javascript">
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
            The page's responsive behaviour is structured around this very object and all the other Responsiville modules build upon the Responsiville Main object and use it extensively in order to implement their own responsive behaviour. 
        </p>



        <h2>Examples</h2>

        <p>
            Here are some API usage examples of the Responsiville Main object.
        </p>

        <pre><code class = "language-javascript">
            // Acquire the Responsiville singleton instance.
            var responsiville = Responsiville.Main.getInstance();

            // Adjust to the current viewport dimensions.
            responsiville.adjust();

            // Call event listeners bound on breakpoint changes.
            responsiville.fireChangeEvents();

            // Check if current viewport is in tablet breakpoint.
            if ( responsiville.is( 'tablet' ) ) {
                ...
            }

            // Check if current browser is in a mobile device.
            if ( responsiville.isDevice() ) {
                ...
            }
        </code></pre>

        <p>
            You can read more on this in the API and in the chapters to follow.
        </p>



    </article>



<?php include( 'footer.php' ); ?>