@extends('master.dashboard')
@section('title','Web Crawler Panel')

@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
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
  <div class="row tile_count">
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-bug"></i> Total Websites</span>
	  <div class="count">{{$numSites}}</div>
	  <span class="count_bottom"><span class="green">{{$lastSite->created_at->format('Y-m-d')}}</span> - {{mb_strlen($lastSite->name)<=27?$lastSite->name:mb_substr($lastSite->name,0,26).'...'}}</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-link"></i> Total Urls</span>
	  <div class="count">{{$numUrls}}</div>
	  <span class="count_bottom"><span class="green">{{$lastUrl->created_at->format('Y-m-d')}}</span> - {{mb_strlen($lastUrl->name)<=27?$lastUrl->name:mb_substr($lastUrl->name,0,26).'...'}}</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-dot-circle-o"></i> Total Crawlees</span>
	  <div class="count">{{$numTtlCrawlees}}</div>
	  <span class="count_bottom"><span class="green">{{$numCreatedUrlCrawlees}} Crawlees </span> - {{$lastCreatedCrawlees->url()->first()->name}}</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-bullseye"></i> To Be Done Crawl Jobs</span>
	  <div class="count">{{$numToBeDoneCrawlJobs}}</div>
	  @if ($numToBeDoneCrawlJobs > 0)
		  <span class="count_bottom"><span class="green">{{$lastCreatedTBDCrawlJobs->created_at}} - {{$lastCreatedTBDCrawlJobs->html_title}}</span>
	  @endif
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-product-hunt"></i> Processing Crawl Jobs</span>
	  <div class="count">{{$numProcessingCrawlJobs}}</div>
	  @if ($numProcessingCrawlJobs > 0)
		  <span class="count_bottom"><span class="green">{{$lastCreatedProcessingCrawlJobs->created_at}} - {{$lastCreatedProcessingCrawlJobs->html_title}}</span>
	  @endif
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
	  <span class="count_top"><i class="fa fa-list"></i> Completed Crawl Jobs</span>
	  <div class="count">{{$numCompletedCrawlJobs}}</div>
	  @if ($numCompletedCrawlJobs > 0)
		  <span class="count_bottom"><span class="green">{{$lastCreatedCompletedCrawlJobs->created_at}} - {{$lastCreatedCompletedCrawlJobs->html_title}}</span>
	  @endif
	</div>
	<br>
  </div>
</div>
<!-- page content -->
@stop
