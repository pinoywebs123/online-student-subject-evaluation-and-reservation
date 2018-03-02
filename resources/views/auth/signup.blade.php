@extends('template.default')

@section('styles')

<style type="text/css">
	a {
		
		color: gray;
	}
	.well{
		margin-top: 10%;
		
		
		/*border-top-right-radius: 100px;
		border-bottom-left-radius: 100px;*/
	}
	body{
		background-color: #2980b9;
	}
	img{
		margin-top: -60px;
	}
	#footerForm{

	}
</style>
@endsection


@section('contents')
<div class="container">
	<div class="col-md-10 col-md-offset-1 well" data-toggle="tooltip" title="{{Session::get('err')}}" data-placement="right">
		<center><a href="{{url('/')}}"><img src="{{URL::to('image/logo.png')}}" alt="Logo here" width="120px"></a></center>
		<form action="{{route('signup_check')}}" method="POST" autocomplete="off">
			<div class="col-md-6">
				<div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
					<label>First Name</label>
					<input type="text" name="first_name" class="form-control" maxlength="15" value="{{$errors->has('first_name') ? '' : old('first_name')}}">
					@if($errors->has('first_name'))
						<i class="help-block">{{$errors->first('first_name')}}</i>
					@endif
				</div>
				<div class="form-group {{$errors->has('middle_name') ? 'has-error' : ''}}">
					<label>Middle Name</label>
					<input type="text" name="middle_name" class="form-control" maxlength="15" value="{{$errors->has('middle_name') ? '' : old('middle_name')}}">
					@if($errors->has('middle_name'))
						<i class="help-block">{{$errors->first('middle_name')}}</i>
					@endif
				</div>
				<div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
					<label>Last Name</label>
					<input type="text" name="last_name" class="form-control" maxlength="15" value="{{$errors->has('last_name') ? '' : old('last_name')}}">
					@if($errors->has('last_name'))
						<i class="help-block">{{$errors->first('last_name')}}</i>
					@endif
				</div>
				<div class="form-group {{$errors->has('contact') ? 'has-error' : ''}}">
					<label>Mobile Contact#</label>
					<input type="number" name="contact" class="form-control" maxlength="12" value="{{$errors->has('contact') ? '' : old('contact')}}">
					@if($errors->has('contact'))
						<i class="help-block">{{$errors->first('contact')}}</i>
					@endif
				</div>
				<div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
					<label>Address</label>
					<textarea class="form-control" name="address" value="{{$errors->has('address') ? '' : old('address')}}"></textarea>
					@if($errors->has('address'))
						<i class="help-block">{{$errors->first('address')}}</i>
					@endif
				</div>

				<div class="form-group {{$errors->has('g-recaptcha-response') ? 'has-error' : ''}}">
					<div class="g-recaptcha" data-sitekey="6LfsW0cUAAAAABcoMJnQfP5mUX2kLyLLS9L9SB7B"></div>
					@if($errors->has('g-recaptcha-response'))
						<i class="help-block">{{$errors->first('g-recaptcha-response')}}</i>
					@endif
				</div>
				
				<div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
					{{csrf_field()}}
					<button type="submit" class="btn btn-warning btn-lg btn-block">Submit</button>
					
				</div>

			</div>
			<div class="col-md-6">
				<div class="form-group {{$errors->has('id') ? 'has-error' : ''}}" >
					<label>Student I.D</label>
					<input type="text" name="id" class="form-control" maxlength="15" placeholder="Enter I.D Number" value="{{$errors->has('id') ? '' : old('id')}}">
					@if($errors->has('id'))
						<i class="help-block">{{$errors->first('id')}}</i>
					@endif
					
				</div>

				<div class="form-group {{$errors->has('course') ? 'has-error' : ''}}">
					<label>Course</label>
					<select name="course" class="form-control">
						<option value="bsit">BSIT</option>
						<option value="bscs">BSCS</option>
						
					</select>
				</div>

				<div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
					<label>Email</label>
					<input type="email" name="email" class="form-control" value="{{$errors->has('email') ? '' : old('email')}}">
					@if($errors->has('email'))
						<i class="help-block">{{$errors->first('email')}}</i>
					@endif
				</div>

				<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
					<label>Password</label>
					<input type="password" name="password" class="form-control" maxlength="12" value="{{$errors->has('password') ? '' : old('password')}}">
					@if($errors->has('password'))
						<i class="help-block">{{$errors->first('password')}}</i>
					@endif
				</div>

				<div class="form-group {{$errors->has('repeat_password') ? 'has-error' : ''}}">
					<label>Repeat Password</label>
					<input type="password" name="repeat_password" class="form-control" maxlength="12" value="{{$errors->has('repeat_password') ? '' : old('repeat_password')}}">
					@if($errors->has('repeat_password'))
						<i class="help-block">{{$errors->first('repeat_password')}}</i>
					@endif
				</div>

				
			</div>

			
		</form>
		


			
	</div>
</div>

@endsection


@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{URL::to('js/jquery.js')}}"></script>
<script src="{{URL::to('js/bootstrap.min.js')}}"></script>
<script src="{{URL::to('js/sweet.js')}}"></script>
	<script>
		 @if(Session::has('register'))
       
        swal("Good job!", "You have registered successfully. Kindly check your email to get the codes and verify your account. Thanks Admin!", "success");
      @endif
	</script>

    
 

@endsection