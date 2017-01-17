<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Initialising Responsiville</h1>

        <p>
            The easiest way to initialise Responsiville is via the automatic method described in the previous section. This method is also the default one. However, if you want to control the way the way and the timing of the initialisation of Responsiville you can do it manually.
        </p>



        <h2>The automatic way</h2>

        <p>
            If you do not set anything, which means that the default values are in effect, the Responsiville framework initialises automatically. The global variable which controls this behaviour is <code>RESPONSIVILLE_AUTO_INIT</code>. This value propagates from the main Responsiville object (more on this later on) to all the Responsiville modules. This means that if you set it to <code>true</code> then the main Responsiville object and all its included modules will actually automatically initialise. But if you set it to <code>false</code> this means that you will have to initialise the main Responsiville and each of its modules manually.
        </p>



        <h2>The manual way</h2>

        <p>
            In order to initialise Responsiville the manual way one has to turn off the automatic initialisation by setting the <code>RESPONSIVILLE_AUTO_INIT</code> to <code>false</code>. This has to be done somewhere before the Responsiville scripts are included in the HTML. Then, one can initialise the framework whenever they need, but it is recommended to do this either upon the <code>DOMContentLoaded</code> event or as shortly after it as possible. For instance in jQuery terms one could do:
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
            Note that the <code>Responsiville.Main</code> object creation is a two-step process. The first step is to <strong>instantiate</strong> it and the second to <strong>initialise</strong> it. Simply instantiating it makes the framework available for breakpoint changes and responsive behaviour, but one has to call the <code>init()</code> function in order for it to be fully usable. The process is split in two steps because oftentimes the first step can be called in the <code>HEAD</code> to speed things up but the second step can be called at the footer before closing the <code>BODY</code> element.
        </p>

        <p>
            And this is its full set of settings:
        </p>

        <style type = "text/css">
            /* We are doing a tiny robbery here! */
            code[class*="language-"] *,
            pre[class*="language-"] * {
                font-family: "Responsiville Icons", "Anonymous Pro", Consolas, monospace !important;;
            }
        </style>

        <script type = "text/javascript">
            document.write(
                '<pre><code class = "language-json">' +
                    js_beautify( JSON.stringify( Responsiville.Main.defaults ) ) +
                '</code></pre>'
            );
        </script>

        <p>
            Note that the breakpoints themselves are part of the initialisation settings of the framework. This means that the developer may add breakpoints, if they see it necessary, in order to further fine tune the appearance of a web page across devices. 
        </p>

        <h2>Grid debugging</h2>

        <p>
            When the Responsiville framework is in debug mode, that is the <code>RESPONSIVILLE_DEBUG</code> flag hase been se to true, there is a small debug box available for the developer at the bottom right corner of the screen. This box contains information on the loading and speed of the page as well as the current breakpoint of the browser viewport.
        </p>

        <p>
            In addition, the debug box contains two helpful debug checkboxes &quot;Grid debug&quot; and &quot;Blocks&quot; debug. When they are activated, the first one outlines the building blocks of your grid, that is the rows and the columns, so that you can debug your grid structure and the second one outlines the block level elements of your text, so that you can debug you typography.
        </p>

        <p>
            Last, but not least, do not forget to check your browser console for useful debug messages from the Responsiville framework.
        </p>

        <pre><code class = "language-markup"><!--
            22:05:28.391 [responsiville.main]                                   responsiville.bugsy.js:132
            22:05:28.396 
                ____                                   _       _ ____
               / __ \___  _________  ____  ____  _____(_)   __(_) / /__
              / /_/ / _ \/ ___/ __ \/ __ \/ __ \/ ___/ / | / / / / / _ \
             / _, _/  __(__  ) /_/ / /_/ / / / (__  ) /| |/ / / / /  __/
            /_/ |_|\___/____/ .___/\____/_/ /_/____/_/ |___/_/_/_/\___/
                           /_/
                                                           version 1.1

            breakpoints:
            small   320px
            mobile  599px
            tablet  1023px
            laptop  1279px
            desktop 1439px
            large   1679px
            xlarge  99999px                                                     responsiville.bugsy.js:139:9
            22:05:28.403 [responsiville.main]                                   responsiville.bugsy.js:132
            22:05:28.404 adjusting to viewport                                  responsiville.bugsy.js:139:9
            22:05:28.416 [responsiville.main]                                   responsiville.bugsy.js:132
            22:05:28.417 window resized                                         responsiville.bugsy.js:139:9
            22:05:28.419 window width: 1920                                     responsiville.bugsy.js:139:9
            22:05:28.431 breakpoint changed from: xlarge                        responsiville.bugsy.js:139:9
            22:05:28.433 current breakpoint: xlarge                             responsiville.bugsy.js:139:9
            22:05:30.513 [responsiville.main]                                   responsiville.bugsy.js:132
            22:05:30.515 adjusting to viewport                                  responsiville.bugsy.js:139:9
            22:05:30.523 [responsiville.main]                                   responsiville.bugsy.js:132
            22:05:30.525 window resized                                         responsiville.bugsy.js:139:9
            22:05:30.526 window width: 1920                                     responsiville.bugsy.js:139:9
            22:05:30.528 no breakpoint change                                   responsiville.bugsy.js:139:9
            22:05:30.529 current breakpoint: xlarge                             responsiville.bugsy.js:139:9
            22:05:30.538 [responsiville.main]                                   responsiville.bugsy.js:132
            22:05:30.540 framework Responsiville has initialised                responsiville.bugsy.js:139:9
        --></code></pre>



    </article>



<?php include( 'footer.php' ); ?>