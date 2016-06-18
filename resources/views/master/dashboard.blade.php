<!DOCTYPE html>
<html>
	@include('includes.header')
	<body class="nav-md">
		<div class="container body">
		  <div class="main_container">
			<div class="col-md-3 left_col menu_fixed">
			  <div class="left_col scroll-view">
				<div class="navbar nav_title" style="border: 0;">
				  <a href="{{url('/dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>Universal Crawler</span></a>
				</div>
				<div class="clearfix"></div>
					@include('includes.sidebar')
				</div>
			</div>
			@include('includes.topbar')
			@section('bodyContent')
			@show
			@include('includes.footer')
			</div>
		</div>
		@include('includes.endloadscript')
	</body>
</html>
