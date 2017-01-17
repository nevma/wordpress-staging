<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsive grid</h1>

        <p>
            The Responsiville grid provides all the facilities, that is elements and classes, for one to create responsive web layouts. As we mentioned in a previous chapter the philosophy by which responsive web design works is <strong>mobile first</strong>. This means that we set our layouts for the narrowest screens possible, the mobile ones, and work our way upwards overriding and enrichening that layout.
        </p>

        <p>
            The responsive web design process requires from the developer to describe the <strong>behaviour</strong> and the rendering of a web page&apos;s layout and elements across all screen sizes that it wants to support and target. Usually, as screens grow, the layout becomes more complicated, while, as we move down to the mobile device screens, the layout tends to be more simplistic. But this is by no means obligatory by the framework. It is up to the developer to define their web page&apos;s responsive behaviour.
        </p>

        <h2>Responsive behaviour</h2>

        <p>
            We already talked briefly about responsive behaviour mentioning that in Responsiville all elements are aware of their state in combination with the current breakpoint of the screen. These breakpoints have human readable names, which correspond to media queries, like <code>small</code>, <code>mobile</code>, <code>tablet</code>, etc.
        </p>

        <p>
            So, in order to fully define any element&apos;s <strong>responsive behaviour mobile first</strong> one has to start from the smallest breakpoint possible, that is the <code>small</code> breakpoint, and override this behaviour in the breakpoints where it is necessary (and only if it is nececssary - no need to declare the same behaviour twice).
        </p>

        <p>
            For example, take a layout where three posts are being placed one next to each other. In a wide-enough screen one could simply put them side by side, each of them taking up an equal third of their content row. And perhaps this layout is also suffucient for tablets as well. However in mobile screens three posts are too many to fit in a row, so, in order to keep things readable, one may choose to make each post take up a whole content row there. This way the layout smoothly responds to the changes of the screen width, without having to fetch a new web page.
        </p>

        <p>
            In order to achieve the above behaviour one has to think in the opposite direction: <strong>mobile first</strong>. This way, starting from the smallest screens possible, the ones at the <code>small</code> breakpoint one would give 100% width to the columns of these posts, but they wouldn&apos;t change anything up until the tablet breakpoint, where they would override the width of the columns of the posts and set it to 33%. This is how this would look in code:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="row">
                <div class="small-column-100 tablet-column-33">
                    <article>
                        ...
                    </article>
                </div>
                <div class="small-column-100 tablet-column-33">
                    <article>
                        ...
                    </article>
                </div>
                <div class="small-column-100 tablet-column-33">
                    <article>
                        ...
                    </article>
                </div>
            </div>
        --></code></pre>

        <p>
            And the result would look like this:
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 tablet-column-33 with-contents" data-info = ".small-column-100 .tablet-column-33">
                    <div class = "the-contents">
                        This column is 33% wide down to the tablet breakpoint and 100% below that.
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 with-contents" data-info = ".small-column-100 .tablet-column-33">
                    <div class = "the-contents">
                        This column is 33% wide down to the tablet breakpoint and 100% below that.
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 with-contents" data-info = ".small-column-100 .tablet-column-33">
                    <div class = "the-contents">
                        This column is 33% wide down to the tablet breakpoint and 100% below that.
                    </div>
                </div>
            </div>
        </div>

        <p>
            You might have to resize you browser window quite a bit in order to see the layout automatically re-arrange itself, or, even better, you could use your browser&apos;s Developer Tools &gt; Responsive Design Mode.
        </p>

        <p>
            It is apparent that the way we think of designs is usually the other way around. We think of big screens first, because we work on them when we design and develop web pages and because we are historically acquainted to them. And this is fine. The mobile first notion refers to the process by which we build our designs: we can think of them top to bottom, but build them bottom to top, ie mobile first.
        </p>



        <h2>A responsive web layout</h2>

        <p>
            Let&apos;s take these ideas to the classic layout example. 
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 with-contents" data-info = ".small-column-100">
                    <div class = "the-contents">
                        The header, always 100% width.
                    </div>
                </div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 laptop-column-25 with-contents" data-info = ".small-column-100 .laptop-column-25">
                    <div class = "the-contents">
                        Sidebar <br />
                        Has a 25% width in big screens down to the laptop breakpoint and then gets a full 100%.
                    </div>
                </div>
                <div class = "small-column-100 laptop-column-75 with-contents" data-info = ".small-column-100 .laptop-column-75">
                    <div class = "the-contents">
                        The content <br />
                        Has a 75% width in big screens and all the way down to the laptop breakpoint and then gets a full 100%, as well as the sidebar. What actually happens is that, in this example, below the laptop breakpoint we practically simplify the layout to full 100% columns.
                    </div>
                    <div class = "row" data-info = ".row">
                        <div class = "small-column-100 laptop-column-50 with-contents" data-info = ".small-column-100 .laptop-column-50">
                            <div class = "the-contents">
                                Has a 50% width in big screens down to the laptop breakpoint and then gets a full 100%.
                            </div>
                        </div>
                        <div class = "small-column-100 laptop-column-50 with-contents" data-info = ".small-column-100 .laptop-column-50">
                            <div class = "the-contents">
                                Has a 50% width in big screens down to the laptop breakpoint and then gets a full 100%.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 with-contents" data-info = ".small-column-100">
                    <div class = "the-contents">
                        The header, always 100% width.
                    </div>
                </div>
            </div>
        </div>

        <p>
            And here is the code for this:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="column-100"></div>
                </div>
                <div class="row">
                    <div class="small-column-100 laptop-column-25"></div>
                    <div class="small-column-100 laptop-column-75"></div>
                </div>
                <div class="row">
                    <div class="column-100">
                        <div class="row">
                            <div class="small-column-100 laptop-column-50"></div>
                            <div class="small-column-100 laptop-column-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        --></code></pre>

        <p>
            It is important to note that this responsive behaviour needs only be declared for the <strong>breakpoints where it is differentiated</strong> and not for all the available breakpoints. Usually it is declared first for the smallest breakpoint and then for each breakpoint where it changes. For instance when a column is declared as <code>small-column-100 laptop-column-33</code> it is implied that for the breakpoints of <code>mobile</code> and <code>laptop</code> the element keeps the same responsive behaviour as in the <code>small</code> breakpoint. So, for those breakpoints in-between nothing else needs to be declared. Similarly, when going above the <code>laptop</code> breakpoint the element keeps the same responsive behaviour and needs not redeclare it.
        </p>

        <p>
            It is possible to declare and re-declare an element&apos;s responsive behaviour in as many breakpoints as one needs. It is up to the developer and the specific needs of each layout they are building whether this makes any (and what kind of) sense. So, the following is actually possible, though bordeline rational:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="small-column-100 mobile-column-33 tablet-column-50 laptop-column-25"></div>
                </div>
            </div>
        --></code></pre>

        <p>
            Of course, it goes without saying that one may use the rows and columns of the grid in their generic namings just as well, without mentioning breakpoints, as long as they know what they are doing. All these elements will still behave as expected, but not in combination to a specific breakpoint.
        </p>



        <h2>Responsive grid elements</h2>

        <p>
            All the elements of the Responsiville grid have responsive behaviour, which means that they can adapt themselves to each breakpoint. In one breakpoint an element can be <code>inline</code> and in another one it can be <code>block</code>. In one breakpoint it can be hidden and in another one it can be visible again. In one breakpoint it can have a margin or float left and in another it can have no margins or float right. Again, the correct combination of properties depend on the specifics of each layout and the developer who implements them.
        </p>

        <p>
            Here are some examples.
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 laptop-inline with-contents" data-info = ".small-column-100 .laptop-inline">
                    <div class = "the-contents">
                        A 100% block up to laptop breakpoint and then inline.
                    </div>
                </div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column small-left laptop-right with-contents" data-info = ".column .small-left .laptop-right">
                    <div class = "the-contents">
                        Floated to the left up to laptop breakpoint and then to the right.
                    </div>
                </div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "column small-hidden laptop-inline with-contents" data-info = ".column .small-hidden .laptop-inline">
                    <div class = "the-contents">
                        Hidden up to the laptop breakpoint and then inline.
                    </div>
                </div>
                <div class = "column small-inline laptop-hidden with-contents" data-info = ".column .small-inline .laptop-hidden">
                    <div class = "the-contents">
                        Inline up to the laptop breakpoint and then hidden.
                    </div>
                </div>
            </div>
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 laptop-column-33 laptop-margin-33 with-contents" data-info = ".small-column-100 .laptop-column-33 .laptop-margin-33">
                    <div class = "the-contents">
                        A 100% up to laptop breakpoint and then 33% with 33% margin.
                    </div>
                </div>
            </div>
        </div>

        <p>
            And the code for this is:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="small-column-100 laptop-inline"></div>
                </div>
                <div class="row">
                    <div class="column small-left laptop-right"></div>
                </div>
                <div class="row">
                    <div class="column small-hidden laptop-inline"></div>
                    <div class="column small-inline laptop-hidden"></div>
                </div>
                <div class="row">
                    <div class="small-column-100 laptop-column-33 laptop-margin-33"></div>
                </div>
            </div>
        --></code></pre>

        <p>
            Note that we do add a generic <code>column</code> class to elements who have no column class so that they will acquire all the expected characteristics of a grid column.
        </p>



        <h2>Push and pull columns</h2>

        <p>
             Pushing and pulling columns refers to automatically rearranging the visual order of columns, as per specific breakpoints, without messing with their order in the DOM. This addresses the need to make a column appear before another column in one breakpoint but switch their order in another breakpoint. This is all done in a CSS-only (no-Javascript) so that we do not have to interfere with the original DOM state of the web page.
        </p>

        <p>
             Watch how the concept grows in a mobile first manner. The columns are naturally arranged in the DOM as A, B and C. Starting from the <code>small</code> breakpoint the columns maintain their natural visual order. In the <code>laptop</code> breakpoint the B column is shifted to the left (pulled) and the A column is shifted to the right (pushed) at the same amount as the B column. This way, from that particular breakpoint and upwards, the A and B columns seem to have switched positions. 
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 laptop-column-33 laptop-push-33 with-contents" data-info = ".small-column-100 .laptop-column-33 .laptop-push-33">
                    <div class = "the-contents">
                        Column A <br /> small 100%, laptop 33% <br /> small 1st, laptop 2nd
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-33 laptop-pull-33 with-contents" data-info = ".small-column-50 .laptop-column-33 .laptop-pull-33">
                    <div class = "the-contents">
                        Column B <br /> small 100%, laptop 33% <br /> small 2nd, laptop 1st
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-33 with-contents" data-info = ".small-column-50 .laptop-column-33">
                    <div class = "the-contents">
                        Column C <br /> small 100%, laptop 33% <br /> small 3rd, laptop 3rd
                    </div>
                </div>
            </div>
        </div>

        <p>
            And the code is:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="small-column-100 laptop-column-33 laptop-push-33"></div>
                    <div class="small-column-50 laptop-column-33 laptop-pull-33"></div>
                    <div class="small-column-50 laptop-column-33"></div>
                </div>
            </div>
        --></code></pre>

        <p>
            Here is an other -a bit- edgy example using push/pull columns (these two columns actually switch their visual places at the laptop breakpoint):
        </p>

        <div class = "grid-showcase">
            <div class = "row" data-info = ".row">
                <div class = "small-column-100 tablet-column-50 tablet-push-50 laptop-push-0 with-contents" data-info = ".small-column-100 .tablet-column-50 .tablet-push-50 .laptop-push-0">
                    <div class = "the-contents">
                        Column A <br /> small 100%, tablet 50% <br /> small 1st, tablet 2nd, laptop 1st
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-50 tablet-pull-50 laptop-pull-0 with-contents" data-info = ".small-column-100 .tablet-column-50 .tablet-pull-50 .laptop-pull-0">
                    <div class = "the-contents">
                        Column B <br /> small 100%, tablet 50% <br /> small 2nd, tablet 1st, laptop 2nd
                    </div>
                </div>
            </div>
        </div>

        <p>
            And the code for this is:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row">
                    <div class="small-column-100 tablet-column-50 tablet-push-50 laptop-push-0"></div>
                    <div class="small-column-100 tablet-column-50 tablet-pull-50 laptop-pull-0"></div>
                </div>
            </div>
        --></code></pre>

        <p>
            Note the usage of <code>laptop-push-0</code> and <code>laptop-pull-0</code> classes, which are used to undo any push/pull behaviour on columns, which have had such behaviour declared on them in previous breakpoints.
        </p>



        <h>Clearing floats</h2>

        <p>
            The Responsiville grid is based on floated columns. Therefore the classic problem of clearing these floats regardless of their heights exists, unless one tackles it. Responsiville defines a way of clearing floated columns no matter what their heights is. The developer is required to declare the way the columns are grouped in their rows in each breakpoint and the framework takes care of clearing them appropriately.
        </p>

        <p>
            In order to do this you have to add one or more special class(es) on the row whose columns need to be cleared. These special classes actually specify how many columns are required in order for a full row of contents to be filled, because these full rows of contets are what is to be cleared (from the next row).
        </p>

        <p>
            Look at the following example, where in the tablet breakpoint the row can fit 3 columns while in the laptop breakpoint it can fit 6 rows. So, the clearing is defined by setting a <code>tablet-group-3</code> and <code>laptop-group-6</code> on the surrounding row:
        </p>

        <div class = "grid-showcase">
            <div class = "row tablet-group-3 laptop-group-6" data-info = ".row">
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis dolorem commodi quae, quibusdam aliquid dolorum!
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus vitae saepe aut veniam deserunt mollitia quos dignissimos atque hic, impedit aliquid, tempora suscipit numquam? Voluptatum!
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur neque vel qui, similique quam quae culpa fuga? Vel, voluptatum fugiat saepe corporis! Fuga odio a est sed itaque, maxime explicabo adipisci incidunt laborum? Ea, perferendis.
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus labore voluptatibus recusandae enim velit optio qui distinctio harum delectus error, ex perferendis et. Tempora minima facere esse voluptate, asperiores saepe odit eveniet quasi beatae eius commodi iusto ea mollitia repellendus, neque est porro iure officia quisquam nesciunt debitis. Eaque ipsam quis sunt, quisquam tempore quaerat?
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus beatae eius temporibus fugit, fugiat. Dolores totam assumenda dolorem officiis, deserunt unde libero odit facere porro soluta vero consequatur quis numquam enim ipsam recusandae architecto iusto error inventore aliquid rem, magnam excepturi commodi. Tempore, perferendis, quibusdam.
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel excepturi sit ad voluptate voluptatibus numquam, earum soluta. Odit sequi aspernatur, sapiente labore nisi maxime incidunt!
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident beatae aspernatur, nisi! Quae deleniti, blanditiis itaque minus, perferendis natus. Nisi expedita adipisci perferendis consequuntur error aperiam, ipsum necessitatibus, maxime nemo, nulla quos dolorum eligendi debitis quasi. Debitis, maxime optio asperiores, animi dolores quia, exercitationem soluta quasi laboriosam aliquam commodi quae aut alias quos saepe adipisci.
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta mollitia expedita explicabo autem. Quo ex, recusandae obcaecati officiis, sapiente laudantium, harum deleniti libero magnam repellat, mollitia similique quam odio? Quo eaque ex voluptatum sit repudiandae pariatur fugit expedita veniam eligendi, quod rerum temporibus similique animi doloribus officia voluptas dicta mollitia, sequi. Nobis tempora id consequatur dignissimos officiis pariatur blanditiis magni, optio quidem, aperiam, delectus eveniet!
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam omnis dignissimos cum et eius incidunt officiis laborum quaerat quod nulla maiores, possimus quae suscipit. Aperiam enim similique repudiandae eligendi autem, itaque incidunt asperiores suscipit quidem atque reprehenderit, blanditiis totam ipsa.
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat officia ea nostrum similique accusantium facere voluptas fuga, voluptate, quaerat praesentium sint nobis reiciendis debitis repellendus!
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem repellendus quibusdam alias rem accusamus, pariatur aut iusto eaque, earum quod quasi itaque perferendis molestias vero a? Non dolores cupiditate est odio rerum laboriosam molestias delectus.
                    </div>
                </div>
                <div class = "small-column-100 tablet-column-33 laptop-column-16 with-contents" data-info = ".small-column-100 .tablet-column-50 .laptop-column-12-5">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque ipsum quasi laboriosam, modi, officia dicta.
                    </div>
                </div>
            </div>
        </div>

        <p>
            And the code for this is:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="container">
                <div class="row tablet-group-3 laptop-group-6">
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                    <div class="small-column-100 tablet-column-33 laptop-column-16"></div>
                </div>
            </div>
        --></code></pre>

        <p>
            Grouping classes are available for all numbers of rows that make sense in Responsiville, that is divide the grid in columns: 0, 1, 2, 3, 4, 5, 6, 8, 10 and 20.
        </p>

        <p>
            Note that it is up to you, the developer, to declare the correct groupings for your columns, when you know you need to clear them. It is impossible for the grid to guess how the grouping should work, especially if the columns combine a variety of responsive behaviours.
        </p>



    </article>



<?php include( 'footer.php' ); ?>