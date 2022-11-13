@include('components.header')

<input type="hidden" id="key" value="{{ $key }}" />

<div>
    <ul>
        <li>
            Type <span class="code">1</span>, space, you comment then <span class="code">enter</span> to create a "went well" card
            <br />
            ie: <span class="vci-code-example">1 I like my office chair</span>
        </li>

        <li>
            Type <span class="code">2</span>, space, you comment then <span class="code">enter</span> to create a "could be better" card
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


@include('components.footer')



