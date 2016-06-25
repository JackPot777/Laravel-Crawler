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
					<h2>Crawler Lists <small>Last created at {{$lastCrawler->created_at}}</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content" style="display: block;">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th class="column-title">CrawlerID</th>
									<th class="column-title">Name</th>
									<th class="column-title">Description</th>
									<th class="column-title">Activated</th>
									<th class="column-title">MaxInstances</th>
									<th class="column-title">CompletedJobs</th>
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
									<td class="">{{$crawler->isactivated}}</td>
									<td class=" ">{{$crawler->maxinstances}}</td>
									<td class="">{{$crawler->completedjobs}}</td>
									<td class="">{{$crawler->updated_at}}</td>
									<td class=" last">
									<div class="btn-group">
									  <a href="{{url('/objectives/crawler/get/'.$crawler->id)}}" class="btn btn-primary btn-xs">Show Webcrawler Details</a>
									  <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
										<li>
											<a href="#">Show All Generated Crawlees</a>
										</li>
										<li>
											<a href="#">Show All Crawled Results</a>
										</li>
										<li>
										<a href="{{url('/objectives/crawler/edit/'.$crawler->id)}}">Edit crawler Structure</a>
										</li>
										<li class="divider"></li>
										<li>
										<a href="{{url('/objectives/crawler/softdelete/'.$crawler->id)}}">Delete</a>
										</li>
									  </ul>
									</div>
									</td>
								</tr>
								<?php $i++?>
								@endforeach
								<?php unset($i) ?>
							</tbody>
						</table>
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

