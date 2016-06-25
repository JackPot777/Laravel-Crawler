@extends('master.dashboard')
@section('title','Web Crawler Panel - Website - Full List')
@section('bodyContent')<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Website <small> full list of the website.</small></h3>
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
                    <h2>Website Lists <small>Last created at {{$lastSite->created_at}}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">SiteID</th>
                                    <th class="column-title">Name</th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Root Url</th>
                                    <th class="column-title">Total URLs</th>
                                    <th class="column-title">Created At</th>
                                    <th class="column-title">Updated At</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $i=0?>
								@foreach ($sites as $site)
                                <tr class="{{$i%2?'even':'odd'}} pointer">
                                    <td class=" ">{{$site->id}}</td>
                                    <td class=" ">{{$site->name}}</td>
                                    <td class=" ">{{$site->desc}}</td>
                                    <td class=" ">{{$site->root_url}}</td>
                                    <td class="a-right">{{$site->url()->count()}}</td>
                                    <td class="">{{$site->created_at}}</td>
                                    <td class="">{{$site->updated_at}}</td>
                                    <td class=" last">
									<div class="btn-group">
				                      <a href="{{url('/objectives/site/get/'.$site->id)}}" class="btn btn-primary btn-xs">Show Website Details</a>
				                      <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				                        <span class="caret"></span>
				                        <span class="sr-only">Toggle Dropdown</span>
				                      </button>
				                      <ul class="dropdown-menu" role="menu">
										<li>
											<a href="{{url('/objectives/url/list/'.$site->id)}}">Show All URLs</a>
				                        </li>
										<li>
											<a href="#">Show All Crawlees</a>
				                        </li>
										<li>
											<a href="#">Show All Crawled Results</a>
				                        </li>
										<li>
										<a href="{{url('/objectives/site/edit/'.$site->id)}}">Edit Website Metadata</a>
										</li>
				                        <li class="divider"></li>
										<li>
										<a href="{{url('/objectives/site/softdelete/'.$site->id)}}">Delete</a>
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
					{!! $sites->render() !!}
				</center>
            </div>
        </div>
        <br>
    </div>
</div>
<!-- page content -->
@stop