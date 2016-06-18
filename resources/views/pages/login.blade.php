@extends('master.blank')
@section('title','Web Crawler')
@section('bodyContent')
<div>
	<a class="hiddenanchor" id="signup"></a>
	<a class="hiddenanchor" id="signin"></a>
	<div class="login_wrapper">
		<div class="animate form login_form">
		<h1 class="text-center"><i class="fa fa-paw"></i> Universal Crawler</h1>
		<section class="login_content">
			<form method="post" action="/user/login">
			{!! csrf_field() !!}
			<h1>Login Now</h1>
			@if (count($errors))
			     @foreach($errors->all() as $error)
			     <div class="alert alert-danger" role="alert">{{ $error }}</div>
			     @endforeach
			@endif
			<div>
				<input type="email" name="email" class="form-control" placeholder="Email" required="" />
			</div>
			<div>
				<input type="password" name="password" class="form-control" placeholder="Password" required="" />
			</div>
			<div>
				<div class="pull-left">
					<div class=" form-group ">
						<input type="checkbox" name="remember" id="cb-remember" autocomplete="off" />
						<div class=" btn-group ">
							<label for="cb-remember" class=" btn btn-default ">
								<span class=" glyphicon glyphicon-ok "></span>
								<span> </span>
							</label>
							<label for="cb-remember" class=" btn btn-default active ">
								Remember Me
							</label>
						</div>
					</div>
				</div>
				<div class="pull-right">
					<button type="submit" class="btn btn-default submit">Log In</button>
				</div>
				<!--<a class="reset_pass" href="#">Lost your password?</a>-->
			</div>
			<div class="clearfix"></div>
			<div class="separator">
				<p class="change_link">New to site?
				<a href="#signup" class="to_register"> Create Account </a>
				</p>
				<div class="clearfix"></div>
				<div>
				<p>©2016 All Rights Reserved.</p>
				</div>
			</div>
			</form>
		</section>
		</div>
		<div id="register" class="animate form registration_form">
		<h1 class="text-center"><i class="fa fa-paw"></i> Universal Crawler</h1>
		<section class="login_content">
			<form method="post" action="/user/register">
			{!! csrf_field() !!}
			<h1>Create Account</h1>
			<div>
				<input type="text" name="name" class="form-control" placeholder="Name" required="" />
			</div>
			<div>
				<input type="email" name="email" class="form-control" placeholder="Email" required="" />
			</div>
			<div>
				<input type="password" name="password" class="form-control" placeholder="Password" required="" />
			</div>
			<div>
				<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required="" />
			</div>
			<div>
				<button class="btn btn-default submit">Register</button>
				<!--<a class="btn btn-default submit" href="index.html">Submit</a>-->
			</div>
			<div class="clearfix"></div>
			<div class="separator">
				<p class="change_link">Already a member ?
				<a href="#signin" class="to_register"> Log in </a>
				</p>
				<div class="clearfix"></div>
				<div>
				<p>©2016 All Rights Reserved.</p>
				</div>
			</div>
			</form>
		</section>
		</div>
	</div>
</div>
@stop
