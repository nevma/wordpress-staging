<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Mobimenu</h1>

        <p>
            The mobimenu is what has come to be known as a &quot;burger&quot; menu. It takes a full menu, that is an HTML element and its contents, which is usually used for navigation, and shrinks it down to a single button, when there is not enough space to render it as a whole. The point where this shrinking takes place is defined by our responsive breakpoints. Whether that button is actually a burger menu or something else, depends entirely on the developer. The burger is just the common default. When this button is clicked the original -or what appears to be it- element appears in a way that utilises a bigger part of the screen.
        </p>

        <p>
            Here is an example, where one can define a mobimenu automatically by adding the <code>responsiville-mobimenu</code> class to it:
        </p>

        <pre><code class = "language-markup"><!--
            <nav class="navigation horizontal responsiville-mobimenu">
                <ul>
                    <li>
                        <a href="#">Menu 1</a>
                        <ul>
                            <li><a href="#">Menu 1-1</a></li>
                            <li><a href="#">Menu 1-2</a></li>
                            <li><a href="#">Menu 1-3</a></li>
                            <li><a href="#">Menu 1-4</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Menu 2</a>
                        <ul>
                            <li><a href="#">Menu 2-1</a></li>
                            <li><a href="#">Menu 2-2</a></li>
                            <li><a href="#">Menu 2-3</a></li>
                            <li><a href="#">Menu 2-4</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Menu 3</a>
                        <ul>
                            <li><a href="#">Menu 3-1</a></li>
                            <li><a href="#">Menu 3-2</a></li>
                            <li><a href="#">Menu 3-3</a></li>
                            <li><a href="#">Menu 3-4</a></li>
                            <li><a href="#">Menu 3-5</a></li>
                            <li><a href="#">Menu 3-6</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        --></code></pre>

        <p>
            Note that the designated class is added to the whole container that we want to make a mobimenu.
        </p>

        <p>
            One should know that the mobimenu module is a tad obtrusive in their HTML because a) it adds the burger menu automatically, as it was not there before, and b) it <strong>clones</strong> the original element that is supposed to become a mobimenu, and acts on the clone, so that it will not interfere with its rendering in any way.
        </p>

        <p>
            Here is how one could create a mobimenu in a non-automatic way:
        </p>

        <pre><code class = "language-javascript">
            var mobimenu = new Responsiville.Mobimenu({
                element : '.responsiville-mobimenu',
                enter   : 'small, mobile, tablet',
                leave   : 'laptop, desktop, large, xlarge'
            });
        </code></pre>



        <h2>Default values</h2>

        <p>
            Here is its full list of settings and default values:
        </p>

        <script type = "text/javascript">
            document.write(
                '<pre><code class = "language-json">' +
                    js_beautify( JSON.stringify( Responsiville.Mobimenu.defaults ) ) +
                '</code></pre>'
            );
        </script>



        <h2>Off-canvas element</h2>

        <p>
            The idea of the mobimenu can be used to implement any <strong>off-canvas</strong> element. This is an element that is hidden outside of the visible part of the screen and becomes visible at the click of a button. Depending on whether the developer needs to style that element from scratch or whether they could use some default styling, the mobimenu offers the <code>styled</code> setting, which is set to <code>true</code> by default, because its most common usage is on usual menu elements. Setting it to <code>false</code> allows you to turn any element into an off-canvas element, without the mobimenu module posing any extra styling apart from its own on the element.
        </p>



        <h2>Working examples</h2>

        <p>
            Here is a full working example based on the above case:
        </p>

        <style type = "text/css">
            /* A tiny bit of robbery here! */
            .responsiville-mobimenu-wrapper {
                margin-bottom: var(--text-rhythm);
            }
                .responsiville-mobimenu-wrapper nav {
                    min-height: 100%;
                    background-color: white;
                }
                .responsiville-mobimenu-wrapper button {
                    color: var(--color-gray-dark) ! important;
                }
                .responsiville-megamenu-example {
                    margin-bottom: var(--text-rhythm);
                }
                    .responsiville-megamenu-example ul ul {
                        display: none;
                    }
                    .responsiville-megamenu-example ul,
                    .responsiville-megamenu-example li {
                        padding: 0 ! important;
                        margin: 0  ! important;
                        display: block ! important;
                        list-style-type: none;
                    }
                    .responsiville-megamenu-example li {
                        margin-right: 2rem ! important;
                        background-color: white;
                    }
                    .responsiville-megamenu-example li li {
                        margin-right: 0 ! important;
                    }
                        .responsiville-megamenu-example ul a {
                            padding: 0 ! important;
                            border: none;
                            white-space: nowrap;
                            word-break: keep-all;
                            color: var(--color-gray-dark) ! important;
                        }
        </style>

        <nav class = "navigation horizontal responsiville-mobimenu responsiville-megamenu-example clear">
            <ul>
                <li>
                    <a href = "#" class = "responsiville-megamenu">Menu 1</a>
                    <ul>
                        <li><a href = "#">Menu 1-1</a></li>
                        <li><a href = "#">Menu 1-2</a></li>
                        <li><a href = "#">Menu 1-3</a></li>
                        <li><a href = "#">Menu 1-4</a></li>
                    </ul>
                </li>
                <li>
                    <a href = "#" class = "responsiville-megamenu">Menu 2</a>
                    <ul>
                        <li><a href = "#">Menu 2-1</a></li>
                        <li><a href = "#">Menu 2-2</a></li>
                        <li><a href = "#">Menu 2-3</a></li>
                        <li><a href = "#">Menu 2-4</a></li>
                    </ul>
                </li>
                <li>
                    <a href = "#" class = "responsiville-megamenu">Menu 3</a>
                    <ul>
                        <li><a href = "#">Menu 3-1</a></li>
                        <li><a href = "#">Menu 3-2</a></li>
                        <li><a href = "#">Menu 3-3</a></li>
                        <li><a href = "#">Menu 3-4</a></li>
                        <li><a href = "#">Menu 3-5</a></li>
                        <li><a href = "#">Menu 3-6</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <p>
            Note that the above example <strong>combines a megamenu as well as a mobimenu</strong> both of them implemented on the same original element. This is totally possible and, actually, quite commonly necessary in responsive web design. However, one has to be extra careful about styling all these three states (original state, megamenu state, mobimenu state) and also about the breakpoints where each of them is enabled and disabled. For instance the megamenu is meaningful in big screens, where the user has a mouse, while the mobimenu is meaningful in small, touch enabled, screens.
        </p>



    </article>



<?php include( 'footer.php' ); ?>