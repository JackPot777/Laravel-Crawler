@extends('master.dashboard')
@section('title','Web Crawler Panel - Crawlee - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Crawlee <small> full list of the crawlee.</small></h3>
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
                    <h2>Crawlee Lists <small>Last created at {{$lastCrawlee->created_at}}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">CrawleeID</th>
                                    <th class="column-title">Site Name</th>
                                    <th class="column-title">UrlID</th>
                                    <th class="column-title">Generated Url</th>
                                    <th class="column-title">Last Modified</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $i=0?>
								@foreach ($crawlees as $crawlee)
                                <tr class="{{$i%2?'even':'odd'}} pointer">
                                    <td class=" ">{{$crawlee->id}}</td>
                                    <td class=" ">
                                        {{$crawlee->url()->first()->site()->first()->name}}
                                    </td>
                                    <td class=" ">{{$crawlee->url()->first()->id}}</td>
                                    <td class=" ">{{$crawlee->generated_url}}</td>
                                    <td class="">{{$crawlee->updated_at}}</td>
                                    <td class=" last">
									<div class="btn-group">
				                      <a href="{{url('/objectives/crawlee/get/'.$crawlee->id)}}" class="btn btn-primary btn-xs">Show Crawlee Details</a>
				                      <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				                        <span class="caret"></span>
				                        <span class="sr-only">Toggle Dropdown</span>
				                      </button>
				                      <ul class="dropdown-menu" role="menu">
										<li>
											<a href="#">Show All Crawled Results</a>
				                        </li>
				                        <li class="divider"></li>
										<li>
										<a href="{{url('/objectives/crawlee/softdelete/'.$crawlee->id)}}">Delete</a>
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
					{!! $crawlees->render() !!}
				</center>
            </div>
        </div>
        <br>
    </div>
</div>
<!-- page content -->
@stop
