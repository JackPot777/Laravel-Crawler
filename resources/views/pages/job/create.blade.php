@extends('master.dashboard')
@section('title','Web Crawler Panel - Job - New Entry')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Job <small> Create an entry.</small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Job New Entry<small> Application form</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="post" action="{{url('/job/create')}}" class="form-horizontal form-label-left input_mask">
                        {!! csrf_field() !!}
            			@if (count($errors))
            			     @foreach($errors->all() as $error)
            			     <div class="alert alert-danger" role="alert">{{ $error }}</div>
            			     @endforeach
            			@endif
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="name" class="form-control" placeholder="Job Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Crawler</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								<select class="form-control" name="crawler_id">
								  @foreach ($crawlers as $crawler)
									<option value="{{$crawler->id}}">{{$crawler->name}}</option>
								  @endforeach
								</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Url</label>
							<div class="col-md-10 col-sm-10 col-xs-12">
								<select class="form-control" name="url_id">
								  @foreach ($urls as $url)
									<option value="{{$url->id}}">{{$url->name}}</option>
								  @endforeach
								</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Scheduled Datetime</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input id="scheduled_datetime" type="text" class="form-control" name="scheduled_datetime" >
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="cancel" class="btn btn-primary">Cancel</button>
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

@section('customScript')
<script>
$('#scheduled_datetime').datetimepicker({
minDate: new Date(),
format: 'Y-MM-DD HH:mm:ss'});
</script>
@stop
