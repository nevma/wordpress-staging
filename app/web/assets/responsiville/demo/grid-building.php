<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Grid building</h1>

        <p>
            The building components of a grid in Responsiville are: containers, rows, panels,and columns. Columns have a lot of variations to them to satisfy all kinds of possible layouts. But the main idea is that your content should lie inside columns. Columns are your blocks of content. Let&apos; start with an example and note how the grid automatically takes care of vertically aligning the edges of all columns inside it:
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "column-100" data-info = ".column-100"></div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-50" data-info = ".column-50"></div>
                <div class = "column-50" data-info = ".column-50"></div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-50" data-info = ".column-50"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-50" data-info = ".column-50"></div>
                <div class = "column-50" data-info = ".column-50"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
                <div class = "column-25" data-info = ".column-25"></div>
            </div>
        </div>

        <p>
            And the code for this is:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="column-100"></div>
                </div>
                <div class="row">
                    <div class="column-50"></div>
                    <div class="column-50"></div>
                </div>
                <div class="row">
                    <div class="column-25"></div>
                    <div class="column-25"></div>
                    <div class="column-25"></div>
                    <div class="column-25"></div>
                </div>
                <div class="row">
                    <div class="column-25"></div>
                    <div class="column-50"></div>
                    <div class="column-25"></div>
                    <div class="column-50"></div>
                    <div class="column-50"></div>
                    <div class="column-25"></div>
                    <div class="column-25"></div>
                    <div class="column-25"></div>
                    <div class="column-25"></div>
                </div>
            </div>
        --></code></pre>

        <p>
            Note that it is up to you to decide how you are going to fill rows with columns. You may add a new <code>.row</code> for each set of columns that completes a 100% of row contents, or you can put multiple rows of content in any one <code>.row</code>. This depends on your needs, your layout, your design and, ultimately, your imagination.
        </p>



        <h2>Rows, panels and columns</h2>

        <p>
            In the example above all you see actually <strong>rows</strong> and <strong>columns</strong>. What about containers and panels? Well they are optional, but they help a lot when you need them. The general architecture hierarchy of the grid goes like this:
        </p>

        <dl>
            <dt>container (optional)</dt>
            <dd>
                A general structural element that contains other elements. Usually used for the general layout. Apart from logically separating the layout, it poses a clearfix on its contents. It is optional in the sense that you do not have to use the framework&apos;s containers, you may use your own, as long as you know what you are doing.
            </dd>
            <dt>row</dt>
            <dd>
                A very important structural element of the grid. It defines a row of content. Logically, a row of content is a set of columns (that may visually take up more than one rows of content - after all screen widths vary a lot). Structurally, it makes sure that the gutters of the columns do not add up when nesting them inside one another and the grid remains vertically aligned. 
            </dd>
            <dt>panel (optional)</dt>
            <dd>
                By convention does nothing more than apply a maximum width to the contents -usually- of a row. With a panel you have a uniform way to restrict your contents to specific widths for each breakpoint.
            </dd>
            <dt>column(s)</dt>
            <dd>
                They are the building blocks of the grid. They are put next to each other, inside rows, like the cells of a table. They contain gutters for your design to allow for breathing space, so be careful when nesting them. You are not obliged to put them inside rows, but doing so helps maintain the design&apos;s overall vertical alignment.
            </dd>
        </dl>

        <p>
            This hierarchy reads something like this: you usually divide your layout in general containers, inside which you have rows of content, which you put in columns, but sometimes you need to constrain your content to a certain maximum width, so then you first put it (ie the columns which contain the content) inside panels and them inside rows.
        </p>

        <p>
            So it could be:
        </p>

        <pre><code class = "language-markup"><!--
            .container >
                .row > 
                    .panel >
                        .column(s)

            or

            .row > 
                .panel >
                    .column(s)

            or

            .row > 
                .column(s)
        --></code></pre>

        <p>
            So, in reality only columns are absolutely necessary for one to define a grid. Panels can be useful to constrain the maximum width of the content. Rows are necessary, too, if the grid needs to vertically align its contents - and this is a very common case in responsive web design. Containers are a nice-to-have addition for logical and clearing purposes.
        </p>



        <h2>A classic layout example</h2>

        <p>
            Let&apos;s create the classic layout that consists of a header, a footer, a sidebar and the contents.
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "column-100 with-contents" data-info = ".column-100">
                    <div class = "the-contents">
                        A header
                    </div>
                </div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-25 with-contents" data-info = ".column-25">
                    <div class = "the-contents">
                        Sidebar <br />
                        - Lorem ipsum <br />
                        - Architecto asperiores <br />
                        - Unde, voluptente <br />
                        - Mollitia dolores <br />
                        - Repellat earum <br />
                    </div>
                </div>
                <div class = "column-75 with-contents" data-info = ".column-75">
                    <div class = "the-contents">
                        This is a title <br /><br />
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quod illo in, minima quasi adipisci beatae eligendi, ipsum labore, quo a, praesentium? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto tempore blanditiis quod expedita incidunt fugit! <br /><br />
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab vitae, aut similique cupiditate ipsum ratione facere dolores nesciunt earum optio, magnam magni culpa quis laudantium rem accusantium officia sunt atque! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, dolorum?
                    </div>
                    <div class = "row" data-info = ".row">
                        <div class = "column-50 with-contents" data-info = ".column-50">
                            <div class = "the-contents">A nested column</div>
                        </div>
                        <div class = "column-50 with-contents" data-info = ".column-50">
                            <div class = "the-contents">A nested column</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column-100 with-contents" data-info = ".column-100">
                    <div class = "the-contents">
                        This is the footer of the page
                    </div>
                </div>
            </div>
        </div>

        <p>
            Note that we did not use a <code>.panel</code> here because we did not need to constrain the width of our contents to anything different than the natural width of each container.
        </p>

        <p>
            And the code for this layout is simply:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="column-100"></div>
                </div>
                <div class="row">
                    <div class="column-25"></div>
                    <div class="column-75"></div>
                </div>
                <div class="row">
                    <div class="column-100">
                        <div class="row">
                            <div class="column-50"></div>
                            <div class="column-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        --></code></pre>



        <h2>Useful grid elements</h2>

        <p>
            The Responsiville grid defines some useful grid elements, which you can use as <strong>classes</strong> on your columns, or even on any other element of your page:
        </p>

        <dl>
            <dt>inline</dt>
            <dd>
                Makes an element have an inline-block layout, if it supposedly had a block layout before. It is available as a different class in all breakpoints like <code>.small-inline</code>, <code>.mobile-inline</code>, etc, so that you can override it or use it to override other elements.
            </dd>
            <dt>block</dt>
            <dd>
                Makes an element have an block layout, if it supposedly had an inline layout before. It is available as a different class in all breakpoints like <code>.small-block</code>, <code>.mobile-block</code>, etc, so that you can override it or use it to override other elements.
            </dd>
            <dt>hidden</dt>
            <dd>
                Hides an element and removes it from the flow. In order to show it back you can use the <code>.block</code> here as well. It is available as a different class in all breakpoints like <code>.small-hidden</code>, <code>.mobile-hidden</code>, etc, so that you can override it or use it to override other elements.
            </dd>
            <dt>center</dt>
            <dd>
                Centers an element inside its container. This is not a magic class, it is intended to be used on columns which live inside rows, provided that the rest of the layout does not actively hinder the center alignment. It is available as a different class in all breakpoints like <code>.small-center</code>, <code>.mobile-center</code>, etc.
            </dd>
            <dt>right</dt>
            <dd> 
                Floats an element on the right. It is available as a different class in all breakpoints like <code>.small-right</code>, <code>.mobile-right</code>, etc, so that you can override it or use it to override other elements.
            </dd>
            <dt>left</dt>
            <dd>
                Floats an element on the left. It is available as a different class in all breakpoints like <code>.small-left</code>, <code>.mobile-left</code>, etc, so that you can override it or use it to override other elements.
            </dd>
            <dt>clear</dt>
            <dd>
                Clears the element from floats, a clearfix.
            </dd>
        </dl>

        <p>
            Note that many of the above elements may be used to override each other. An inline element can override a block element and vice versa. An inline or block element can override a floated left or right element and vice versa. A hidden element can override an inline or block or floated left or right element and vice versa. And, of course, all these can be done in any combination of breakpoints in order to achieve different layout rendering for different screens.
        </p>



    </article>


<?php include( 'footer.php' ); ?>