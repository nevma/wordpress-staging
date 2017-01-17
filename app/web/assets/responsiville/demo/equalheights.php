<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Equalheights</h1>

        <p>
            This is not exactly a Responsiville module per se. It is more of a functionality/behaviour that can be exerted on a set of elements. As it name suggests, what this module does is to make the set of elements <strong>gain the same height</strong> automatically, based on the tallest of them all. This module can be enabled and disabled on the breakpoints that you specify, so that the elements can get their natural heights wherever necessary. Also, when enabled, the modules re-runs whenever needed (ie on breakpoint changes, on window resizes, etc), so that the <strong>heights of the elements are re-calculated</strong>.
        </p>

        <p>
            Here is an example, where a container is marked with the class <code>responsiville-equalheights</code>, so by default its <strong>direct children</strong> are automatically made equalheights containers:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="row responsiville-equalheights"

                 data-responsiville-equalheights-enter="laptop, desktop, large, xlarge"
                 data-responsiville-equalheights-leave="tablet, mobile, small">

                <div class="small-column-50 laptop-column-33">...</div>
                <div class="small-column-50 laptop-column-33">...</div>
                <div class="small-column-100 laptop-column-33">...</div>

                <div class="small-column-50 laptop-column-33">...</div>
                <div class="small-column-50 laptop-column-33">...</div>
                <div class="small-column-100 laptop-column-33">...</div>

            </div>
        --></code></pre>

        <p>
            If one wants to specify exactly which children of the main container will become equalheights they can mark them with the class <code>responsiville-equalheights-element</code> like this:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="row responsiville-equalheights"

                 data-responsiville-equalheights-element="make-eq-h"
                 data-responsiville-equalheights-enter="laptop, desktop, large, xlarge"
                 data-responsiville-equalheights-leave="tablet, mobile, small">

                <div class="small-column-50 laptop-column-33 make-eq-h">...</div>
                <div class="small-column-50 laptop-column-33 make-eq-h">...</div>
                <div class="small-column-100 laptop-column-33 make-eq-h">...</div>

                <div class="small-column-50 laptop-column-33">...</div>
                <div class="small-column-50 laptop-column-33">...</div>
                <div class="small-column-100 laptop-column-33">...</div>

                <div class="small-column-50 laptop-column-25">...</div>
                <div class="small-column-50 laptop-column-25">...</div>
                <div class="small-column-50 laptop-column-25">...</div>
                <div class="small-column-50 laptop-column-25">...</div>

                <div class="small-column-50">...</div>
                <div class="small-column-50">...</div>

            </div>
        --></code></pre>



        <h2>Automatic row detection</h2>

        <p>
            The equalheights module automatically detects which of the spcified elements need to be grouped together in order to gain equal heights with each other. For instance, in the first example, in the <code>laptop</code> breakpoint, you have six 33% wide columns. These columns obviously form <strong>2 content rows</strong>, each of them having <strong>3x33% columns</strong>. When these columns are made equalheights, they must be grouped in groups of 3. The first 3 columns need to be made equalheights to each other and the next 3 columns need to be made equalheights to each other as well. But the six columns altogether must not be mixed up.
        </p>

        <p>
            Similarly, in the <code>small</code> breakpoint the first 2 columns, which are 50% wide, form a full row of contents, then the 3rd column fills a row of contents on its own, then the next 2 columns, which are 50% wide as well, form another full row of contents and then, the last, row fills another row on its own. The equalheights module makes sure that it detects these rows of contents, so that, in the <code>small</code> breakpoint it groups the first 2 columns together, then the 3rd on its own, then the 4th and 5th column together and then the last column on its own.
        </p>

        <p>
            And, of course, all these re-calculations are made automatically.
        </p>

        <p>
            Here is how one could create an equalheights module on their own:
        </p>

        <pre><code class = "language-javascript">
            var equalheights = new Responsiville.Equalheights({
                container : 'responsiville-equalheights',
                elements  : 'responsiville-equalheights-element',
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
                    js_beautify( JSON.stringify( Responsiville.Equalheights.defaults ) ) +
                '</code></pre>'
            );
        </script>



        <h2>Working example</h2>

        <p>
            Here is a full working example based on the above case:
        </p>

        <div class = "grid-showcase">
            <div class = "row responsiville-equalheights"
                 data-responsiville-equalheights-children=".the-contents" 
                 data-info = ".row .responsiville-equalheights">

                <div class = "small-column-50 laptop-column-33 with-contents" data-info = ".small-column-50 .laptop-column-33">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum ab cumque veniam nisi nihil at quaerat. Totam tempora quo magni commodi ipsa. Alias ducimus, aut.
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-33 with-contents" data-info = ".small-column-50 .laptop-column-33">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem nesciunt amet explicabo odit voluptatem qui eaque dolore, voluptas soluta voluptate porro quidem quod sint, tempore, repellat libero enim recusandae cumque, animi omnis a ipsa dicta.
                    </div>
                </div>
                <div class = "small-column-100 laptop-column-33 with-contents" data-info = ".small-column-100 .laptop-column-33">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure earum deleniti explicabo repudiandae magnam dolorum molestiae. Et dolorem explicabo temporibus nostrum molestiae eaque officiis non quod nam quidem ratione sequi totam, quibusdam eligendi autem quisquam nihil reprehenderit sed commodi aut libero eius voluptate ducimus veniam soluta. Consequuntur voluptatem quaerat dolorum!
                    </div>
                </div>

                <div class = "small-column-50 laptop-column-33 with-contents" data-info = ".small-column-50 .laptop-column-33">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ratione facere voluptatem, in atque beatae recusandae nesciunt quis dolore, voluptate, totam tempora cum maxime molestiae eius non amet mollitia commodi nostrum voluptates voluptatibus ipsa. Ipsa, eaque. Necessitatibus praesentium ex odit!
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-33 with-contents" data-info = ".small-column-50 .laptop-column-33">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis non, veniam natus rerum velit ut impedit ullam, similique repellat aliquid. Dolor necessitatibus nulla amet, quia.
                    </div>
                </div>
                <div class = "small-column-100 laptop-column-33 with-contents" data-info = ".small-column-100 .laptop-column-33">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt debitis error laudantium sapiente nihil inventore commodi unde minus assumenda vitae dolor, sit quod expedita labore officia cumque repellendus deleniti, consectetur laboriosam adipisci. Odit sapiente mollitia ipsam voluptatem architecto, totam, animi ducimus eaque iste facilis fugit.
                    </div>
                </div>

                <div class = "small-column-50 laptop-column-25 with-contents" data-info = ".small-column-50 .laptop-column-25">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae voluptate incidunt obcaecati culpa natus? Ducimus, deleniti. Eos quam est voluptatibus voluptates, quo incidunt, natus nostrum rerum temporibus, optio repudiandae veniam distinctio nesciunt, doloribus.
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-25 with-contents" data-info = ".small-column-50 .laptop-column-25">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, corrupti quisquam quidem, laboriosam a ullam voluptates tenetur accusantium dolore corporis! Officia facilis fugit perspiciatis facere ex itaque numquam possimus fuga, nisi dolorum. Quidem consectetur perspiciatis laboriosam neque fugiat aperiam, suscipit assumenda illum ducimus praesentium.
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-25 with-contents" data-info = ".small-column-50 .laptop-column-25">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est eos dolore sunt et! Ipsum esse, rem ab! Cupiditate, voluptatum blanditiis.
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-25 with-contents" data-info = ".small-column-50 .laptop-column-25">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro a, fugiat dicta doloribus quisquam, alias nulla officia eius neque, consequatur sint cumque corrupti beatae hic.
                    </div>
                </div>

                <div class = "small-column-50 with-contents" data-info = ".small-column-50">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam blanditiis nemo ipsum nobis, dignissimos, quam fuga. Qui cumque repellendus ut optio error at molestias, pariatur velit quibusdam laboriosam, eaque, debitis ipsum? Excepturi, nemo, voluptatibus error consequatur praesentium deserunt alias iste fuga minima deleniti repellat voluptatem est quasi quae quibusdam maxime.
                    </div>
                </div>
                <div class = "small-column-50 with-contents" data-info = ".small-column-50">
                    <div class = "the-contents">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque eligendi excepturi, quis ab quo similique, assumenda accusantium quia et fuga non unde laborum ipsa vel doloribus dolore, soluta, sunt sit!
                    </div>
                </div>

            </div>
        </div>

        <p>
            Try to resize your browser window between breakpoints and observe how the equalheights module <strong>re-calculates</strong> the heights of the containers across <strong>all breakpoints</strong>. And it was all made possible simpy by adding the <code>responsiville-equalheights</code> class to the container.
        </p>



        <h2>Children</h2>

        <p>
            The equalheights module has an extra mode where it can run, not on the defined elements themselves, but on certain child elements of theirs. For instance, let&apos; say that you have a set of columns, which have a title, an excerpt and an image and you want their titles and experts to get equal heights. Here comes the <code>children</code> settings of the equalheights module to the rescue:
        </p>

        <div class = "grid-showcase">
            <div class = "row responsiville-equalheights"
                 data-responsiville-equalheights-children=".title, .excerpt" 
                 data-info = ".row .responsiville-equalheights">
                <div class = "small-column-50 laptop-column-33 with-contents" data-info = ".small-column-50 .laptop-column-33">
                    <div class = "the-contents">
                        <p class = "title"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, eaque.</strong></p>
                        <p class = "excerpt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus amet, quidem. At aliquid dolores molestiae aut! Adipisci ratione libero corrupti voluptates odio ab perspiciatis. Fugiat.
                        </p>
                        <img src = "img/photo1.jpg" />
                    </div>
                </div>
                <div class = "small-column-50 laptop-column-33 with-contents" data-info = ".small-column-50 .laptop-column-33">
                    <div class = "the-contents">
                        <p class = "title"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing.</strong></p>
                        <p class = "excerpt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dolores, nostrum minima perspiciatis aut sunt voluptates eius delectus accusamus dicta illo dolor voluptatem numquam blanditiis facilis, quod illum natus sed eveniet praesentium laboriosam. Exercitationem quas quibusdam dignissimos, necessitatibus inventore quaerat!
                        </p>
                        <img src = "img/photo1.jpg" />
                    </div>
                </div>
                <div class = "small-column-100 laptop-column-33 with-contents" data-info = ".small-column-100 .laptop-column-33">
                    <div class = "the-contents">
                        <p class = "title"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia sapiente mollitia ratione nostaccusamus.</strong></p>
                        <p class = "excerpt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea vero autem alias dolor maxime dicta cupiditate, et, beatae debitis recusandae ut minima asperiores excepturi expedita, maiores. Corrupti quisquam officiis, sed voluptate suscipit autem..
                        </p>
                        <img src = "img/photo1.jpg" />
                    </div>
                </div>
            </div>
        </div>

        <p>
            And here is the code for this:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="row responsiville-equalheights"

                 data-responsiville-equalheights-children=".title, .excerpt">

                <div class="small-column-50 laptop-column-33">
                    <p class="title"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, eaque.</strong></p>
                    <p class="excerpt">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus amet, quidem. At aliquid dolores molestiae aut! Adipisci ratione libero corrupti voluptates odio ab perspiciatis. Fugiat.
                    </p>
                    <img src="img/photo1.jpg" />
                </div>
                <div class="small-column-50 laptop-column-33">
                    <p class="title"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing.</strong></p>
                    <p class="excerpt">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dolores, nostrum minima perspiciatis aut sunt voluptates eius delectus accusamus dicta illo dolor voluptatem numquam blanditiis facilis, quod illum natus sed eveniet praesentium laboriosam. Exercitationem quas quibusdam dignissimos, necessitatibus inventore quaerat!
                    </p>
                    <img src="img/photo1.jpg" />
                </div>
                <div class="small-column-100 laptop-column-33">
                    <p class="title"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia sapiente mollitia ratione nostaccusamus.</strong></p>
                    <p class="excerpt">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea vero autem alias dolor maxime dicta cupiditate, et, beatae debitis recusandae ut minima asperiores excepturi expedita, maiores. Corrupti quisquam officiis, sed voluptate suscipit autem..
                    </p>
                    <img src="img/photo1.jpg" />
                </div>

            </div>
        --></code></pre>



    </article>



<?php include( 'footer.php' ); ?>