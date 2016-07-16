@extends('master.dashboard')
@section('title','Web Crawler Panel - Site - ' . $site->name)
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Site <small> Details</small></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Website <small>Created at: {{$site->created_at}} Last updated at: {{$site->updated_at}}</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row">
						<div class="col-xs-12">
							<p class="lead">{!! $site->trashed()?'<label class="label label-warning">Trashed</label>':'' !!} {{$site->name}}</p>
							<table class="table table-striped">
							  <tbody>
								<tr>
								  <th width="20%">Website ID</th>
								  <td>{{$site->id}}</td>
								</tr>
								<tr>
								  <th>Root Url</th>
								  <td>{{$site->root_url}}</td>
								</tr>
								<tr>
								  <th>Description</th>
								  <td>{{$site->desc}}</td>
								</tr>
							  </tbody>
							</table>
						</div>
					</div>
					<div class="row no-print">
						<div class="col-xs-12">
						  <a href="{{url('/objectives/site/forcedelete/'.$site->id)}}" class="btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-remove"></i> Force Delete</a>
						  <a href="{{url('/objectives/site/restore/'.$site->id)}}" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> Restore</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
	</div>
@foreach ($site->urls()->withTrashed()->get() as $url)
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Url Structure <small>Created at: {{$url->created_at}} Last updated at: {{$url->updated_at}}</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row">
						<div class="col-xs-12">
							<p class="lead">{!!$url->trashed()?'<label class="label label-warning">Trashed</label>':''!!} {{$url->name}} </p>
							<table class="table table-striped">
							  <tbody>
								<tr>
								  <th width="20%">Url ID</th>
								  <td>{{$url->id}}</td>
								</tr>
								<tr>
								  <th>Original Url</th>
								  <td>{{$url->original_url}}</td>
								</tr>
								@if ($url->settings != null)
									<tr>
									  <th>Settings</th>
										<?php
											$jSettings = json_decode($url->settings,1);
										?>
										<td>
										@foreach ($jSettings as $name => $param)
											Replacement Name:{{$name}}</br>
											Type:{{$param['type']}}</br>
											@if ($param['type'] == 'number')
												Start : {{$param['start']}}</br>
												End : {{$param['end']}}
											@elseif ($param['type'] == 'string')
												Combination : 
											@foreach ($param['combination'] as $combination)
												<strong>{{$combination}}</strong> &nbsp;
											@endforeach
											@endif
										<hr>
										@endforeach
										</td>
									</tr>
								@endif
								<tr>
								  <th>Jobs</th>
								  <td>{{$url->jobs()->get()}}</td>
								</tr>
							  </tbody>
							</table>
						</div>
					</div>
					<div class="row no-print">
						<div class="col-xs-12">
						  <a href="{{url('/objectives/url/generate/'.$url->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Show Generated Urls</a>
						@if ($url->trashed())
						  <a href="{{url('/objectives/url/forcedelete/'.$url->id)}}" class="btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-remove"></i> Force Delete</a>
						  <a href="{{url('/objectives/url/restore/'.$url->id)}}" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-save"></i> Restore</a>
						@else
						  <a href="{{url('/objectives/url/softdelete/'.$url->id)}}" class="btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-remove"></i> Soft Delete</a>
						@endif
						</div>
					  </div>
					</div>
			</div>
		</div>
		<br>
	</div>
@endforeach
</div>
<!-- page content -->
@stop

