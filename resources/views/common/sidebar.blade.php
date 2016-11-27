<!--/. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    {{--<div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>--}}
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a href="{{ url('/') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
            </li>
            <li>
                <a href="{{ url('packages') }}"><i class="fa fa-dropbox"></i>Packages</a>
            </li>
            <li>
                <a href="{{ url('consumers') }}"><i class="fa fa-users"></i>Consumers</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-money"></i> Accounts <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    @if(isset(Auth::user()->admin->user_id))
                        <li>
                            <a href="#">Bill<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{ url('bills') }}">Bills</a>
                                </li>
                                <li>
                                    <a href="{{ url('bills/generate_bills') }}">Generate Bills</a>
                                </li>
                            </ul>

                        </li>
                    @else
                        <li>
                            <a href="{{ url('bills') }}">Bills</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ url('payments') }}">Payments</a>
                    </li>
                    <li>
                        <a href="{{ url('expences') }}">Expences</a>
                    </li>

                </ul>
            </li>
            @if(isset(Auth::user()->admin->user_id))
                <li>
                    <a href="#"><i class="fa fa-table"></i>Reports <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('bills_report') }}">Bills Report</a>
                        </li>
                        <li>
                            <a href="{{ url('payments_report') }}">Payments report</a>
                        </li>
                        <li>
                            <a href="{{ url('statement') }}">Statement</a>
                        </li>
                        <li>
                            <a href="{{ url('account_statement') }}">Account Statement</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="{{ url('consumer_requests') }}"><i class="fa  fa-share-alt "></i>Consumer Requests</a>
            </li>
            <li>
                <a href="{{ url('previous_consumers') }}"><i class="fa  fa-users "></i>Previous Consumers</a>
            </li>
            @if(isset(Auth::user()->admin->user_id))
            <li>
                <a href="#"><i class="fa fa-cog"></i>Settings <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('users') }}">Users</a>
                    </li>
                    <li>
                        <a href="{{ url('start_month') }}">Start Month</a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="#">Second Level Link</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Second Level Link<span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-third-level">--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level Link</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level Link</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Third Level Link</a>--}}
                    {{--</li>--}}

                    {{--</ul>--}}

                    {{--</li>--}}
                </ul>
            </li>
            @endif
        </ul>

    </div>

</nav>
<!-- /. NAV SIDE  -->
