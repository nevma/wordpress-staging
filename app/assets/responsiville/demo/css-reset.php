<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>CSS reset</h1>

        <p>
            The HTML elements of Responsiville have been reset (or normalised) so that they can be used in a consistent and browser independent way. Most of these resets consist of removing all margins and paddings, setting some sane default font sizes and line heights and, of course, setting the default typographic behaviour of the web page.
        </p>

        <p>
            At any point of the web page you only need to set a <code>text</code> class to a container, so that its contents will gain all the stylings of a nice text. We differentiate this text from the rest of the text of the page, because this text is in need of quite some typographic enhancements in order to be beautiful and readable, while the rest of the text mostly takes part in the web page&apos;s layout and navigationa and, therefore, needs to be a lot simpler and unobtrusive.
        </p>

        <p>
            Of course the final styling of each element also depends on the additional CSS that works on it and is declared on this -and, for that matter, every- web page:
        </p>

        <h3>This an H3 heading</h3>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, ad molestias maiores officiis. Earum necessitatibus doloribus nostrum temporibus sequi dolorem, accusantium dolorum, aliquid unde distinctio odio eos ullam esse quasi adipisci. Deleniti atque distinctio neque cupiditate magni porro tempore maxime totam molestias! Quod, eius.
        </p>

        <h4>This an H4 heading</h4>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis quo laudantium officia voluptates dolore quia ipsam, aperiam pariatur. Ab commodi similique labore perferendis, quas quod earum error dignissimos, nam eius incidunt deserunt repellendus suscipit quaerat illo quia laborum doloremque cum iusto non, nemo perspiciatis, consequatur corporis soluta. Officia atque, ex soluta ipsam doloribus ipsa natus!
        </p>

        <h5>This an H5 heading</h5>

        <p>
            lorem45
        </p>

        <h6>This an H6 heading</h6>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit nesciunt quas facere sapiente fugiat maxime. Repellendus iure consectetur hic alias distinctio commodi quibusdam culpa dolor quam modi repellat at nulla saepe laboriosam aliquid exercitationem reiciendis quidem doloribus error cumque. Tempora dolore debitis ipsam aliquid perspiciatis sit assumenda porro dolorem quos ducimus vero nemo adipisci quibusdam reprehenderit impedit dolores a. Officia unde voluptates amet reiciendis dolor non facere modi quae?
        </p>

        <p class = "fancy">
            This <em>fancy</em> paragraph has a bold first line. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit nesciunt quas facere sapiente fugiat maxime. Repellendus iure consectetur hic alias distinctio commodi quibusdam culpa dolor quam modi repellat at nulla saepe laboriosam aliquid exercitationem reiciendis quidem doloribus error cumque. Tempora dolore debitis ipsam aliquid perspiciatis sit assumenda porro dolorem quos ducimus vero nemo adipisci quibusdam reprehenderit impedit dolores a. Officia unde voluptates amet reiciendis dolor non facere modi quae?
        </p>

        <p class = "oldie">
            This <strong>oldie</strong> paragraph has a big first letter. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea ipsam error ab at architecto aspernatur porro autem molestiae atque veritatis repellendus harum nostrum maiores quos voluptas dolorem accusamus sit fugiat aliquam iure pariatur voluptatem labore asperiores excepturi eius! Placeat inventore aspernatur accusantium praesentium earum et minus possimus unde ut dolorem facilis voluptatem repellat optio sed. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto a earum molestiae culpa doloribus obcaecati commodi vel perspiciatis et praesentium.
        </p>

        <h2>Lists</h2>

        <ul>
            <li>An <strong>unordered list</strong>.</li>
            <li>Saepe laborum sit quasi iure ipsa dolores quos unde quisquam!</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis illum quae illo explicabo!</li>
            <li>Harum quae ratione excepturi placeat ullam repudiandae vero in repellat.</li>
            <li>Atque consequatur cupiditate repellendus alias nulla illum dolorem porro minima.</li>
        </ul>

        <ol>
            <li>An <strong>ordered list</strong>.</li>
            <li>Quam neque cum debitis delectus facere qui laboriosam accusamus vitae doloribus saepe hic minima obcaecati odit quos explicabo sit molestiae.</li>
            <li>Aut corporis aperiam porro quod reiciendis eligendi blanditiis sint labore explicabo rem ullam consequuntur laboriosam mollitia nihil eos consectetur delectus!</li>
            <li>Esse ab cumque architecto perferendis blanditiis facilis nesciunt sed nemo voluptas quos nam minus quasi in necessitatibus consectetur praesentium quia.</li>
            <li>Autem distinctio sunt soluta ullam sed eum nulla molestiae. Eos reiciendis distinctio magnam quia similique quis vel numquam delectus velit.</li>
        </ol>

        <ul>
            <li>A mixed list.</li>
            <li>Saepe laborum sit quasi iure ipsa dolores quos unde quisquam!</li>
            <li>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis illum quae illo explicabo!
                <ol>
                    <li>Quam neque cum debitis delectus facere qui laboriosam accusamus vitae doloribus saepe hic minima obcaecati odit quos explicabo sit molestiae.</li>
                    <li>Aut corporis aperiam porro quod reiciendis eligendi blanditiis sint labore explicabo rem ullam consequuntur laboriosam mollitia nihil eos consectetur delectus!</li>
                    <li>Esse ab cumque architecto perferendis blanditiis facilis nesciunt sed nemo voluptas quos nam minus quasi in necessitatibus consectetur praesentium quia.</li>
                    <li>Autem distinctio sunt soluta ullam sed eum nulla molestiae. Eos reiciendis distinctio magnam quia similique quis vel numquam delectus velit.</li>
                </ol>
            </li>
            <li>Harum quae ratione excepturi placeat ullam repudiandae vero in repellat.</li>
            <li>Atque consequatur cupiditate repellendus alias nulla illum dolorem porro minima.</li>
            <li>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, facere.
                <ul>
                    <li>Saepe laborum sit quasi iure ipsa dolores quos unde quisquam!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis illum quae illo explicabo!</li>
                    <li>
                        Harum quae ratione excepturi placeat ullam repudiandae vero in repellat.
                        <ul>
                            <li>Saepe laborum sit quasi iure ipsa dolores quos unde quisquam!</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis illum quae illo explicabo!</li>
                            <li>Harum quae ratione excepturi placeat ullam repudiandae vero in repellat.</li>
                            <li>Atque consequatur cupiditate repellendus alias nulla illum dolorem porro minima.</li>
                        </ul>
                    </li>
                    <li>Atque consequatur cupiditate repellendus alias nulla illum dolorem porro minima.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima dolorem debitis expedita!</li>
                </ul>
            </li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, cupiditate, totam. Fugit vero repellendus, architecto voluptate sed nam repellat quidem expedita blanditiis aperiam.</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, illum alias nobis ipsa minus, iusto.</li>
        </ul>

        <dl>
            <dt><dfn>A <strong>definition list</strong>.</dfn></dt>
            <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aspernatur in adipisci voluptatum hic ratione libero quibusdam ut eum beatae.</dd>
            <dt><dfn>Asperiores quo est sequi aliquam quae!</dfn></dt>
            <dd>Suscipit tempora dicta laborum unde error dolores quaerat consequuntur sapiente ipsam nemo incidunt accusantium quia? Tempore mollitia placeat magni beatae.</dd>
            <dt><dfn>Libero eius quod officia explicabo obcaecati.</dfn></dt>
            <dd>Sunt laudantium quaerat odit explicabo debitis aliquid eveniet id sequi fugit nostrum fugiat veniam earum aperiam nam laborum inventore error?</dd>
        </dl>

        <h2>Blockquotes</h2>

        <blockquote>
            <p>
                <strong>A normal blockquote.</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia nulla voluptatem ipsum doloremque. Facere ipsum dolorem expedita eius mollitia reprehenderit sequi ipsam vero at ab voluptates alias atque natus. Nostrum quisquam reprehenderit perferendis illo natus totam iure culpa tempora laboriosam consectetur aut facilis voluptatem iste magnam distinctio quos ut cumque hic officiis recusandae nesciunt officia earum saepe delectus ducimus ipsum accusantium architecto pariatur neque unde? In error quibusdam sit repellendus.
            </p>
        </blockquote>

        <blockquote class = "frame">
            <p>A blockquote with a <strong>frame</strong>.</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia nulla voluptatem ipsum  doloremque. Facere ipsum dolorem expedita eius mollitia reprehenderit sequi ipsam vero at ab voluptates alias atque natus. Nostrum quisquam reprehenderit perferendis &quot;illo natus totam iure&quot; culpa tempora laboriosam consectetur aut facilis voluptatem iste magnam distinctio quos ut cumque hic officiis recusandae nesciunt pariatur neque unde? In error quibusdam sit repellendus.
            </p>
            <p>
                O tempora o mores, consectetur adipisicing elit. Dicta qui perferendis iure ipsam facere atque tempora reprehenderit tenetur explicabo doloribus numquam inventore accusantium dolore ullam sit hic vel. Officia dolorem ab quod aperiam quasi pariatur vero porro quibusdam aliquid quo.
            </p>
            <p class = "text-right">
                Peace <span class = "amp">&amp;</span> love,
                <br />
                Takis
            </p>
        </blockquote>

        <blockquote class = "citation">
            <p>
                A blockquote with a <strong>citation</strong>. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil voluptates ratione quasi praesentium quas unde consequuntur dicta molestias blanditiis aut error iusto magni eveniet culpa beatae adipisci esse! Nisi neque beatae recusandae totam fugit ad incidunt ducimus enim quas pariatur.
            </p>
            <p>
                <strong>&mdash; thus spoke Zarathustra</strong>
            </p>
        </blockquote>

        <blockquote class = "modern">
            <p>
                A modern blockquote. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil voluptates ratione quasi praesentium quas unde consequuntur dicta molestias blanditiis aut error iusto magni eveniet culpa beatae adipisci esse! Nisi neque beatae recusandae totam fugit ad incidunt ducimus enim quas pariatur.
            </p>
        </blockquote>

        <blockquote class = "shout">
            <p>
                A <strong>shouting</strong> blockquote. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            </p>
        </blockquote>

        <blockquote class = "modern shout">
            <p>
                A <strong>modern and shouting</strong> blockquote. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil voluptates ratione quasi praesentium quas unde consequuntur dicta.
            </p>
        </blockquote>

        <h2>Alignments</h2>

        <p class = "text-left">
            <strong>Left aligned text</strong> lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad velit autem similique sequi obcaecati reprehenderit! Ducimus pariatur consequatur magni deserunt possimus at tenetur aliquid eum libero ratione impedit quis aliquam alias voluptatem molestiae nam unde tempore autem. Quaerat repudiandae odio beatae animi ullam quo possimus hic harum dolorum iste dolor veritatis delectus nemo earum itaque consequatur placeat blanditiis ad sequi quis amet praesentium.
        </p>

        <p class = "text-center">
            <strong>Center aligned text</strong> lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum dicta dolor voluptatibus animi modi recusandae cumque eaque odit et sequi. Sapiente laboriosam atque aperiam eligendi laudantium voluptates. Cupiditate reprehenderit asperiores illo nam autem quibusdam itaque numquam assumenda perspiciatis reiciendis hic accusantium alias eligendi. Impedit nihil vel itaque possimus dolorum in natus non soluta veritatis libero. Aut inventore cupiditate assumenda ratione provident excepturi!
        </p>

        <p class = "text-justify">
            <strong>Justified text</strong> lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore animi esse iste sapiente doloribus iusto aliquid distinctio deleniti velit inventore quis minima perspiciatis! Ratione beatae porro autem dolor accusamus doloremque velit itaque repellat quisquam quia deleniti quo magni culpa exercitationem dolorem nisi repellat cumque temporibus. Esse perferendis!
        </p>

        <p class = "text-right">
            <strong>Right aligned text</strong> lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem adipisci laboriosam eligendi fugit sapiente quae distinctio omnis suscipit illo nostrum rerum a nobis enim quaerat debitis. Reprehenderit eius laborum delectus quaerat dolorum quibusdam explicabo provident voluptas. Quas facere nostrum quae incidunt. Placeat necessitatibus officia sed magnam ipsa similique rem aut laboriosam illum cum nobis cumque?
        </p>

        <h2>Text elements</h2>

        <p>
            Some inline elements <br />
            I am <a href = "http://www.nothing.gr">the a tag</a> example. <br/>
            I am <a href = "http://www.nevma.gr">the a tag</a> example probably visited. <br/>
            I am <b>the b tag</b> example. <br/>
            I am <strong>the strong tag</strong> example. <br/>
            I am <em>the em tag</em> example. <br/>
            I am <i>the i tag</i> example. <br/>
            I am <code>the code tag</code> example. <br/>
            I am <del>the del tag</del> example. <br/>
            I am <sub>the sub tag</sub> example. <br/>
            I am <sup>the sup tag</sup> example. <br/>
        </p>

        <pre>
            <strong>Preformatted text</strong> lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur iusto obcaecati numquam minus labore delectus 
                quibusdam dolores quos itaque facilis similique doloremque corporis ab deserunt ut illum 
            totam ipsam quo natus officiis amet dignissimos        iure quod maiores voluptate. Incidunt saepe 
            voluptatum      quibusdam nam eaque nobis dolorum quam odio ea officia vel illum ex dolores neque dignissimos eligendi 
            ut doloremque fugiat impedit quia. Doloribus commodi rerum maxime laudantium. Temporibus beatae illo tempora 
            quod! Odit quisquam porro saepe cumque          sapiente eos voluptatem enim necessitatibus quasi consectetur 
            numquam quos atque ea fugiat             arimbaaa                           recusandae perspiciatis totam blanditiis 
            voluptate a aut hic laboriosam assumenda pariatur akouilat inamis rotinhe ll amicio rubiko.
        </pre>

        <pre><code>
            /**
             * <strong>Preformatted code.</strong>
             */

            package gr.nevma.cms.entities;

            import java.util.*;
            import javax.servlet.http.*;

            public class Category extends WebEntity {
            
                public Category () {

                    super();

                }
            }
        </code></pre>

        <h2>Images</h2>

        <p>
            A responsive image.
        </p>

        <p>
            <img src = "img/photo3.jpg" alt = "" />
        </p>

        <div class = "row">
            <div class = "small-column-100 laptop-column-33">
                <p>SVG Image</p>
                <p><img src = "img/owl.svg" alt = "Image SVG" /></p>
            </div>
            <div class = "small-column-100 laptop-column-33">
                <p>SVG Object</p>
                <object data = "img/owl.svg" type = "image/svg+xml"></object>
            </div>
            <div class = "small-column-100 laptop-column-33">
                <p>SVG Embed</p>
                <embed src = "img/owl.svg" type = "image/svg+xml" />
            </div>
        </div>

        <p>
            A figure with an image and a figcation.
        </p>

        <figure>
            <img src = "img/photo2.jpg" alt = "">
            <figcaption>Caption for the awesome picture Lorem ipsum dolor sit amet, consectetur adipisicing.</figcaption>
        </figure>

        <h2>Videos &amp; iframes</h2>

        <div class = "row">
            <div class = "small-column-100 laptop-column-50">
                <p>HTML5 video</p>
                <p><video src = "vid/video.mp4" controls = "controls"></video></p>
            </div>
            <div class = "small-column-100 laptop-column-50">
                <p>HTML5 video as thumbnail</p>
                <p><video src = "vid/video.mp4" controls = "controls"></video></p>
            </div>
        </div>

        <div class = "row">
            <div class = "small-column-100 laptop-column-50">
                <p>Youtube video</p>
                <p class = "video-wrapper ratio-16x9">
                    <iframe src = "http://www.youtube.com/embed/pgwjGrdieIY?rel=0&amp;hd=1" frameborder = "0" allowfullscreen></iframe>
                </p>
            </div>
            <div class = "small-column-100 laptop-column-50">
                <p>Vimeo video</p>
                <p class = "video-wrapper ratio-16x9">
                    <iframe src = "http://player.vimeo.com/video/5471915" frameborder = "0" allowfullscreen></iframe>
                </p>
            </div>
        </div>

        <p>
            Note that in order to achieve a responsive iframe we need to add a wrapping element to it and define its aspect ratio like this:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="video-wrapper ratio-16x9">
                <iframe src="http://www.youtube.com/embed/pgwjGrdieIY?rel=0&amp;hd=1" frameborder="0" allowfullscreen>
                </iframe>
            </div>
        --></code></pre>

        <p>
            Other available ratios are: <code>4x3</code>, <code>16x7</code>, <code>16x9</code>, <code>square</code>.
        </p>

        <h2>Tables</h2>

        <div class = "row">
            <div class = "small-column-100 laptop-column-50">
                <p>Table with caption on top</p>
                <table>
                    <caption>This is a nice responsive table (caption)</caption>
                    <thead>
                        <tr>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Title3</th>
                            <th>Title4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contents 11</td>
                            <td>Contents 12</td>
                            <td>Russia</td>
                            <td>475</td>
                        </tr>
                        <tr>
                            <td>Contents 21</td>
                            <td>Contents 22</td>
                            <td>Brazil</td>
                            <td>845</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United States of America</td>
                            <td>4234</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United kingdom</td>
                            <td>234</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan = "4">A table footer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class = "small-column-100 laptop-column-50">
                <p>Table with caption on bottom</p>
                <table>
                    <caption class = "bottom">This is a nice responsive table (caption)</caption>
                    <thead>
                        <tr>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Title3</th>
                            <th>Title4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contents 11</td>
                            <td>Contents 12</td>
                            <td>Russia</td>
                            <td>475</td>
                        </tr>
                        <tr>
                            <td>Contents 21</td>
                            <td>Contents 22</td>
                            <td>Brazil</td>
                            <td>845</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United States of America</td>
                            <td>4234</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United kingdom</td>
                            <td>234</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan = "4">A table footer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class = "small-column-100 laptop-column-50">
                <p>Table <code>vertical</code></p>
                <table class = "vertical">
                    <caption class = "bottom">This is a nice responsive table (caption)</caption>
                    <thead>
                        <tr>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Title3</th>
                            <th>Title4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contents 11</td>
                            <td>Contents 12</td>
                            <td>Russia</td>
                            <td>475</td>
                        </tr>
                        <tr>
                            <td>Contents 21</td>
                            <td>Contents 22</td>
                            <td>Brazil</td>
                            <td>845</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United States of America</td>
                            <td>4234</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United kingdom</td>
                            <td>234</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan = "4">A table footer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class = "small-column-100 laptop-column-50">
                <p>Table <code>horizontal</code></p>
                <table class = "horizontal">
                    <caption class = "bottom">This is a nice responsive table (caption)</caption>
                    <thead>
                        <tr>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Title3</th>
                            <th>Title4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contents 11</td>
                            <td>Contents 12</td>
                            <td>Russia</td>
                            <td>475</td>
                        </tr>
                        <tr>
                            <td>Contents 21</td>
                            <td>Contents 22</td>
                            <td>Brazil</td>
                            <td>845</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United States of America</td>
                            <td>4234</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United kingdom</td>
                            <td>234</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan = "4">A table footer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class = "small-column-100 laptop-column-50">
                <p>Table <code>clean</code></p>
                <table class = "clean">
                    <caption class = "bottom">This is a nice responsive table (caption)</caption>
                    <thead>
                        <tr>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Title3</th>
                            <th>Title4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contents 11</td>
                            <td>Contents 12</td>
                            <td>Russia</td>
                            <td>475</td>
                        </tr>
                        <tr>
                            <td>Contents 21</td>
                            <td>Contents 22</td>
                            <td>Brazil</td>
                            <td>845</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United States of America</td>
                            <td>4234</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United kingdom</td>
                            <td>234</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan = "4">A table footer</th>
                        </tr>
                    </tfoot>
                </table>
                <p>Table <code>liner</code></p>
                <p>Table <code>vanilla</code></p>
                <table class = "vanilla">
                    <caption class = "bottom">This is a nice responsive table (caption)</caption>
                    <thead>
                        <tr>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Title3</th>
                            <th>Title4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contents 11</td>
                            <td>Contents 12</td>
                            <td>Russia</td>
                            <td>475</td>
                        </tr>
                        <tr>
                            <td>Contents 21</td>
                            <td>Contents 22</td>
                            <td>Brazil</td>
                            <td>845</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United States of America</td>
                            <td>4234</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United kingdom</td>
                            <td>234</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan = "4">A table footer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class = "small-column-100 laptop-column-50">
                <table class = "liner">
                    <thead>
                        <tr>
                            <th>Title1</th>
                            <th>Title2</th>
                            <th>Title3</th>
                            <th>Title4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Contents 11</td>
                            <td>Contents 12</td>
                            <td>Russia</td>
                            <td>475</td>
                        </tr>
                        <tr>
                            <td>Contents 21</td>
                            <td>Contents 22</td>
                            <td>Brazil</td>
                            <td>845</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United States of America</td>
                            <td>4234</td>
                        </tr>
                        <tr>
                            <td>Contents 31</td>
                            <td>Contents 32</td>
                            <td>United kingdom</td>
                            <td>234</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan = "4">A table footer</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class = "small-column-100 laptop-column-50">
            </div>
        </div>

        <h2>Forms</h2>

        <form action = "#forms" method = "post">
            <p>
                <label for = "input-text">Text input:</label> 
                <input id = "input-text" value = "Some input text" type = "text" />
                <label for = "input-text-error">Text input (with error):</label> 
                <input id = "input-text-error" value = "Some error text" type = "text" class = "error" />
            </p>
            <p>
                <label for = "password">Password input:</label> 
                <input id = "password" value = "password1" type = "password" />
                <label for = "password-again">Password again:</label> 
                <input id = "password-again" value = "password2" type = "password" />
            </p>
            <div class = "row">
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-placeholder">Input with placeholder:</label>
                        <input id = "input-placeholder" value = "" placeholder = "Enter your text here this is a placeholder" type = "text" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "file">File upload input;</label>
                        <input id = "file" type = "file" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-text-whatevah">Lorem ipsum dolor sit.</label>
                        <input id = "input-text-whatevah" value = "Some input text" type = "text" />
                    </p>
                </div>
            </div>
            <div class = "row">
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "radio1">
                            Radio input 1:
                            <input id = "radio1" name = "radio1" type = "radio" class = "radio" /> 
                        </label>
                        <label for = "radio2">
                            Radio input 2:
                            <input id = "radio2" name = "radio1" type = "radio" class = "radio" /> 
                        </label>
                        <label for = "radio3">
                            Radio input 3:
                            <input id = "radio3" name = "radio1" type = "radio" class = "radio" />
                        </label>
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "checkbox1">
                            Checkbox input 1:
                            <input id = "checkbox1" name = "checkbox1" type = "checkbox" class = "checkbox" />
                        </label> 
                        <label for = "checkbox2">
                            Checkbox input 2:
                            <input id = "checkbox2" name = "checkbox2" type = "checkbox" class = "checkbox" />
                        </label> 
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "select">Select field:</label> 
                        <select id = "select">
                            <option selected = "selected">Option 01</option>
                            <option>Option 02</option>
                            <option>Option 03</option>
                            <option>Option 04</option>
                            <option>Option 05</option>
                        </select>
                    </p>
                </div>
            </div>
            <p>
                <label for = "textarea1">Textarea:</label>
                <textarea id = "textarea1" cols = "30" rows = "5" placeholder = "Enter your text here this is a placeholder"></textarea>
            </p>
            <div class = "row">
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-date">Date:</label>
                        <input id = "input-date" value = "1979-06-26" type = "date" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-datetime">Datetime:</label>
                        <input id = "input-datetime" value = "1979-06-26T18:30Z" type = "datetime" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-datetime-local">Datetime local:</label>
                        <input id = "input-datetime-local" value = "1979-06-26T18:30:00" type = "datetime-local" />
                    </p>
                </div>
            </div>
            <div class = "row">
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-time">Time:</label>
                        <input id = "input-time" value = "18:30" type = "time" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-week">Week:</label>
                        <input id = "input-week" value = "2014-W40" type = "week" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-month">Month:</label>
                        <input id = "input-month" value = "2014-08" type = "month" />
                    </p>
                </div>
            </div>
            <div class = "row">
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-colour">Colour:</label>
                        <input id = "input-colour" value = "#00ff00" type = "color" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-number">Number:</label>
                        <input id = "input-number" value = "123" type = "number" min = "0" max = "1000" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-33">
                    <p>
                        <label for = "input-range">Range:</label>
                        <input id = "input-range" value = "155" type = "range" min = "0" max = "1000" step = "50" />
                    </p>
                </div>
            </div>
            <div class = "row">
                <div class = "small-column-100 laptop-column-50">
                    <p>
                        <label for = "input-disabled">Input disabled:</label>
                        <input id = "input-disabled" value = "" type = "text" disabled />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-50">
                    <p>
                        <label for = "input-invalid">Input invalid:</label>
                        <input id = "input-invalid" value = "123.9" type = "number" min = "0" max = "1000" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-50">
                    <p>
                        <label for = "input-maxlength">Input with maxlength 5:</label>
                        <input id = "input-maxlength" value = "" type = "text" maxlength = "5" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-50">
                    <p>
                        <label for = "input-pattern">Input pattern:</label>
                        <input id = "input-pattern" value = "" type = "text" pattern = "[0-9]{2}-[0-9]{2}-[0-9]{4}" placeholder = "__-__-____" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-50">
                    <p>
                        <label for = "input-email">Input email:</label>
                        <input id = "input-email" value = "" type = "email" placeholder = "mickey@mouse.com" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-50">
                    <p>
                        <label for = "input-telephone">Input telephone:</label>
                        <input id = "input-telephone" value = "" type = "tel" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-50">
                    <p>
                        <label for = "input-url">Input url:</label>
                        <input id = "input-url" value = "" type = "url" />
                    </p>
                </div>
                <div class = "small-column-100 laptop-column-50">
                </div>
            </div>
            <p>
                Meter:
                <meter low = "69" high = "80" max = "100" value = "84" optimum = "90">B</meter>
            </p>
            <p>
                Progress:
                <progress value = "70" max = "100">70%</progress>
            </p>
            <p>
                A text input and a button side by side: 
                <input class = "inline" type = "text" name = "input20" id = "input-inline" value = "" />
                <button>Button</button>
            </p>
        </form>

        <h2>Buttons</h2>

        <div class = "row">
            <div class = "small-column-100 laptop-column-25">
                <p>
                    Input button <input value = "Input button" type = "button" class = "submit" />
                </p>
            </div>
            <div class = "small-column-100 laptop-column-25">
                <p>
                    Input submit <input value = "Input submit" type = "submit" class = "submit" />
                </p>
            </div>
            <div class = "small-column-100 laptop-column-25">
                <p>
                    Actual button <button>Button</button>
                </p>
            </div>
            <div class = "small-column-100 laptop-column-25">
                <p>
                    Anchor button <a class = "button" href = "#forms" title = "Submit">Link button</a>
                </p>
            </div>
        </div>

        <p>
            <button class = "inline button-large">Button large</button>
            <button class = "inline button">Button normal</button>
            <button class = "inline button-medium">Button medium</button>
            <button class = "inline button-small">Button small</button>
        </p>



    </article>



<?php include( 'footer.php' ); ?>