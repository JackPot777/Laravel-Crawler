@extends('master.dashboard')
@section('title','Web Crawler Panel - Url - ' . $url->name)
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Url <small> {{$url->name}}</small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Url Details <small> Application form</small></h2>
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
                                <input type="text" name="name" class="form-control" placeholder="Source Website Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Root Url</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="root_url" class="form-control" placeholder="http://www.google.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Description</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="desc" class="form-control" placeholder="Website description">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
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
