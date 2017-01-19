<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>CSS variables</h1>

        <p>
            The Responsiville framework uses <a href = "http://devdocs.io/css/using_css_variables">CSS variables</a> extensively. CSS variables and, along with them, the <code>calc</code> CSS function are a way of defining values for CSS properties in a totally dynamic and responsive way. They have nothing to do with CSS preprocessors. They are pure CSS awesomeness. In short, this is how you use them:
        </p>

        <pre><code class = "language-css">
            :root {
                --base-font-size: 10px;
            }

            body {
                padding: calc(2*var(--base-font-size));
            }

            .tablet body {
                --base-font-size: 12px;
            }

            .laptop body {
                --base-font-size: 14px;
            }

            header {
                margin: calc(5*var(--base-font-size));
            }
        </code></pre>



        <h2>Responsiville&apos;s CSS variables</h2>

        <p>
            These are the CSS variables defined by Responsiville. You are advised to set them to the values you need as a first thing in your CSS and then override them accordingly, if and where you need it, in your breakpoints.
        </p>

        <pre><code class = "language-css">
            :root {
                --font-scale              : 1.2;     /* How the headings font size scales up. */
                --root-font-size          : 10px;    /* The root element, ie HTML, font size. */
                --base-font-size          : 1.6rem;  /* The body element base font size. */
                --base-line-height        : 1.5;     /* The default line height of all elements. */
                --text-line-height        : 1.75;    /* The line height of block text elements. */
                --heading-line-height     : 1.2;     /* The line height of heading elements. */
                
                --text-rhythm             : 3rem;    /* Vertical margins between text elements. */
                --grid-gutter             : 1rem;    /* Paddings between columns, the grid gutters. */
                --vertical-rhythm         : 5rem;    /* Vertical margins between major grid sections. */
                
                --panel-width             : 1024px;  /* The max width of the panel element. */

                --color-text              : #3c3c3c; /* The colour of the text.*/
                --color-text-selection    : #fafafa; /* The colour of the selected text.*/
                --color-text-selection-bg : #646464; /* The colour of the selected text background.*/
            }
        </code></pre>

        <p>
            Let&apos;s see them one by one:
        </p>

        <dl>
            <dt>--font-scale</dt>
            <dd>
                The default way in which headings scale in Responsiville is by multiplying the font size by a factor for each heading level with th previous one. This is that factor. You are free to changes this logic at will.
            </dd>
            <dt>--root-font-size</dt>
            <dd>
                The font size of the HTML (:root) element. We prefer to let this at <code>10px</code> as a default, so that we can have a nice base for our calculations and we use it extensively with <code>rem</code> units.
            </dd>
            <dt>--base-font-size</dt>
            <dd>
                The font size of the BODY element. Useful for setting a general rhythm for the zoom level of our web page. As you shift from one breakpoint to another, you may change its value and the less changes you need to make to your design, after this one, the better.
            </dd>
            <dt>--base-line-height</dt>
            <dd>
                The default line height of all our HTML elements. It is important to set it to some level that we control because it affects our vertical rhythm. Note that there is a different base line height for content that is text-heavy and needs typographic enhancements (see below).
            </dd>
            <dt>--text-line-height</dt>
            <dd>
                The line height of elements which are text-heavy and need all the typographic goodies we can give them. We denote them with the <code>.text</code> class.
            </dd>
            <dt>--heading-line-height</dt>
            <dd>
                The line height of heading elements, because they need their own special line height, althought they are important typographic elements themselves.
            </dd>
            <dt>--text-rhythm</dt>
            <dd>
                The way the <code>.text</code> elements flow vertically. The vertical magins between block level elements of text.
            </dd>
            <dt>--grid-gutter</dt>
            <dd>
                The horizontal margin between the columns of the grid. Remember that grid columns have their gutters inside them!
            </dd>
            <dt>--vertical-rhytm</dt>
            <dd>
                An optional CSS variable, that we encourage you to use in order to keep a consistent vertical rhythm between the major sections of your grid.
            </dd>
            <dt>--panel-width</dt>
            <dd>
                The maximum width of the <code>.panel</code> element -if you are using it- which is used to keep a general maximum width for your contents, even in very wide screens. Also optional.
            </dd>
            <dt>--color-text</dt>
            <dd>
                The default colour for all text elements of your web page.
            </dd>
            <dt>--color-text-selection</dt>
            <dd>
                The colour of the text when the user has selected it for copying and pasting.
            </dd>
            <dt>--color-text-selection-bg</dt>
            <dd>
                The colour of the background of the text when the user has selected it for copying and pasting.
            </dd>
        </dl>



        <h2>Internet Explorer</h2>

        <p>
            Unfortunately Internet Explorer does not yet support CSS variables, not even the Edge (current version 14). Thankfully we have added a bit of custom code, based on the <a href = "http://www.brothercake.com/site/resources/scripts/cssutilities/">CSSUtilities</a> Javascript library, which transforms the CSS variables that one uses to their actual values for all versions of Internet Explorer. There is one important detail though: <strong>the script can only detect CSS variables declared on the HTML (:root) element</strong>.
        </p>

        <p>
            This code runs on each breakpoint change of the web page, based on the responsive behaviour of the Responsiville framework, and re-calculates the values of CSS variables each time anew.
        </p>



        <h2>Rems, ems, calc, vw, vh, vmin, vmax</h2>

        <p>
            Responsiville encourages you to use these CSS facilities as much as possible, in order to create dynamic, elastic and responsive web designs. <strong>Rems</strong> (and <strong>ems</strong>) are great for specifying measurements that refer to one single and cental point of reference for your web page: the HTML (:roor) element or the current element&apos;s parent element.
        </p>

        <p>
            The CSS <strong>calc</strong> functions allows you to have dynamic, calculated CSS numeric values and also mix numbers with percentages, pixels, <code>ems</code>, <code>rems</code> and css variables. It is also very widely supported by modern web browsers even in mobile devices.
        </p>

        <p>
            Units referring to the viewport of the browser (thus the screen size) are also very helpful in certain cases. Viewport height <strong>vh</strong> is 1% of the height of the viewport, viewport width <strong>vw</strong> is 1% of the widht of the viewport, the max between the two is <strong>vmin</strong> and the min between the two is <strong>vmin</strong>. They can help you refer to the screen size in CSS, without the need for Javascript.
        </p>

        <pre><code class = "language-css">
            /* A bit crazy but shows the potential. */
            .element {
                font-size: calc(2*var(--base-font-size));
                width: calc(50vw - 5rem - 5vh - 5*var(--vertical-rhythm));
            }
        </code></pre>



    </article>



<?php include( 'footer.php' ); ?>