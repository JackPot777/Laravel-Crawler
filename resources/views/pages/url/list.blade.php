@extends('master.dashboard')
@section('title','Web Crawler Panel - Url - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Url <small> full list of the weburl.</small></h3>
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
                    <h2>Url Lists <small>Last created at {{$lastUrl->created_at}}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">UrlID</th>
                                    <th class="column-title">Site Name</th>
                                    <th class="column-title">Url Name</th>
                                    <th class="column-title">Original Url</th>
                                    <th class="column-title">Type</th>
                                    <th class="column-title">Last Modified</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $i=0?>
								@foreach ($urls as $url)
                                <tr class="{{$i%2?'even':'odd'}} pointer">
                                    <td class=" ">{{$url->id}}</td>
                                    <td class=" ">{{$url->site()->first()->name}}</td>
                                    <td class=" ">{{$url->name}}</td>
                                    <td class=" ">{{$url->original_url}}</td>
                                    <td class="">{{$url->type}}</td>
                                    <td class="">{{$url->updated_at}}</td>
                                    <td class=" last">
									<div class="btn-group">
				                      <a href="{{url('/objectives/url/get/'.$url->id)}}" class="btn btn-primary btn-xs">Show Weburl Details</a>
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
										<a href="{{url('/objectives/url/edit/'.$url->id)}}">Edit Url Structure</a>
										</li>
				                        <li class="divider"></li>
										<li>
										<a href="{{url('/objectives/url/softdelete/'.$url->id)}}">Delete</a>
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
					{!! $urls->render() !!}
				</center>
            </div>
        </div>
        <br>
    </div>
</div>
<!-- page content -->
@stop
