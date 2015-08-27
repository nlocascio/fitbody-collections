<nav class="sidebar-nav">
    <div class="sidebar-header">
        <button class="nav-toggler nav-toggler-sm sidebar-toggler" type="button" data-toggle="collapse"
                data-target="#nav-toggleable-sm">
            <span class="sr-only">Toggle nav</span>
        </button>
        <a class="sidebar-brand" href="/">
                <span class="icon icon-tree sidebar-brand-icon"></span>
        </a>
    </div>

    <div class="collapse nav-toggleable-sm" id="nav-toggleable-sm">
        <ul class="nav nav-pills nav-stacked">
            <li class="nav-header">Dashboards</li>
            <li class="@if (Request::is('/')) active @endif">
                <a href="/">Home</a>
            </li>
            <li class="@if (Request::is('customer')) active @endif">
                <a href="/customer">Customers</a>
            </li>
            <li class="@if (Request::is('customer/*/letter*')) active @endif">
                <a href="/customer/*/letter">Letters</a>
            </li>
            <li class="@if (Request::is('customer/*/email*')) active @endif">
                <a href="/customer/*/email">Emails</a>
            </li>
            <li class="nav-header">Settings</li>
            {{--<li>--}}
                {{--<a href="#">--}}
                    {{--Account--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="@if (Request::is('template')) active @endif">
                <a href="/template">
                    Templates
                </a>
            </li>
        </ul>
        <hr class="visible-xs m-t">
    </div>
</nav>