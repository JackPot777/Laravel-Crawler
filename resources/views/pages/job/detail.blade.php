@extends('master.dashboard')
@section('title','Web Crawler Panel - Job - '.$job->name)
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Job <small> Details </small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Job Status<small>Created at:{{$job->created_at}} Last updated at: {{$job->updated_at}}</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">{{$job->name}}</p>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Job ID</th>
                                        <td>{{$job->id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{$job->status}}</td>
                                    </tr>
                                    <tr>
                                        <th>Scheduled Datetime</th>
                                        <td>{{$job->scheduled_datetime}}</td>
                                    </tr>
                                    <tr>
                                        <th>Completed Datetime</th>
                                        <td>{{$job->completed_datetime}}</td>
                                    </tr>
                                    <tr>
                                        <th>Url</th>
                                        <td><a href="{{url('/objectives/url/get/'.$job->url()->first()->id)}}">#{{$job->url()->first()->id}}:{{$job->url()->first()->name}}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Crawler</th>
                                        <td>#{{$job->crawler()->first()->id}}:{{$job->crawler()->first()->name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Crawl Jobs <small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">{{$job->name}}</p>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Total Crawl Jobs</th>
                                        <td>{{$job->crawlJobs()->count()}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success"  style="min-width:5em;width: {{(int) $job->crawlJobs()->where('iscompleted',1)->count()/$job->crawlJobs()->count() *100 }}%;">
                                                    {{$job->crawlJobs()->where('iscompleted',1)->count()}}/
                                                    {{$job->crawlJobs()->count()}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="{{url('/crawljob/get/'.$job->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Show Crawl Job List</a>
                            @if (!$job->isActivated())
                            @if ($job->status == 'Completed' && $job->isRetriable())
                            <a href="{{url('/job/retry/'.$job->id)}}" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-beer"></i> Retry({{$job->getNumRetriableJobs()}})</a>
                            @elseif ($job->status != 'Completed')
                            <a href="{{url('/job/start/'.$job->id)}}" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-beer"></i> Start</a>
                            @endif
                            <a href="{{url('/job/delete/'.$job->id)}}" class="btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-remove"></i> delete</a>
                            @else
                            <a href="{{url('/job/pause/'.$job->id)}}" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-pause"></i> Pause</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
<!-- page content -->
@stop
