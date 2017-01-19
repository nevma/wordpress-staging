<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>The grid</h1>

        <p>
            Responsiville defines an HTML/CSS grid for building web page layouts. As mentioned in the previous section, the main breakpoints in which Responsiville divides screen sizes are <code>small</code>, <code>mobile</code>, <code>tablet</code>, <code>laptop</code>, <code>desktop</code>, <code>large</code>, <code>xlarge</code> and they provide code names for separating screen sizes to ranges of 0-320-600-1024-1280-1440-1600 pixels.
        </p>

        <p>
            These breakpoint names are meant to provide a human readable alternative to media queries, so, in order to target devices with a screen size between 321 and 600 pixels, which refers to most mobile phones, one would change from writing this:
        </p>

        <pre><code class = "language-css">
            /* One has to remember the media query syntax and the measurements. */
            @media (min-width: 321px) and (max-width: 600px) {
                .element {
                    padding: 2rem;
                }
            }
        </code></pre>

        <p>
            To writing this instead:
        </p>

        <pre><code class = "language-css">
            /* One simply has to remember the screen size they want to target. */
            .mobile .element {
                padding: 2rem;
            }
        </code></pre>

        <p>
            The Responsiville framework is responsible to add the class <code>mobile</code> to the HTML element of the web page when the screen size is between 321 and 600 pixels. It is also responsible for updating this class if and when the screen changes ie the mobile phone or tablet orientation changes or the browser window is resized. Then the developer can use this class in order to target each element to each breakpoint.
        </p>



        <h2>Mobile first</h2>

        <p>
            Remember that Responsiville is mobile first. In order to keep up with that idea the framework stacks up all the breakpoint classes inside the HTML element. So, when the browser window is at the <code>laptop</code> breakpoint the HTML element has a class attribute which contains not only the name of that particular breakpoint, but also of all smaller breakpoints in a mobile first order. For instance:
        </p>

        <pre><code class = "language-markup"><!--
            <html class="small mobile tablet laptop">
        --></code></pre>

        <p>
            So, along with the breakpoint classes added to the HTML element the developer CSS rules also stack up and cascade upwards starting from the smallest breakpoint up to the current one. In the above example the code all the CSS rules that are specified by <code>.small</code>, <code>.mobile</code>, <code>tablet</code> and <code>laptop</code> are all in effect at the same time and the cascade and inheritance of them has a mobile first direction. 
        </p>

        <p>
            This means that if an element has a CSS rule defined, for instance, in the <code>mobile</code> breakpoint and the same rule with a a different value in the <code>laptop</code> breakpoint and the browser is currently at the <code>laptop</code> breakpoint, then the rule at the <code>laptop</code> breakpoint prevails.
        </p>

        <pre><code class = "language-css">
            /* If we are currently in the "laptop" breakpoint. */
            .mobile .element {
                padding: 2rem;
            }

            /* Then this CSS rule for the element padding prevails. */
            .laptop .element {
                padding: 3rem;
            }

            /* But this rule is ignored for now. */
            .desktop .element {
                padding: 4rem;
            }
        </code></pre>

        <p>
            These breakpoint names are what defines the world of Responsiville, be it HTML elements, CSS rules or Javascript modules. One needs to know these by heart, in order to be able to comprehend how everything works from here and on.
        </p>



        <h2>Grid columns</h2>

        <p>
            The Responsiville grid is divided in simple columns. The columns are measured in measurements that refer mainly to percentages. One can either refer to these measurements as percentages like <code>33%</code>, or even as simple everyday fractions, like <code>one third</code> or <code>1/3</code>, etc. Each grid row is has a 100 units that can be divided in halves, thirds, quarters, fifths, sixths, eighths, tenths and twentieths. This is actually quite simple in practice. 
        </p>

        <p>
            Here the possible number of columns that can divide your grid in Responsiville:
        </p>

        <table class = "text-center">
            <thead>
                <tr>
                    <th>columns row</th>
                    <th>percentage of row</th>
                    <th>fraction</th>
                    <th>examples</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>100%</td>
                    <td>1/1</td>
                    <td>
                        <code>.column-100</code> <br />
                        <code>.column-1-1</code>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>50%</td>
                    <td>
                        1/2 <br />
                        half
                    </td>
                    <td>
                        <code>.column-50</code> <br />
                        <code>.column-1-2</code> <br />
                        <code>.column-2-4</code> <br />
                        <code>.column-3-6</code> <br />
                        <code>.column-4-8</code> <br />
                        <code>.column-5-10</code> <br />
                        <code>.column-10-20</code>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>33%</td>
                    <td>
                        1/3 <br />
                        one third
                    </td>
                    <td>
                        <code>.column-33</code> <br />
                        <code>.column-1-3</code> <br />
                        <code>.column-2-6</code>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>25%</td>
                    <td>
                        1/4 <br />
                        one quarter
                    </td>
                    <td>
                        <code>.column-25</code> <br />
                        <code>.column-1-4</code> <br />
                        <code>.column-2-8</code> <br />
                        <code>.column-5-20</code>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>20%</td>
                    <td>
                        1/5 <br />
                        one fifth
                    </td>
                    <td>
                        <code>.column-20</code> <br />
                        <code>.column-1-5</code> <br />
                        <code>.column-2-10</code> <br />
                        <code>.column-4-20</code>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>16.666%</td>
                    <td>
                        1-6 <br />
                        one sixth
                    </td>
                    <td>
                        <code>.column-16</code> <br />
                        <code>.column-1-6</code>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>12.5%</td>
                    <td>
                        1-8 <br />
                        one eighth
                    </td>
                    <td>
                        <code>.column-12-5</code> <br />
                        <code>.column-1-8</code>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>10%</td>
                    <td>
                        1-10 <br />
                        one tenth
                    </td>
                    <td>
                        <code>.column-10</code> <br />
                        <code>.column-1-10</code> <br />
                        <code>.column-2-20</code>
                    </td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>5</td>
                    <td>
                        1-20 <br />
                        one twentieth
                    </td>
                    <td>
                        <code>.column-5</code> <br />
                        <code>.column-1-20</code>
                    </td>
                </tr>
            </tbody>
        </table>

        <p>
            Also, one might combine the above in all their <strong>multiples</strong> and <strong>add them up</strong> in order to create full 100% length grid rows of content.
        </p>

        <p>
            So, for instance, in the 20 column grid, one can use any of the following: 
        </p>

        <ul>
            <li><code>.column-5</code>, <code>.column-1-20</code></li>
            <li><code>.column-10</code>, <code>.column-2-20</code></li>
            <li><code>.column-15</code>, <code>.column-3-20</code></li>
            <li><code>.column-20</code>, <code>.column-4-20</code>
            <li><code>.column-25</code>, <code>.column-5-20</code></li>
            <li><code>.column-30</code>, <code>.column-6-20</code></li>
            <li><code>.column-35</code>, <code>.column-7-20</code></li>
            <li><code>.column-40</code>, <code>.column-8-20</code></li>
            <li><code>.column-45</code>, <code>.column-9-20</code></li>
            <li><code>.column-50</code>, <code>.column-10-20</code></li>
            <li><code>.column-55</code>, <code>.column-11-20</code></li>
            <li><code>.column-60</code>, <code>.column-12-20</code></li>
            <li><code>.column-65</code>, <code>.column-13-20</code></li>
            <li><code>.column-70</code>, <code>.column-14-20</code></li>
            <li><code>.column-75</code>, <code>.column-15-20</code></li>
            <li><code>.column-80</code>, <code>.column-16-20</code></li>
            <li><code>.column-85</code>, <code>.column-17-20</code></li>
            <li><code>.column-90</code>, <code>.column-18-20</code></li>
            <li><code>.column-95</code>, <code>.column-19-20</code></li>
            <li><code>.column-100</code>, <code>.column-20-20</code></li>
        </ul>

        <p>
            Using the same logic, for instance in the 10 column grid, one can use any of the following: 
        </p>

        <ul>
            <li><code>.column-10</code>, <code>.column-1-10</code></li>
            <li><code>.column-20</code>, <code>.column-2-10</code></li>
            <li><code>.column-30</code>, <code>.column-3-10</code></li>
            <li><code>.column-40</code>, <code>.column-4-10</code></li>
            <li><code>.column-50</code>, <code>.column-5-10</code></li>
            <li><code>.column-60</code>, <code>.column-6-10</code></li>
            <li><code>.column-70</code>, <code>.column-7-10</code></li>
            <li><code>.column-80</code>, <code>.column-8-10</code></li>
            <li><code>.column-90</code>, <code>.column-9-10</code></li>
            <li><code>.column-100</code>, <code>.column-10-10</code></li>
        </ul>

        <p>
            In the same way, in the 4 column grid, one can use any of the following:
        </p>

        <ul>
            <li><code>.column-25</code>, <code>.column-1-4</code></li>
            <li><code>.column-50</code>, <code>.column-2-4</code></li>
            <li><code>.column-75</code>, <code>.column-3-4</code></li>
            <li><code>.column-100</code>, <code>.column-4-4</code></li>
        </ul>

        <p>
            And so on for all the 20-10-8-6-5-4-3-2 columns.
        </p>

        <p>
            Obviously, <code>.column-100</code> is common for all grid divisions.
        </p>

        <p>
            Of course, there are a lot of equivalent values. For instance:
        </p>

        <pre><code class = "language-markup"><!--
            .column-3-5 == .column-6-10 == .column-12-20 == .column-60
            .column-2-4 == .column-3-6  == .column-4-8   == .column-50
            .column-1-3 == .column-2-6  == .column-3-6   == .column-33
            ...
        --></code></pre>

        <p>
            Also one can -and should- mix up the columns so that, for instance 2 x <strong>1/4</strong> columns can be put side by side with 1 x <strong>1/2</strong> column in order to fill a whole grid content row:
        </p>

        <pre><code class = "language-markup"><!--
            .column-25  + .column-25 + .column-50  = .column-100
            .column-1-8 + .column-50 + .column-3-8 = .column-100
            .column-1-4 + .column-25 + .column-3-6 = .column-100 // Why would you do that, though?
            ...
        --></code></pre>



        <h2>Responsive columns</h2>

        <p>
            The grid re-defines all its column classes for each of the default available breakpoints. So, when these classes are used in a mobile-first manner one can accomplish a responsive layout by overriding declarations, starting from the smallest screens and working their way up to the bigger ones. Let&apos;s see some examples. 
        </p>

        <p>
            For a grid divided in fifths the developer can use the following generic classes:
        </p>

        <pre><code class = "language-markup"><!--
            .column-1-5 or .column-20
            .column-2-5 or .column-40
            .column-3-5 or .column-60
            .column-4-5 or .column-80
        --></code></pre>

        <p>
            But these classes are available for any breakpoint:
        </p>

        <pre><code class = "language-markup"><!--
            small
            
            .small-column-1-5 or .small-column-20
            .small-column-2-5 or .small-column-40
            .small-column-3-5 or .small-column-60
            .small-column-4-5 or .small-column-80
            .small-column-5-5 or .small-column-100

            mobile

            .mobile-column-1-5 or .mobile-column-20
            .mobile-column-2-5 or .mobile-column-40
            .mobile-column-3-5 or .mobile-column-60
            .mobile-column-4-5 or .mobile-column-80
            .mobile-column-5-5 or .mobile-column-100

            tablet

            .tablet-column-1-5 or .tablet-column-20
            .tablet-column-2-5 or .tablet-column-40
            .tablet-column-3-5 or .tablet-column-60
            .tablet-column-4-5 or .tablet-column-80
            .tablet-column-5-5 or .tablet-column-100

            etc
        --></code></pre>

        <p>
            One can use any of them they want on any given element and these classes will all stack up in a mobile first order, so that the one that belongs to the current breakpoint will prevail. For instance, if our screen waw currently in the <code>tablet</code> breakpoint:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="small-column-100 tablet-column-50 laptop-column-33">

                In the tablet breakpoint this element has a width of 50% of its parent. 

                When the browser viewport grows to the the laptop breakpoint the element will take up 33% of its parent width. 

                When the browser viewport shrinks to the small breakpoint the element will take up 100% of its parent width.

            </div>
        --></code></pre>



        <h2>Grid gutters</h2>

        <p>
            What also defines a grid are its gutters, that is the margins between its columns. The gutters define how dense a grid is. In Responsiville the grid gutters are inside each column as CSS paddings. Here is an example of a row of columns. Notice that the columns, the ones with the dotted border around them, contain the gutters inside them. The gray box inside each column represents its contents.
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-50" data-info = ".column-50"></div>
                <div class = "column-50" data-info = ".column-50"></div>
            </div>
        </div>

        <p>
            Note that this is <strong>not a real rendering</strong> if the grid. In reality the grid <strong>takes care of aligning its contents vertically</strong> along with the rest of the content. The above depiction is shown here as an example. Here is the code for the above grid.
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="column-25">...</div>
                    <div class="column-25">...</div>
                    <div class="column-25">...</div>
                    <div class="column-25">...</div>
                </div>
                <div class="row">
                    <div class="column-50">...</div>
                    <div class="column-50">...</div>
                </div>
            </div>
        --></code></pre>

        <h2>The nexus</h2>

        <p>
            It is also possible to disable all grid gutters, when necessary, in order to create a tight grid and use all the space inside the columns. We call this grid a <strong>nexus</strong> and we define it by setting a <code>nexus</code> class in the container like this.
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container nexus">
                <div class="row">
                    <div class="column-25">...</div>
                    <div class="column-25">...</div>
                    <div class="column-25">...</div>
                    <div class="column-25">...</div>
                </div>
                <div class="row">
                    <div class="column-50">...</div>
                    <div class="column-50">...</div>
                </div>
            </div>
        --></code></pre>

        <p>
            Note how this produces a grid with no horizontal breathing space between columns.
        </p>

        <div class = "grid-showcase nexus">
            <div class = "row" data-info = ".row">
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-50" data-info = ".column-50"></div>
                <div class = "column-50" data-info = ".column-50"></div>
            </div>
        </div>



        <h2>Nesting columns</h2>

        <p>
            As we mentioned before, nesting columns causes their gutters to add up. This happens because columns contain their columns inside them so, if one simply puts a column inside another column, then the internal column will appear to have double the usual gutters. And if one puts another column inside the internal column, then that column will appear to have triple the usual columns.
        </p>

        <p>
            Of course, if you know what you are doing, you may nest columns any way you like, but if you  want your grid to trully align its contents vertically throughout the page, then you must wrap your columns again into rows. What rows do is cancel the gutters of columns by adding equal negative margins to the grid. For instance:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container nexus">
                <div class="row">
                    <div class="column-50">...</div>
                    <div class="column-50">...</div>
                </div>
                <div class="row">
                    <div class="column-50">...</div>
                    <div class="column-50">
                        <div class="row">
                            <div class="column-33">...</div>
                            <div class="column-33">...</div>
                            <div class="column-33">...</div>
                        </div>
                    </div>
                </div>
            </div>
        --></code></pre>



        <h2>Grid margins</h2>

        <p>
            A row of content does not need to be taken up exclusively by columns. The grid columns may have margins between them to fulfil the purposes of their design. Margins are empty columns always considered on the left side of the column they are declared on. For instance:
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "column-25 margin-25" data-info = ".column-25 .margin-25"></div>
                <div class = "column-25 margin-25" data-info = ".column-25 .margin-25"></div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-33 margin-33" data-info = ".column-33 .margin-33"></div>
            </div>
        </div>

        <p>
            And this is the code that creates it:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="column-25 margin-25">...</div>
                    <div class="column-25 margin-25">...</div>
                </div>
                <div class="row">
                    <div class="column-33 margin-33">...</div>
                </div>
            </div>
        --></code></pre>

        <p>
            Margins follow the exact same ideas as columns. They are available as fractions of a 100% exactly like columns and there are versions of them available for all breakpoints, so that the developer can mix and match them at will.
        </p>



    </article>



<?php include( 'footer.php' ); ?>