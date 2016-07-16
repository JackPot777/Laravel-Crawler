@extends('master.dashboard')
@section('title','Web Crawler Panel - Website - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Website <small> Create an entry.</small></h3>
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
                    <h2>Website New Entry<small> Application form</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="post" action="{{url('/objectives/site/create')}}" class="form-horizontal form-label-left input_mask">
                        {!! csrf_field() !!}
            			@if (count($errors))
            			     @foreach($errors->all() as $error)
            			     <div class="alert alert-danger" role="alert">{{ $error }}</div>
            			     @endforeach
            			@endif
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Source Website Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Root Url</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="root_url" class="form-control" value="{{old('root_url')}}" placeholder="http://www.google.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Description</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="desc" class="form-control" value="{{old('desc')}}" placeholder="Website description">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
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
