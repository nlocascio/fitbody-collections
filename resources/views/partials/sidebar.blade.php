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

    @if (Auth::check())
        <div class="collapse nav-toggleable-sm" id="nav-toggleable-sm">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-header">Dashboards</li>
                <li class="@if (Request::is('/dashboard')) active @endif">
                    <a href="/dashboard">Home</a>
                </li>
                <li class="@if (Request::is('customers'))) active @endif">
                    <a href="/customers">Customers</a>
                </li>
                <li class="@if (Request::is('letters/*')) active @endif">
                    <a href="/letters">Letters</a>
                </li>
                <li class="@if (Request::is('emails/*')) active @endif">
                    <a href="/emails">Emails</a>
                </li>


                <li class="nav-header">Settings</li>
                <li class="@if (Request::is('template')) active @endif">
                    <a href="/template">
                        Templates
                    </a>
                </li>

                <li class="nav-header">Account</li>
                <li>
                    <a href="{{ route('auth.logout') }}">Log Out</a>
                </li>

            </ul>
            <hr class="visible-xs m-t">
        </div>
    @endif
</nav>