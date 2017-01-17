<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Accordion</h1>

        <p>
            The accordion is an element that consists of many other elements, which we call accordion panels, that open and close, sort of like a real accordion expands and shrinks. Here is how you can create an accordion <strong>automatically</strong>:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="responsiville-accordion"

                 data-responsiville-accordion-duration="300"
                 data-responsiville-accordion-delay="50"
                 data-responsiville-accordion-enter="laptop, desktop, large, xlarge"
                 data-responsiville-accordion-leave="small, mobile, tablet">

                <div class="responsiville-accordion-panel">
                    <div class="responsiville-accordion-header">
                        Opens and closes the panel when clicked.
                    </div>
                    <div class="responsiville-accordion-excerpt">
                        Optional excerpt visible when the panel is closed.
                    </div>
                    <div class="responsiville-accordion-content">
                        The actual full content of the panel. Can be any HTML content you wish.
                    </div>
                    <div class="responsiville-accordion-footer">
                        Optional footer of the panel.
                    </div>
                </div>

                ...

            </div>
        --></code></pre>

        <p>
            You may use as many panels as you wish.
        </p>

        <p>
            The class that designates this particular HTML element -and its contents- to become an accordion is <code>responsiville-accordion</code>. Also, note that its children follow a specific pattern for their class naming. You can look these details up in the API documentation. The rest is taken care by the framework.
        </p>

        <p>
            Here is how you can create it <strong>on demand</strong>:
        </p>

        <pre><code class = "language-javascript">
            var accordion = new Responsiville.Accordion({
                container : 'responsiville-accordion',
                duration  : 300,
                delay     : 50,
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
                    js_beautify( JSON.stringify( Responsiville.Accordion.defaults ) ) +
                '</code></pre>'
            );
        </script>

        <h2>Working example</h2>

        <p>
            Here is a full working example:
        </p>

        <div class = "grid-showcase">
            <div class = "row responsiville-accordion" data-info = ".row">
                <div class = "small-column-100 responsiville-accordion-panel with-contents" data-info = ".small-column-100 responsiville-accordion-panel">
                    <div class = "the-contents">
                        <div class = "responsiville-accordion-header">
                            <strong>This is the accordion panel header. Click it to open/close it.</strong>
                        </div>
                        <div class = "responsiville-accordion-excerpt">
                            <em>This is the accordion panel excerpt. It is visible at all times as an excerpt of the accordion panel content. It is an optional element.</em>
                        </div>
                        <div class = "responsiville-accordion-content">
                            <br />
                            This is the accordion panel contents. It can be any HTML content you like. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque natus consequuntur animi perspiciatis impedit, inventore porro, repudiandae molestias, voluptates quae sapiente placeat aspernatur voluptatibus doloremque iste itaque culpa accusantium, hic officiis voluptas provident neque officia dignissimos maiores! Vitae, reprehenderit hic nobis voluptatem mollitia ab numquam distinctio possimus aliquam animi pariatur neque, dolores modi repellat ut quos, quae cumque voluptatibus eligendi a sint odio assumenda ratione natus! Quibusdam beatae consequatur eligendi aspernatur, praesentium neque, harum adipisci ex. Corporis dignissimos laudantium quia laboriosam fugiat reiciendis iusto mollitia sequi esse cum. Laborum voluptatem explicabo unde reiciendis iusto quaerat quibusdam atque, veniam, illum sed!
                            <br />
                            <br />
                        </div>
                        <div class = "responsiville-accordion-footer">
                            <em>This is the accordion panel footer. Follows the same logic as the excerpt.</em>
                        </div>
                    </div>
                </div>
                <div class = "small-column-100 responsiville-accordion-panel with-contents" data-info = ".small-column-100 responsiville-accordion-panel">
                    <div class = "the-contents">
                        <div class = "responsiville-accordion-header">
                            <strong>This is the header. There is no excerpt or footer.</strong>
                        </div>
                        <div class = "responsiville-accordion-content">
                            <br />
                            This is the accordion panel contents. It can be any HTML content you like. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque natus consequuntur animi perspiciatis impedit, inventore porro, repudiandae molestias, voluptates quae sapiente placeat aspernatur voluptatibus doloremque iste itaque culpa accusantium, hic officiis voluptas provident neque officia dignissimos maiores! Vitae, reprehenderit hic nobis voluptatem mollitia ab numquam distinctio possimus aliquam animi pariatur neque, dolores modi repellat ut quos, quae cumque voluptatibus eligendi a sint odio assumenda ratione natus! Quibusdam beatae consequatur eligendi aspernatur, praesentium neque, harum adipisci ex. Corporis dignissimos laudantium quia laboriosam fugiat reiciendis iusto mollitia sequi esse cum. Laborum voluptatem explicabo unde reiciendis iusto quaerat quibusdam atque, veniam, illum sed!
                            <br />
                            <br />
                        </div>
                    </div>
                </div>
                <div class = "small-column-100 responsiville-accordion-panel with-contents" data-info = ".small-column-100 responsiville-accordion-panel">
                    <div class = "the-contents">
                        <div class = "responsiville-accordion-header">
                            <strong>This is the header. There is no excerpt or footer.</strong>
                        </div>
                        <div class = "responsiville-accordion-content">
                            <br />
                            This is the accordion panel contents. It can be any HTML content you like. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque natus consequuntur animi perspiciatis impedit, inventore porro, repudiandae molestias, voluptates quae sapiente placeat aspernatur voluptatibus doloremque iste itaque culpa accusantium, hic officiis voluptas provident neque officia dignissimos maiores! Vitae, reprehenderit hic nobis voluptatem mollitia ab numquam distinctio possimus aliquam animi pariatur neque, dolores modi repellat ut quos, quae cumque voluptatibus eligendi a sint odio assumenda ratione natus! Quibusdam beatae consequatur eligendi aspernatur, praesentium neque, harum adipisci ex. Corporis dignissimos laudantium quia laboriosam fugiat reiciendis iusto mollitia sequi esse cum. Laborum voluptatem explicabo unde reiciendis iusto quaerat quibusdam atque, veniam, illum sed!
                            <br />
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


    </article>



<?php include( 'footer.php' ); ?>