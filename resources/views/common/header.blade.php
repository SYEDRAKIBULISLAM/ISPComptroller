<!-- Brand and toggle get grouped for better mobile display -->
<?php
use Carbon\Carbon;
$now = Carbon::now();
//$Previous5Days = $now->subDays(5);
$consumer_requests = \App\Consumer_request::orderBy('id', 'desc')->get();
?>
<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}"><strong>ISP Comptroller</strong></a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                @foreach($consumer_requests as $consumer_request)
                    @if (isset($consumer_requests->consumer->id))
                    <li>
                        <a href="#">
                            <div>
                                <strong>{{ $consumer_request->consumer->name }}</strong>
                                    <span class="pull-right text-muted">
                                        {{--<em>{{ ($consumer_request->date->diff($now->toDateString())->days < 1) ? 'today' : $consumer_request->date->diffForHumans($now->toDateString()); }}</em>--}}
                                        <em>{{ $consumer_request->date }}</em>

                                    </span>
                            </div>
                            <div>{{ $consumer_request->note }}</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    @endif
                @endforeach
                <li>
                    <a class="text-center" href="{{ url('consumer_requests/') }}">
                        <strong>Read All Messages</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        {{--<li class="dropdown">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">--}}
                {{--<i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu dropdown-tasks">--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<p>--}}
                                {{--<strong>Task 1</strong>--}}
                                {{--<span class="pull-right text-muted">60% Complete</span>--}}
                            {{--</p>--}}
                            {{--<div class="progress progress-striped active">--}}
                                {{--<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">--}}
                                    {{--<span class="sr-only">60% Complete (success)</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<p>--}}
                                {{--<strong>Task 2</strong>--}}
                                {{--<span class="pull-right text-muted">28% Complete</span>--}}
                            {{--</p>--}}
                            {{--<div class="progress progress-striped active">--}}
                                {{--<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width: 28%">--}}
                                    {{--<span class="sr-only">28% Complete</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<p>--}}
                                {{--<strong>Task 3</strong>--}}
                                {{--<span class="pull-right text-muted">60% Complete</span>--}}
                            {{--</p>--}}
                            {{--<div class="progress progress-striped active">--}}
                                {{--<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">--}}
                                    {{--<span class="sr-only">60% Complete (warning)</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<p>--}}
                                {{--<strong>Task 4</strong>--}}
                                {{--<span class="pull-right text-muted">85% Complete</span>--}}
                            {{--</p>--}}
                            {{--<div class="progress progress-striped active">--}}
                                {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">--}}
                                    {{--<span class="sr-only">85% Complete (danger)</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a class="text-center" href="#">--}}
                        {{--<strong>See All Tasks</strong>--}}
                        {{--<i class="fa fa-angle-right"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
            {{--<!-- /.dropdown-tasks -->--}}
        {{--</li>--}}
        <!-- /.dropdown -->
        {{--<li class="dropdown">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">--}}
                {{--<i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu dropdown-alerts">--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<i class="fa fa-comment fa-fw"></i> New Comment--}}
                            {{--<span class="pull-right text-muted small">4 min</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<i class="fa fa-twitter fa-fw"></i> 3 New Followers--}}
                            {{--<span class="pull-right text-muted small">12 min</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<i class="fa fa-envelope fa-fw"></i> Message Sent--}}
                            {{--<span class="pull-right text-muted small">4 min</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<i class="fa fa-tasks fa-fw"></i> New Task--}}
                            {{--<span class="pull-right text-muted small">4 min</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a href="#">--}}
                        {{--<div>--}}
                            {{--<i class="fa fa-upload fa-fw"></i> Server Rebooted--}}
                            {{--<span class="pull-right text-muted small">4 min</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li>--}}
                    {{--<a class="text-center" href="#">--}}
                        {{--<strong>See All Alerts</strong>--}}
                        {{--<i class="fa fa-angle-right"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
            {{--<!-- /.dropdown-alerts -->--}}
        {{--</li>--}}
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ url('myprofile/') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</nav>
