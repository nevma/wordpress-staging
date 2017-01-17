<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Scrollmenu</h1>

        <p>
            The Responsiville scrollmenu is an element that becomes fixed in position, usually at the top of the screen, following the user scroll events, once the page has scrolled beyond the point where it would otherwise become non-visible. The idea is usually implemented on navigation elements, but it can actually be any kind of HTML element the developer needs.
        </p>

        <p>
            Here is an example, where one can define a scrollmenu automatically by adding the <code>responsiville-scrollmenu</code> class to it:
        </p>

        <pre><code class = "language-markup"><!--
            <nav class="navigation horizontal responsiville-scrollmenu">
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
            Note that the designated class is added to the whole container that we want to make a scrollmenu.
        </p>

        <p>
            One should know that the scrollmenu module is a tad obtrusive in their HTML because it <strong>clones</strong> the original element that is supposed to become a scrollmenu, and acts on the clone, so that it will not interfere with its rendering in any way.
        </p>

        <p>
            Here is how one could create a scrollmenu in a non-automatic way:
        </p>

        <pre><code class = "language-javascript">
            var scrollmenu = new Responsiville.Scrollmenu({
                element : '.responsiville-scrollmenu',
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
                    js_beautify( JSON.stringify( Responsiville.Scrollmenu.defaults ) ) +
                '</code></pre>'
            );
        </script>



        <h2>Working examples</h2>

        <p>
            Here is a full working example based on the above case:
        </p>

        <style type = "text/css">
            /* A tiny bit of robbery here! */
            .responsiville-mobimenu-wrapper nav {
                min-height: 100%;
                background-color: white;
            }
            .responsiville-mobimenu-wrapper button {
                color: var(--color-gray-dark) ! important;
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
                    padding: 1.5rem 1rem ! important;
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

        <p>
            Now, in order for the menu below to display its behaviour as a scrollmenu, one has to scroll down the page enough for it to be &quot;scrolled out of sight&quot;. This means that the user has to scroll down at least that much so the menu is no more in the viewable part of the screen.
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "column-100 with-contents" data-info = ".column-100">
                    <div class = "the-contents">
                        <nav class = "navigation horizontal responsiville-mobimenu responsiville-scrollmenu responsiville-megamenu-example clear" data-responsiville-scrollmenu-zindex="1000">
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
                    </div>
                </div>
            </div>
            <div class = "row small-group-2" data-info = ".row">
                <div class = "column-50 with-contents" data-info = ".column-50">
                    <div class = "the-contents">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere beatae eligendi, delectus modi nesciunt, non obcaecati asperiores eius quisquam quo, dolores minima. Eum dolorum, ducimus aspernatur minima, quaerat vero, velit nulla accusamus ipsam iure ex. Culpa corporis a in accusamus consequatur, alias qui, reiciendis iusto!
                        </p>
                    </div>
                </div>
                <div class = "column-50 with-contents" data-info = ".column-50">
                    <div class = "the-contents">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia, deserunt vero fugiat odio perspiciatis, voluptatem itaque rerum natus deleniti id molestias eaque quam ea beatae fugit corporis nisi, dolorem inventore modi consequatur quo. Similique.
                        </p>
                    </div>
                </div>
                <div class = "column-50 with-contents" data-info = ".column-50">
                    <div class = "the-contents">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, vero natus accusamus eum temporibus, tenetur recusandae odit soluta. Assumenda, aperiam?
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, facere neque. Repellat odit architecto quas, eveniet omnis aspernatur fugiat, et, dignissimos, ad culpa quisquam perferendis!
                        </p>
                    </div>
                </div>
                <div class = "column-50 with-contents" data-info = ".column-50">
                    <div class = "the-contents">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est dolor odit ab quam repellendus alias incidunt distinctio dolores. Voluptatibus explicabo, rerum tempora repudiandae mollitia, blanditiis accusantium deleniti libero numquam perspiciatis veritatis doloribus id maiores quos.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus consectetur ratione reiciendis voluptatem nostrum quis accusantium fugit? Ipsam deleniti, vero.
                        </p>
                    </div>
                </div>
            </div>
        </div>



        <p>
            Note that the above example <strong>combines a megamenu as well as a mobimenu as well as a scrollmenu</strong> all of them implemented on the same original element. This is totally possible and, actually, quite commonly necessary in responsive web design. However, one has to be extra careful about styling all these four states (original state, megamenu state, mobimenu state, scrollmenu state) and also about the breakpoints where each of them is enabled and disabled. For instance the megamenu is meaningful in big screens, where the user has a mouse, while the mobimenu is meaningful in small, touch enabled, screens, while the scrollmenu could be meaningful in all screens.
        </p>



    </article>



<?php include( 'footer.php' ); ?>