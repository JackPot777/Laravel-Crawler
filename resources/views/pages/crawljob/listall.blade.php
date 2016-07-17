@extends('master.dashboard')
@section('title','Web Crawler Panel - Url - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Crawl Jobs <small> full list of the crawl jobs.</small></h3>
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
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Crawl Job Lists
						@if (isset($last))
							<small>Last created at {{$last->created_at}}</small>
						@endif
					</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" style="display: block;">
					<div class="table-responsive">
						@if (count($crawlJobs))
						<table class="table table-striped jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th class="column-title">CrawlJobID</th>
									<th class="column-title">Url</th>
									<th class="column-title">Html Title</th>
									<th class="column-title">Completed</th>
									<th class="column-title">Last Created</th>
									<th class="column-title">Last Modified</th>
									<th class="column-title no-link last"><span class="nobr">Action</span>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=0?>
								@foreach ($crawlJobs as $crawlJob)
								<tr class="{{$i%2?'even':'odd'}} pointer">
									<td>{{$crawlJob->id}}</td>
									<td>{{$crawlJob->url}}</td>
									<td>{{$crawlJob->html_title}}</td>
									<td>{{$crawlJob->iscompleted}}</td>
									<td>{{$crawlJob->created_at}}</td>
									<td>{{$crawlJob->updated_at}}</td>
									<td class="last">
										@if ($crawlJob->iscompleted)
										<a class="btn btn-xs btn-success" href="{{url('/crawljob/rawhtml/$crawljob->id')}}">Raw html</a>
										@else
										<a class="btn btn-xs btn-success" disabled="true" href="#">Raw html</a>
										@endif
									</td>
								</tr>
								<?php $i++?>
								@endforeach
								<?php unset($i) ?>
							</tbody>
						</table>
						@else
							<div class="alert alert-success" role="alert">Empty record.</div>
						@endif
					</div>
				</div>
				<center>
					{!! $crawlJobs->render() !!}
				</center>
			</div>
		</div>
		<br>
	</div>
</div>
<!-- page content -->
@stop
