@extends('master.dashboard')
@section('title','Web Crawler Panel - Crawler - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Crawler <small> full list of the crawler.</small></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Crawler Lists
						@if (isset($lastCrawler))
							<small>Last created at {{$lastCrawler->created_at}}</small>
						@endif
					</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" style="display: block;">
					<div class="table-responsive">
						@if (count ($errors))
							<div class="row">
							@foreach ($errors as $error)
								<div class="alert alert-danger">{{$error}}</div>
							@endforeach
							</div>
						@endif
						@if (count ($crawlers))
						<table class="table table-striped jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th class="column-title">CrawlerID</th>
									<th class="column-title">Name</th>
									<th class="column-title">Description</th>
									<th class="column-title">Activated</th>
									<th class="column-title">MaxInstances</th>
									<th class="column-title">Current Job</th>
									<th class="column-title">Last Modified</th>
									<th class="column-title no-link last"><span class="nobr">Action</span>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=0?>
								@foreach ($crawlers as $crawler)
								<tr class="{{$i%2?'even':'odd'}} pointer">
									<td class=" ">{{$crawler->id}}</td>
									<td class=" ">{{$crawler->name}}</td>
									<td class=" ">{{$crawler->desc}}</td>
									<td class="">{!!$crawler->isactivated?'<span class="label label-success"><span class="fa fa-toggle-on"></span> ON</span>':'<span class="label label-danger"><span class="fa fa-toggle-off"></span> OFF</span>'!!}</td>
									<td class=" ">{{$crawler->maxinstances}}</td>
									<td class="">{!!$crawler->job()->first()==null?'<span class="label label-danger">None</span>':'<span class="label label-success">'.$crawler->job()->first()->name.'</span>'!!}</td>
									<td class="">{{$crawler->updated_at}}</td>
									<td class=" last">
									@if ($crawler->isactivated)
										<a class="btn btn-xs btn-danger" href="{{url('crawler/delete/'.$crawler->id)}}">Remove</a>
									@else
										<span class="label label-info">In Process</span>
									@endif
									</td>
								</tr>
								<?php $i++?>
								@endforeach
								<?php unset($i) ?>
							</tbody>
						</table>
						@else
							<div class="alert alert-success" role="alert">Empty crawler records.</div>
						@endif
					</div>
				</div>
				<center>
					{!! $crawlers->render() !!}
				</center>
			</div>
		</div>
		<br>
	</div>
</div>
<!-- page content -->
@stop

