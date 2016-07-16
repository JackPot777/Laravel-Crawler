@extends('master.dashboard')
@section('title','Web Crawler Panel')

@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
	  <div class="page-title">
		<div class="title_left">
		  <h3>Dashboard <small>shows all of your crawl jobs status in one page.</small></h3>
		</div>
		<div class="title_right">
		  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			<div class="input-group">
			  <input type="text" class="form-control" placeholder="Search for...">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button">Go!</button>
			  </span>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  <div class="row tile_count">
	<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-bug"></i>  Websites</span>
	  <div class="count">{{$sites['all']['num']}}</div>
	  @if (isset($sites['last']))
		<span class="count_bottom"><span class="label label-info">{{mb_strlen($sites['last']->name)<=40?$sites['last']->name:mb_substr($sites['last']->name,0,39).'...'}}</span> - {{$sites['last']->created_at->format('Y-m-d')}}</span>
	  @endif
	</div>
	<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-link"></i> Urls</span>
	  <div class="count">{{$urls['all']['num']}}</div>
	  @if (isset($urls['last']))
	 	  <span class="count_bottom"><span class="label label-success">{{mb_strlen($urls['last']->name)<=40?$urls['last']->name:mb_substr($urls['last']->name,0,39).'...'}}</span> - {{$urls['last']->created_at->format('Y-m-d')}}</span>
	  @endif
	</div>
	<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-dot-circle-o"></i> Crawlers</span>
	  <div class="count">{{$crawlers['all']['num']}}</div>
	  @if (isset($crawlers['last']))
		  <span class="count_bottom"><a href="#" data-toggle="tooltip" title="Total number of activated crawlers"><span class="label label-success"><span class="fa fa-toggle-on"></span> {{$crawlers['activated']['num']}}</span></a> <a href="#" data-toggle="tooltip" title="Total number of unactivated crawlers"><span class="label label-danger"><span class="fa fa-toggle-off"></span> {{$crawlers['all']['num']-$crawlers['activated']['num']}}</span></a> - {{$crawlers['last']->updated_at}}</span>
	  @endif
	</div>
	<div class="col-md-3 col-sm-12 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-bullseye"></i> Crawl Jobs</span>
	  <div class="count">{{$jobs['all']['num']}}</div>
	  @if (isset($jobs['last']))
		  <span class="count_bottom">
		  <a href="#" data-toggle="tooltip" title="Total number of completed jobs"><span class="label label-success"><span class="fa fa-check-square"></span> {{$jobs['completed']['num']}}</span></a>
		  <a href="#" data-toggle="tooltip" title="Total number of to be done jobs"><span class="label label-warning"><span class="fa fa-download"></span> {{$jobs['toBeDone']['num']}}</span></a> 
		  <a href="#" data-toggle="tooltip" title="Total number of scheduled jobs"><span class="label label-info"><span class="fa fa-clock-o"></span> {{$jobs['scheduled']['num']}}</span></a>
		   - {{$jobs['last']->updated_at}}</span>
	  @endif
	</div>
  </div>
</div>
<br>
<!-- page content -->
@stop
