<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3> Objectives</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Website <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{url('/objectives/site/create')}}">Create Entry</a></li>
                    <li><a href="{{url('/objectives/site/list')}}">Full List</a></li>
                    <li><a href="{{url('/objectives/site/trashbin')}}">Show Trashbin</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> URL <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{url('/objectives/url/create')}}">Create Entry</a></li>
                    <li><a href="{{url('/objectives/url/list')}}">Full List</a></li>
                    <li><a href="{{url('/objectives/url/trashbin')}}">Show Trashbin</a></li>
                </ul>
            </li> 
            <li><a><i class="fa fa-edit"></i> Crawler <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{url('/crawler/create')}}"><i class="fa fa-edit"></i> Create Entry </a></li>
                    <li><a href="{{url('/crawler/list')}}"><i class="fa fa-edit"></i> Full List </a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="menu_section">
        <h3> Dispatch Jobs </h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-edit"></i> Crawl Jobs <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{url('/job/create')}}">Create</a></li>
                    <li><a> Job Listing <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu">
                                <li><a href="{{url('/job/list/all')}}">All</a></li>
                                <li><a href="{{url('/job/list/tobedone')}}">To Be Done</a></li>
                                <li><a href="{{url('/job/list/scheduled')}}">Scheduled</a></li>
                                <li><a href="{{url('/job/list/completed')}}">Completed</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Raw Data Crawl Job <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{url('/crawljob/list')}}">Full List</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Regex Extraction <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{url('/extractions')}}">Full List</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a href="{{url('/system/setting')}}" data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a href="javascript:requestFullScreen(document.documentElement);" data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a href="{{url('/user/profile')}}" data-toggle="tooltip" data-placement="top" title="Profile">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
    </a>
    <a href="/user/logout" data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
