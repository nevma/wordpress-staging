<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Responsiville Slideshow</h1>

        <p>
            The Responsiville slideshow implements the idea of a rotating set of similar elements. It has also come to be known as a carousel, but this actually depends on the type of animation its elements use to rotate. The slideshow consists of a slideshow container and its containing slides. The slideshow container may have as many slides as necessary.
        </p>

        <p>
            Here is an example, where one can define a slideshow automatically by adding the <code>responsiville-slideshow</code> class to it:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="responsiville-slideshow"

                 data-responsiville-slideshow-resizemode="maxSlide"
                 data-responsiville-slideshow-enter="laptop, desktop, large, xlarge"
                 data-responsiville-slideshow-leave="small, mobile, tablet">

                <article>
                    <h2>Slide title 1</h2>
                    <p>
                        Slide text 1. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia porro explicabo pariatur! Eum, nobis?
                    </p>
                    <img src="image1.jpg" alt="" />
                </article>
                <article>
                    <h2>Slide title 2</h2>
                    <p>
                        Slide text 2. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus animi, fugit tempore.
                    </p>
                    <img src="image2.jpg" alt="" />
                </article>
                <article>
                    <h2>Slide title 3</h2>
                    <p>
                        Slide text 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et nostrum at possimus eius, facilis veniam nobis error.
                    </p>
                    <img src="image3.jpg" alt="" />
                </article>
            </div>
        --></code></pre>

        <p>
            If nothing more specific is defined, then all the direct children of the slideshow container will become its slides. If you wish to differentiate this default, common behaviour you may specify exactly which elements inside the container should be regarded as its slides.
        </p>

        <p>
            Note that the module settings which are declared through data attributes and contain uppercase letters in their names, like the <code>resizeMode</code>, they are written in HTML with <strong>all lowercase</strong> letters, because HTML is case insensitive.
        </p>

        <p>
            Here is how one could create a scrollmenu in a non-automatic way:
        </p>

        <pre><code class = "language-javascript">
            var slideshow = new Responsiville.Slideshow({
                element    : '.responsiville-slideshow',
                resizeMode : 'maxSlide',
                enter      : 'laptop, desktop, large, xlarge',
                leave      : 'small, mobile, tablet'
            });
        </code></pre>

        <p>
            What the slideshow module does when it is <strong>disabled</strong>, that is in the breakpoints where it &quot;leaves&quot;, is that it tries to leave the DOM exactly as it was even before the module ever run in the first place. This way it is as less obtrusive as possible and either allows the content to flow as naturally as possible or it just lets the developer style it as they see fit.
        </p>



        <h2>Automatic navigation</h2>

        <p>
            The navigation elements of the slideshow are created automatically by the module. These are one bullet for each slide, so that the user can choose any slide they like on demand, a next and a previous button, so that the user can move forwards and backwards in the slideshow. The developer needs not create any navigation elements for the slideshow, but they can style the ones that the module creates any way they see fit.
        </p>



        <h2>Default values</h2>

        <p>
            Here is its full list of settings and default values:
        </p>

        <script type = "text/javascript">
            document.write(
                '<pre><code class = "language-json">' +
                    js_beautify( JSON.stringify( Responsiville.Slideshow.defaults ) ) +
                '</code></pre>'
            );
        </script>



        <h2>Working examples</h2>

        <p>
            Here is a full working example based on the above case:
        </p>

        <style type = "text/css">
            .responsiville-slideshow .slide .excerpt {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                padding: 2em 2em;
                margin: 0;
                color: var(--color-white);
                background-color: var(--color-gray-dark);
            }
        </style>

        <div class = "responsiville-slideshow responsiville-slideshow-example" 

             data-responsiville-slideshow-bulletspos="tc"
             data-responsiville-slideshow-resizemode="maxSlide">

            <div class = "slide">
                <img src = "img/photo4.jpg" alt="" />
                <div class = "excerpt">
                    <h3>This is the title of slide 1</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius a nemo voluptate eligendi dolorem aut minima illum, tenetur earum! Error tenetur et animi fugiat ab.
                    </p>
                </div>
            </div>
            <div class = "slide">
                <img src = "img/photo3.jpg" alt="" />
                <div class = "excerpt">
                    <h3>This is the title of slide 2</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam nobis, unde nulla. Magni, delectus facilis saepe praesentium dolor. Voluptate, facere!
                    </p>
                </div>
            </div>
            <div class = "slide">
                <img src = "img/photo1.jpg" alt="" />
                <div class = "excerpt">
                    <h3>This is the title of slide 3</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore odio, recusandae eum quibusdam quasi magnam quo. Animi.
                    </p>
                </div>
            </div>
        </div>



    </article>



<?php include( 'footer.php' ); ?>