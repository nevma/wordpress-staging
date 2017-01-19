<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Megamenu</h1>

        <p>
            The megamenu implements what has come to be known as a -well- &quot;mega menu&quot;. A megamenu consists of an element that activates it and an element that opens up when the first element is activated. The activation trigger is usually a mouseover on the activator element. The element which opens up can be anything from a a simple list of links to a complex HTML element.
        </p>

        <p>
            The most common example of a megamenu is a dropdown list of links.
        </p>

        <p>
            Here is an example, with a nested unordered list of links. Whereever an anchor element has a sibling unordered list with links, then this anchor is marked with a <code>responsiville-megamenu</code> class. It is this anchor that is the megamenu and, when it is hovered on, the hidden menu element appears:
        </p>

        <pre><code class = "language-markup"><!--
            <nav class="navigation horizontal">
                <ul>
                    <li>
                        <a href="#" class="responsiville-megamenu">Menu 1</a>
                        <ul>
                            <li><a href="#">Menu 1-1</a></li>
                            <li><a href="#">Menu 1-2</a></li>
                            <li><a href="#">Menu 1-3</a></li>
                            <li><a href="#">Menu 1-4</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="responsiville-megamenu">Menu 2</a>
                        <ul>
                            <li><a href="#">Menu 2-1</a></li>
                            <li><a href="#">Menu 2-2</a></li>
                            <li><a href="#">Menu 2-3</a></li>
                            <li><a href="#">Menu 2-4</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="responsiville-megamenu">Menu 3</a>
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
            If nothing else is defined then, by default, the first sibling of the activator element is considered to be the container for the megamenu contents. But it is up the developer to set something else.
        </p>

        <p>
            Here is how one could create a megamenu in a non-automatic way:
        </p>

        <pre><code class = "language-javascript">
            var megamenu = new Responsiville.Megamenu({
                activator : '.responsiville-megamenu',
                element   : '.responsiville-megamenu-element',
                enter     : 'laptop, desktop, large, xlarge',
                leave     : 'small, mobile, tablet'
            });
        </code></pre>



        <h2>Default values</h2>

        <p>
            Here is its full list of settings and default values:
        </p>

        <script type = "text/javascript">
            document.write(
                '<pre><code class = "language-json">' +
                    js_beautify( JSON.stringify( Responsiville.Megamenu.defaults ) ) +
                '</code></pre>'
            );
        </script>



        <h2>Working examples</h2>

        <p>
            Here is a full working example based on the above case:
        </p>

        <style type = "text/css">
            /* A tiny bit of robbery here! */
            .responsiville-megamenu-example {
                margin-bottom: var(--vertical-rhythm);
            }
                .responsiville-megamenu-example ul ul {
                    display: none;
                }
                .responsiville-megamenu-example ul,
                .responsiville-megamenu-example li {
                    padding: 0 ! important;
                    margin: 0  ! important;
                    list-style-type: none;
                    background-color: white;
                }
                .responsiville-megamenu-example li {
                    margin-right: 2rem ! important;
                }
                .responsiville-megamenu-example li li {
                    margin-right: 0 ! important;
                }
                    .responsiville-megamenu-example ul a {
                        padding: 0 ! important;
                        border: none;
                        white-space: nowrap;
                        word-break: keep-all;
                    }
        </style>

        <nav class = "navigation horizontal responsiville-megamenu-example clear">
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
            And here is an example with some bigger elements:
        </p>

        <pre><code class = "language-markup"><!--
            <nav class="navigation horizontal">
                <ul>
                    <li>
                        <a href="#" class="responsiville-megamenu">Menu 1</a>
                    </li>
                    <li>
                        <a href="#" class="responsiville-megamenu">Menu 2</a>
                        <div class="row submenu">
                            <div class="small-column-33">
                                <strong>Title 1</strong> <br />
                                Some text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quia culpa voluptatum optio explicabo dolor, iusto! <br />
                                <a href="#">A link 1</a>
                            </div>
                            <div class="small-column-33">
                                <strong>Title 2</strong> <br />
                                Some text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quia culpa voluptatum optio explicabo dolor, iusto! <br />
                                <a href="#">A link 2</a>
                            </div>
                            <div class="small-column-33">
                                <strong>Title 3</strong> <br />
                                Some text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quia culpa voluptatum optio explicabo dolor. <br />
                                <a href="#">A link 3</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="responsiville-megamenu">Menu 3</a>
                    </li>
                </ul>
            </nav>
        --></code></pre>

        <p>
            Which renders something like this:
        </p>

        <style type = "text/css">
            /* A tiny bit of robbery here! */
            .responsiville-megamenu-example .submenu {
                width: 80rem;
                padding-bottom: 2rem ! important;
                background-color: white;
            }
        </style>

        <nav class = "navigation horizontal responsiville-megamenu-example clear">
            <ul>
                <li>
                    <a href = "#" class = "responsiville-megamenu">Menu 1</a>
                </li>
                <li>
                    <a href = "#" class = "responsiville-megamenu">Menu 2</a>
                    <div class = "row submenu">
                        <div class = "small-column-33">
                            <strong>Title 1</strong> <br />
                            Some text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quia culpa voluptatum optio explicabo dolor, iusto! <br />
                            <a href = "#" title = "">A link 1</a>
                        </div>
                        <div class = "small-column-33">
                            <strong>Title 2</strong> <br />
                            Some text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quia culpa voluptatum optio explicabo dolor, iusto! <br />
                            <a href = "#" title = "">A link 2</a>
                        </div>
                        <div class = "small-column-33">
                            <strong>Title 3</strong> <br />
                            Some text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quia culpa voluptatum optio explicabo dolor. <br />
                            <a href = "#" title = "">A link 3</a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href = "#" class="responsiville-megamenu">Menu 3</a>
                </li>
            </ul>
        </nav>

        <p>
            It is worth noticing that the megamenu module sets special classes on the elements of the megamenu for their states, so that one can control their styling as they see fit. These classes refer to the the activator element, as well as the the actual menu that opens and closes and their states, ie opening, open, closing, closed, active, etc.
        </p>



    </article>



<?php include( 'footer.php' ); ?>