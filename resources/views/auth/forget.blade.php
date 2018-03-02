@extends('template.default')

@section('styles')

<style type="text/css">
	a {
		
		color: gray;
	}
	.well{
		margin-top: 10%;
		border-radius: 10px;	
		
		
	}
	body{
		background-color: #2980b9;
	}
	img{
		margin-top: -60px;
	}
</style>
@endsection


@section('contents')
<div class="container">
	<div class="col-md-6 col-md-offset-3 well" data-toggle="tooltip" title="{{Session::get('err')}}"" data-placement="right">
		<center><a href="{{url('/')}}"><img src="{{URL::to('image/logo.png')}}" alt="Logo here" width="120px"></a></center>
		<form  method="POST" action="{{route('forgot_check')}}">
			<div class="form-group {{$errors->has('email') ? 'has-error' : ''}}" data-toggle="tooltip" title="{{$errors->first('email')}}" data-placement="left">
				<label>Email Address</label>
				<input type="email" name="email" class="form-control" maxlength="30" placeholder="Enter Email Address">
				
			</div>
			
			<div class="form-group">
				{{csrf_field()}}
				<button type="submit" class="btn btn-primary btn-lg btn-block">Send Request</button>
				
			</div>
		</form>
	</div>
</div>

@endsection


@section('scripts')
<script src="{{URL::to('js/sweet.js')}}"></script>
	<script>
		@if(Session::has('err'))
			$(".well").tooltip('show');
		@endif
		@if(Session::has('suc'))
			swal({
				  title: "Good job!",
				  text: "Check your email to change your password!",
				  icon: "success",
				  button: "OK",
				});
		@endif
		$(document).ready(function(){
		   
		    @if($errors->has('email'))
				$("[data-toggle='tooltip']").tooltip('show');	
			@endif  
			
		});
	</script>

  

@endsection