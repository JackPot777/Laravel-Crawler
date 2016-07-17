@extends('master.blank')
@section('title','Web Crawler - Crawl Job List')
@section('bodyContent')
<h1>
    # {{$crawlJobs[0]->job_id}} - {{$crawlJobs[0]->job()->first()->name}} 
    <small>
        created at:
        {{$crawlJobs[0]->job()->first()->created_at}} 
        updated at:
        {{$crawlJobs[0]->job()->first()->updated_at}}
    </small>
</h1>
<table class="table">
    <thead>
        <tr>
            <th style="width:auto">#</th>
            <th>Crawl Job Url</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($crawlJobs as $crawlJob)
            <tr>
                <td>{{$crawlJob['id']}}</td>
                <td><a href="{{$crawlJob['url']}}">{{$crawlJob['url']}}</a></td>
                <td>
                    @if ($crawlJob['iscompleted'])
                    <label class="label label-success">Completed</label>&nbsp;
                    @else
                    <label class="label label-danger">Incomplete</label>&nbsp;
                    @endif
                </td>
                <td>
                    @if ($crawlJob['iscompleted'])
                    <a class="btn btn-xs btn-success" href="{{url('/crawljob/rawhtml/'.$crawlJob->id)}}">Raw Html</a>
                    @else
                    <a class="btn btn-xs btn-success" disabled="true" href="#">Raw Html</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<center>{!! $crawlJobs->render()  !!}</center>
@stop
