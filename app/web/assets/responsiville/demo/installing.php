<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Installing Responsiville</h1>

        <p>
            Responsiville is a CSS/Javascript framework which is used in HTML pages, so everything you know about these technologies will actually work here as expected. In order for it to work properly you need to add its Javascript and CSS files.
        </p>



        <h2>Include scripts</h2>

        <p>
            In order to include Responsiville in your web page you simply need to add its scripts. Responsiville has three sets of scripts and you need to know very few things about them and the order in which to include them in your page.
        </p>

        <ol>
            <li>Global <strong>settings script</strong>, which is optional and has default values.</li>
            <li><strong>Core scripts</strong>: the scripts that define the main Responsiville behaviour.</li>
            <li><strong>Responsiville modules</strong>: scripts that define commom elements.</li>
        </ol>

        <p>
            Global settings script <strong>(optional)</strong>
        </p>

        <p>
            Controls whether the framework auto initialises or the developer will manually initialise it when they need and whether the debug mode is on or off. These global variables need to be declared well before the actual scripts are included, but they are totally optional. If they are left out then the framework initialises automatically and the debug mode is off.
        </p>

        <pre><code class = "language-markup"><!--
            <script type="text/javascript">

                RESPONSIVILLE_AUTO_INIT = true;
                RESPONSIVILLE_DEBUG     = false;

            </script>
        --></code></pre>

        <p>Core scripts <strong>(mandatory)</strong></p>

        <p>
            These are the main Responsiville scripts that define the basic framework behaviour and functionality. They can be included in the head or before closing the body element of a web page, but including them in the head helps the framework initialise more quickly, be available during page load before the <code>DOMContentLoaded</code> event, and avoid some potential &quot;floucs&quot;.
        </p>

        <pre><code class = "language-markup"><!--
            <script type="text/javascript" charset="utf-8" src="responsiville.def.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.bugsy.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.events.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.main.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.main.run.js"></script>
        --></code></pre>

        <p>Responsiville modules <strong>(include what you need)</strong></p>

        <p>
            Responsiville modules are common, reusable HTML components such as accordions, mobile menus, slideshows, etc, which build upon the Responsiville framework and utilise its responsive behaviour. You may include any of them you need, either right after the Responsiville core scripts, if they are included in the head, or independently before closing the body element.
        </p>

        <pre><code class = "language-markup"><!--
            <script type="text/javascript" charset="utf-8" src="responsiville.accordion.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.equalheights.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.megamenu.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.mobimenu.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.scrollmenu.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.slideshow.js"></script>
            <script type="text/javascript" charset="utf-8" src="responsiville.run.js"></script>
        --></code></pre>



        <h2>Case 1, all in the head</h2>

        <p>
            All the Responsiville scripts can be put in the <code>HEAD</code>. This way the framework will be available right away, but one does not follow the recomendation of putting the scripts at the end of the body to avoid their blocking nature.
        </p>

        <pre><code class = "language-markup"><!--
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    ...
                    <script type="text/javascript">
                        // Remember, these are optional.
                        RESPONSIVILLE_AUTO_INIT = true;
                        RESPONSIVILLE_DEBUG     = false;
                    </script>
                    ...
                    <script type="text/javascript" charset="utf-8" src="responsiville.def.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.bugsy.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.events.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.main.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.main.run.js"></script>
                    ...
                    <script type="text/javascript" charset="utf-8" src="responsiville.accordion.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.equalheights.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.megamenu.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.mobimenu.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.scrollmenu.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.slideshow.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.run.js"></script>
                    ...
                </head>
                <body>
                    ...
                </body>
            </html>

        --></code></pre>



        <h2>Case 2, some in the head, some in the footer</h2>

        <p>
            The core Responsiville scripts in the HEAD and thre rest before closing the BODY. This is the <strong>recommended</strong> way to go as it provides the best compromise: the framework is available right away inside the <code>BODY</code> but only the necessary scripts are put in the <code>HEAD</code>; the rest are put in the footer, at the end of the <code>BODY</code>.
        </p>

        <p>
            Having the framework available right away helps in two ways: a) one has the <code>Responsiville.Main</code> object available inside the body and b) all the responsive behaviour in Javascript as well as CSS is available right away. The cost for this is having a few scripts in the <code>HEAD</code>.
        </p>

        <pre><code class = "language-markup"><!--
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    ...
                    <script type="text/javascript">
                        // Remember, these are optional.
                        RESPONSIVILLE_AUTO_INIT = true;
                        RESPONSIVILLE_DEBUG     = false;
                    </script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.def.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.bugsy.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.events.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.main.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.main.run.js"></script>
                    ...
                </head>
                <body>
                    ...
                    <script type="text/javascript" charset="utf-8" src="responsiville.accordion.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.equalheights.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.megamenu.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.mobimenu.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.scrollmenu.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.slideshow.js"></script>
                    <script type="text/javascript" charset="utf-8" src="responsiville.run.js"></script>
                </body>
            </html>

        --></code></pre>

        <p>
            The latter is the recommended way for including Responsiville. Of course one may include the scripts in any way they see fit, as long as they know what they are doing (for instance, put all scripts in the footer).
        </p>



        <h2>Include CSS files</h2>

        <p>
            And of course there are the respective CSS files which are all to be included in the HEAD.
        </p>

        <pre><code class = "language-markup"><!--
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    ...
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.def.css" />
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.bugsy.css" />
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.moressette.css" />
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.ingrid.css" />
                    ...
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.accordion.css" />
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.megamenu.css" />
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.mobimenu.css" />
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.scrollmenu.css" />
                    <link rel="stylesheet" type="text/css" href="../css/responsiville.slideshow.css" />
                    ...
                </head>
                <body>
                    ...
                </body>
            </html>

        --></code></pre>

        <p>
            Note that we have separated the CSS files that refer to the main Responsiville setup and the CSS files that belong to the Responsiville Javascript modules. As we mentioned before you may include all or any of the modules you wish to use.
        </p>



    </article>



<?php include( 'footer.php' ); ?>