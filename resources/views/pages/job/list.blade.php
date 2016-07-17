@extends('master.dashboard')
@section('title','Web Crawler Panel - Job - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Job <small> full list of the crawler.</small></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Job Lists
						@if ($last !=null)
						<small>Last created at {{$last->created_at}}</small>
						@endif
					</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" style="display: block;">
					<div class="table-responsive">
						@if (count($jobs))
						<table class="table table-striped jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th class="column-title">JobID</th>
									<th class="column-title">Name</th>
									<th class="column-title">CrawlerID</th>
									<th class="column-title">UrlID</th>
									<th class="column-title">Status</th>
									<th class="column-title">Scheduled Datetime</th>
									<th class="column-title">Completed Datetime</th>
									<th class="column-title">Last Modified</th>
									<th class="column-title no-link last"><span class="nobr">Action</span>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=0?>
								@foreach ($jobs as $job)
								<tr class="{{$i%2?'even':'odd'}} pointer">
									<td class=" ">{{$job->id}}</td>
									<td class=" ">{{$job->name}}</td>
									<td class=" ">{{$job->crawler_id}}</td>
									<td class=" ">{{$job->url_id}}</td>
									<td class=" ">{{$job->status}}</td>
									<td class=" ">{{$job->scheduled_datetime}}</td>
									<td class=" ">{{$job->completed_datetime}}</td>
									<td class="">{{$job->updated_at}}</td>
									<td class=" last">
									<div class="btn-group">
									  <a href="{{url('/job/get/'.$job->id)}}" class="btn btn-primary btn-xs">More</a>
									  <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
										<li>
											<a href="{{url('/crawljob/get/'.$job->id)}}">Show Crawl Job List</a>
										</li>
										@if ($job->status != 'Completed')
											@if ($job->status == 'ToBeDone')
												<li>
													<a href="{{url('/job/start/'.$job->id)}}">Start</a>
												</li>
											@else
												<li>
													<a href="{{url('/job/pause/'.$job->pause)}}">Pause</a>
												</li>
											@endif
										@endif
										@if (!$job->isActivated())
										<li class="divider"></li>
										<li>
										<a href="{{url('/job/delete/'.$job->id)}}">Forever Delete</a>
										</li>
										@endif
									  </ul>
									</div>
									</td>
								</tr>
								<?php $i++?>
								@endforeach
								<?php unset($i) ?>
							</tbody>
						</table>
						@else
							<div class="alert alert-success" role="alert">Empty jobs.</div>
						@endif
					</div>
				</div>
				<center>
					{!! $jobs ->render() !!}
				</center>
			</div>
		</div>
		<br>
	</div>
</div>
<!-- page content -->
@stop
