<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
	<h3>Objectives</h3>
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
	  <li><a><i class="fa fa-edit"></i> Crawlee <span class="fa fa-chevron-down"></span></a>
	  <ul class="nav child_menu">
		<li><a href="{{url('/objectives/crawlee/list')}}">Full List</a></li>
		<li><a href="{{url('/objectives/crawlee/trashbin')}}">Show Trashbin</a></li>
	  </ul>
	  </li>
	</ul>
	</div>
	<div class="menu_section">
	<h3> Crawler </h3>
	<ul class="nav side-menu">
	  <li><a href="{{url('/crawler/settings')}}"><i class="fa fa-edit"></i> Settings </a></li>
	  <li><a><i class="fa fa-edit"></i> Crawl Jobs <span class="fa fa-chevron-down"></span></a>
	  <ul class="nav child_menu">
		<li><a href="{{url('/objectives/crawleeresult/create')}}">Create</a></li>
		<li><a> Job Listing <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
				<li class="sub_menu"><a href="{{url('/objectives/crawleeresult/list/tobedone')}}">To Be Done(Not Timed)</a></li>
				<li><a href="{{url('/objectives/crawleeresult/list/processing')}}">Scheduled</a></li>
				<li><a href="{{url('/objectives/crawleeresult/list/completed')}}">Completed</a></li>
			</ul>
		</li>
		<li><a href="{{url('/objectives/crawleeresult/trashbin')}}">Show Trashbin</a></li>
	  </ul>
	  </li>
	  <li><a><i class="fa fa-edit"></i> Raw Data <span class="fa fa-chevron-down"></span></a>
	  <ul class="nav child_menu">
		<li><a href="{{url('/crawler/rawdata/list')}}">Full List</a></li>
		<li><a href="{{url('/crawler/rawdata/trashbin')}}">Show Trashbin</a></li>
	  </ul>
	  </li>
	</ul>
	</div>
	</ul>
  </div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Settings">
	<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a href="javascript:requestFullScreen(document.documentElement);" data-toggle="tooltip" data-placement="top" title="FullScreen">
	<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a href="#//todo" data-toggle="tooltip" data-placement="top" title="Lock">
	<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a>
  <a href="/user/logout" data-toggle="tooltip" data-placement="top" title="Logout">
	<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->
