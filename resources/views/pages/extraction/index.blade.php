@extends('master.dashboard')
@section('title','Web Crawler Panel - Website - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3> Extractions<small> full list of the extractions.</small></h3>
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
                    <h2> Extraction Lists
                        @if (isset($lastExtraction))
                        <small>Last created at {{$lastExtraction->created_at}}</small>
                        @endif
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                    <div class="table-responsive">
                    @if (count($extractions) > 0)
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">Extraction_id</th>
                                    <th class="column-title">Job_id</th>
                                    <th class="column-title">Name</th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Type</th>
                                    <th class="column-title">Rule</th>
                                    <th class="column-title">Created At</th>
                                    <th class="column-title">Updated At</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0?>
                                @foreach ($extractions as $extraction)
                                <tr class="{{$i%2?'even':'odd'}} pointer">
                                    <td class=" ">{{$extraction->id}}</td>
                                    <td class=" ">{{$extraction->job_id}}</td>
                                    <td class=" ">{{$extraction->name}}</td>
                                    <td class=" ">{{$extraction->description}}</td>
                                    <td class=" ">{{$extraction->type}}</td>
                                    <td class=" ">{{$extraction->rule}}</td>
                                    <td class=" ">{{$extraction->created_at}}</td>
                                    <td class=" ">{{$extraction->updated_at}}</td>
                                    <td class=" last">
                                        <div class="btn-group">
                                          <a href="#" class="btn btn-primary btn-xs">More</a>
                                          <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{url('/extractions/show/'.$extraction->id)}}">getJSON</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="{{url('extractions/delete/'.$extraction->id)}}">Delete</a>
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
                    @else
                    <div class="alert alert-success" role="alert">Empty  Extractions.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
</div>
<!-- page content -->
@stop