@extends('master.dashboard')
@section('title','Web Crawler Panel - Website - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3> Regex Rextraction<small> Create an entry.</small></h3>
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
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Extraction New Entry<small> Application form</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="post" action="{{url('/extractions/store')}}" class="form-horizontal form-label-left input_mask">
                        {!! csrf_field() !!}
                        @if (count($errors))
                             @foreach($errors->all() as $error)
                             <div class="alert alert-danger" role="alert">{{ $error }}</div>
                             @endforeach
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Job Target</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select class="form-control" name="job_id">
                                    <option>Select...</option>
                                    @foreach (\App\Model\Crawler\Job::get() as $job)
                                        <option value="{{$job->id}}">{{$job->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Extraction Set Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Description</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="description" class="form-control" value="{{old('description')}}" placeholder="Extraction Set Description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Type</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                            <select class="form-control" name="type">
                                <option>Select...</option>
                                <option value="css-selector">CSS Selector</option>
                                <option value="regex">Regex</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Rule</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="rule" class="form-control" value="{{old('rule')}}" placeholder="Rule">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="button" class="btn btn-info pull-left">Test</button>
                                <button type="submit" class="btn btn-success pull-right">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
<!-- page content -->
@stop