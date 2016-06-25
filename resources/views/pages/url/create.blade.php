@extends('master.dashboard')
@section('title','Web Crawler Panel - Website - Full List')
@section('bodyContent')
<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Url <small> createa an new entry.</small></h3>
		</div>
	</div>
	<div class="row">
		@if (count($sites) > 0)
		<form method="post" action="{{url('/objectives/url/create')}}" class="form-horizontal form-label-left input_mask">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Step 1: Website Selction<small> select a website you want to crawl.</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br>
						{!! csrf_field() !!}
						@if (count($errors))
							 @foreach($errors->all() as $error)
							 <div class="alert alert-danger" role="alert">{{ $error }}</div>
							 @endforeach
						@endif
						<div class="form-group" id="select_website" {!! old('site_id')!==null?'style="display:none"':'' !!}>
						  <label class="control-label col-md-2 col-sm-2 col-xs-12">Select Website</label>
						  <div class="col-md-10 col-sm-10 col-xs-12">
						  <select  onChange="getSite(this.value);" name="site_id" class="form-control">
							<option>Choose Website</option>
							@foreach ($sites as $site)
								<option {{old('site_id')!==null&&old('site_id')==$site->id?'selected':''}} value="{{$site->id}}">{{'#' . $site->id . ' ' .$site->name}}</option>
							@endforeach
						  </select>
						  </div>
						</div>
						<div id="website_info" {!! old('site_id')!==null?'style="display:block"':'style="display:none"' !!}>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									<input type="text" id="site_name" name="site_name" readonly="readonly" class="form-control" value="{{ old('site_name')  }}" placeholder="Source Website Name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Root Url</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									<input type="text" id="site_root_url" name="site_root_url" readonly="readonly" class="form-control" value="{{ old('site_root_url')  }}" placeholder="http://www.google.com">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Description</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									<input type="text" id="site_desc" name="site_desc" readonly="readonly" class="form-control" value="{{ old('site_desc') }}" placeholder="Website description">
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
									<button type="button" {!! old('site_id')!==null?'style="display:none"':'' !!} onclick="$('#select_website').hide();$(this).hide();$('#url_builder').show();" class="btn btn-success">Confirm</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="url_builder" class="col-md-10 col-md-offset-1 col-xs-12" {!! old('site_id')!==null?'style="display:block"':'style="display:none"' !!}>
			  <div class="x_panel">
				<div class="x_title">
				  <h2>Step 2: Url Entry<small> Fillin url name and setup pattern.</small></h2>
				  <div class="clearfix"></div>
				</div>
				<div class="x_content">
				  <br>
					<div class="form-group">
					  <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
					  <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Url Name">
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-md-2 col-sm-2 col-xs-12">Url Structure</label>
					  <div class="col-md-5 col-sm-5 col-xs-6">
						  <div class="radio">
							<input class="styled" type="radio" class="form-control" name="type" {{old('type')=='Simple'?'checked':''}}  onclick="$('#param_settings').hide()" value="Simple" checked> <label>Simple</label>
						  </div>
					  </div>
					  <div class="col-md-5 col-sm-5 col-xs-6">
						<div class="radio">
						  <input type="radio" class="styled" class="form-control" name="type" {{old('type')=='Simple_Custom'?'checked':''}} onclick="$('#param_settings').show()" value="Simple_Custom"> <label>Custom</label>
						</div>
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-md-2 col-sm-2 col-xs-12">Url</label>
					  <div class="col-md-10 col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="original_url" value="{{old('original_url')}}" placeholder="http://www.laravel.com/docs/5.1">
					  </div>
					</div>
					<div id="param_settings" class="form-group" {!! old('type')=='Simple_Custom'?'style="display:block"':'style="display:none"' !!}>
					  <label class="control-label col-md-2 col-sm-2 col-xs-12">Parameter Settings</label>
					  <div class="col-md-10 col-sm-10 col-xs-12">
						<textarea class="form-control" class="form-control" value="{{old('settings')}}" style="resize:none" row="5" name="settings" placeholder="settings_in_json"></textarea>
					  </div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
							<button type="cancel" class="btn btn-primary">Cancel</button>
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</div>
			  </div>
			</div>
		</form>
		@endif
		<br>
	</div>
</div>
<!-- page content -->
@stop
