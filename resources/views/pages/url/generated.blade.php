@extends('master.blank')
@section('title','Web Crawler')
@section('bodyContent')
<table class="table">
	<thead>
		<tr>
			<th style="width:auto">#</th>
			<th >Generated Url</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($entries as $url)
			<tr>
				<td>{{$url['id']}}</td>
				<td ><a href="{{$url['path']}}">{{$url['path']}}</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
<center>{!! $entries->appends(Input::except('page'))->render() !!}</center>
@stop
