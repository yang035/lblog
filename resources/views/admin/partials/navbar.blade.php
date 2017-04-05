@if (Auth::check())
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/inspinia/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="/">Profile</a></li>
                            <li><a href="/">Contacts</a></li>
                            <li><a href="/">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="/auth/logout">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        Blog
                    </div>
                </li>
                <li class="active">
                    <a href="/"><i class="fa fa-table"></i> <span class="nav-label">BlogTables</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li @if (Request::is('admin/post*')) class="active" @endif>
                            <a href="/admin/post">Posts</a>
                        </li>
                        <li @if (Request::is('admin/tag*')) class="active" @endif>
                            <a href="/admin/tag">Tags</a>
                        </li>
                        <li @if (Request::is('admin/upload*')) class="active" @endif>
                            <a href="/admin/upload">Uploads</a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
@endif