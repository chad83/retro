@include('components.header')

<div>
    <ul>
        <li>
            Type <span class="code">1</span>, space, your comment then <span class="code">enter</span> to create a "went well" card
            <br />
            ie: <span class="vci-code-example">1 I like my office chair</span>
        </li>

        <li>
            Type <span class="code">2</span>, space, your comment then <span class="code">enter</span> to create a "could be better" card
            <br />
            ie: <span class="vci-code-example">2 it's too noisy at the office</span>
        </li>
    </ul>
</div>


<div class="vci_container">
    <div class="vci">
        <textarea id="vci_input" class="vci-input">#</textarea>
        <textarea id="vci_helper" class="vci-helper" readonly></textarea>
    </div>
</div>

<!-- Template to be copied -->
<div id="post_it_container" class="post-its-container">
    <div id="post_it_template" class="post-it template">
        <div class="header">X</div>
        <div class="text">EXAMPLE TEXT</div>
    </div>
</div>


@include('components.footer')



