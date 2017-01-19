<?php include( 'header.php' ); ?>



    <article class = "text">



        <h1>Javascript modules</h1>

        <p>
            The Responsiville framework defines some Javascript modules, which are comprised of HTML, CSS and Javascript and encapsulate the appearance and behaviour of common web elements, such as slideshows, mobile menus, accordions, etc. All these modules base their functionality on the main Responsiville object <code>Responsiville.Main</code>. It defines the basic responsive behaviour of the whole framework.
        </p>

        

        <h2>HTML elements as modules</h2>

        <p>
            A Responsiville module is a set of Javascript functions, wrapped in a class, along with its settings, and implemented on an HTML element and its children. The HTML element and it children represent the contents of the module and the Javascript class its behaviour. Of course, there might also be some CSS and even some images or icon-fonts to fulfill its styling.
        </p>

        <p>
            When the <code>RESPONSIVILLE_AUTO_INIT</code> flag is set to true the Responsiville modules act automatically on the HTML elements which bear the designated class attributes. This is the easiest and most indirect way to define and use them. In this mode their default settings can be altered via special data attributes. Of course, one can declare and use Responsiville modules on demand at any time, simply by using the API.
        </p>

        <p>
            Here is a generic example for a hypothetical Responsiville module called <strong>Module</strong>.
        </p>

        <pre><code class = "language-markup"><!--
            <div class="responsiville-module"

                 data-responsiville-module-setting1="value1"
                 data-responsiville-module-setting2="value2"
                 data-responsiville-module-setting3="value3">

                <div class="responsiville-module-child"></div>
                <div class="responsiville-module-child"></div>
                <div class="responsiville-module-child"></div>

            </div>
        --></code></pre>

        <p>
            All that is needed is to set the correct <code>class</code> attribute to the main HTML elements that represents the module and holds its contents and -optionally- to override any of its default settings via the special attributes that are named like <code>responsiville-module-...</code>. This way the module is detected and initialised automatically without the need for the developer to call any Javascript whatsoever. But the pure Javascript method is still there, behind the scenes!
        </p>

        <p>
            Bear in ming that the values inside data attributes are automatically transformed to Javascript object, when accessed by Javascript, as if they were JSON strings. For instance the string &quot;true&quot; becomes the Javascript boolean <code>true</code>, the string &quot;test&quot; will become the Javascript string <code>test</code>, the string &quot;100&quot; will become the Javascript number <code>100</code>, the string &quot;[1,2,3]&quot; will become the Javascript array <code>[1,2,3]</code>, the string &quot;{name:value}&quot; will become the Javascript object <code>{name:value}</code> and so on.
        </p>

        <p>
            If created on demand, the inititialisation of the hypothetical Module would be something like:
        </p>

        <pre><code class = "language-javascript">
            var module = new Responsiville.Module({
                element : '.responsiville-module',
                debug   : true
            });
        </code></pre>



        <h2>Responsive behaviour</h2>

        <p>
            We covered how the framework is installed, configured and initialised in the first chapters of this documentation. It is worth to stretch once again the <strong>responsive behaviour</strong> of the framework.
        </p>

        <p>
            Every Responsiville module is responsive. This means that every module has knowledge of it&apos;s responsive state, ie the <strong>breakpoint</strong> that the browser window/screen is in, and that it can respond to its changes. From the moment the page begins to load the framework keeps track of its breakpoint and its changes. Through a simple event handling mechanism the modules are able to react to the breakpoint changes and adapt accordingly.
        </p>

        <p>
            Responsiville modules generally share the following behaviour which is exposed in Javascript functions:
        </p>

        <dl>
            <dt>init</dt>
            <dd>
                The general inititialisation process of the module. Simply prepares it for its purpose. Does not enable it or activate it yet.
            </dd>
            <dt>enable/disable</dt>
            <dd>
                The process of enabling the module. Means that the module is in a breakpoint where it available to function. One of the basic notions of Responsiville modules is that they are enabled for some breakpoints and disabled for others, thus implementing responsive behaviour. For instance, a mobile burger menu might be enabled for usage in small screens, but be disabled and not available in bigger screens.
            </dd>
            <dt>activate/deactivate</dt>
            <dd>
                The process where the module actually does what it is supposed to do. For instance, a mobile burger menu, when activated, opens up to show its contents. The actual action depends on the module, of course.
            </dd>
            <dt>open/close</dt>
            <dd>
                Same as above, but refers to modules which actually have an open and closed state.
            </dd>
        </dl>



        <h2>Enter and leave settings</h2>

        <p>
            Two of the most common settings of all the Responsiville modules, which do have responsive behaviour are the <code>enter</code> and the <code>leave</code> settings. The first one represents the breakpoints where the module &quot;enters&quot;, which means that it is enabled and ready for usage and the second one represents the breakpoints where the module &quot;leaves&quot;, which means that it is disabled and non usable. What exactly makes sense each time depends on the specifics of each web design and its layout.
        </p>

        <p>
            This would look something like:
        </p>

        <pre><code class = "language-markup"><!--
            <div class="responsiville-module"

                 data-responsiville-module-enter="laptop, desktop, large, xlarge"
                 data-responsiville-module-leave="small, mobile, tablet">

                <div class="responsiville-module-child"></div>
                <div class="responsiville-module-child"></div>
                <div class="responsiville-module-child"></div>

            </div>
        --></code></pre>

        <p>
            One has to specify <strong>all</strong> the available breakpoints of the Responsiville framework as either <code>enter</code> or <code>leave</code> when overriding the default values.
        </p>

        <p>
            When created on demand, it would be something like:
        </p>

        <pre><code class = "language-javascript">
            var module = new Responsiville.Module({
                element : '.responsiville-module',
                enter   : 'laptop, desktop, large, xlarge',
                leave   : 'small, mobile, tablet'
            });
        </code></pre>



        <h2>Logging</h2>

        <p>
            All the Responsiville modules inherit all the functions from the <code>Responsiville.Debug</code> scope. This scopes works like an abstract class/interface, from which the modules inherit their basic logging mechanism. The whole framework itself, via its <code>Responsiville.Main</code> object, is based on this logging mechanism as well. Logging refers to the browser console.
        </p>



    </article>



<?php include( 'footer.php' ); ?>