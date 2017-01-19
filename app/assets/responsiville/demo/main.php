<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Main object</h1>

        <p>
            The Responsiville framework defines -and depends on it- a <code>Responsiville.Main</code> object, which is a singleton. This means that only one instance of it is available in each web page. This object is the cornerstone of the Responsiville framework. The whole framework and all its modules depend on it to function and implement their responsive behaviour.
        </p>

        <p>
            First the <code>Responsiville.Main</code> object needs to be instantiated and initialised:
        </p>

        <pre><code class = "language-javascript">
            $( function () {
            
                // Instantiate the Responsiville framework main object.
                var responsiville = new Responsiville.Main({
                    debug   : true,
                    debugUI : true
                });

                // Initialise the Responsiville framework main object.
                responsiville.init();
                
            });
        </code></pre>

        <p>
            After having been initialised one can access it like this:
        </p>

        <pre><code class = "language-javascript">
            // Acquire the Responsiville singleton instance.
            var responsiville = Responsiville.Main.getInstance();

            // Do something when the framework has initialised.
            responsiville.on( 'init', function () {

                // The "this" scope refers to the responsiville instance.
                console.dir( 'The Responsiville framework has initialised' );

            });

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



        <h2>Initialisation process</h2>

        <p>
            The instantiation and initialiasation process of the Responsiville Main object is done automatically by default. So, in most cases, one does not need to instantiate and initialise it. This behaviour is controlled by the <code>Responsiville.AUTO_INIT</code> flag, which is <code>true</code> by default. Look at the &quot;installing&quot; and &quot;initialising&quot; sections of this documentation for more details on this subject.
        </p>

        <h2>Responsiville Main events</h2>

        <p>
            The events of the Responsiville Main object are the most fundamental events of the whole framework because they control all the responsive behaviour of the framework itself, and its modules as well. It is these events that control and trigger behaviour that depends on screen/viewport dimensions and its changes (resizes, breakpoint changes, orientation changes, etc).
        </p>

        <p>
            You can read more on these events and how to use them in the corresponding documentation section. 
        </p>



    </article>



<?php include( 'footer.php' ); ?>