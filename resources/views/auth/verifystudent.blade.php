@extends('template.default')

@section('styles')

<style type="text/css">
	a {
		
		color: gray;
	}
	.well{
		margin-top: 10%;
		
		
		
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
	<div class="col-md-6 col-md-offset-3 well" data-toggle="tooltip" title="{{Session::get('err')}}" data-placement="right">
		<center><a href="{{route('login')}}"><img src="{{URL::to('image/logo.png')}}" alt="Logo here" width="120px"></a></center>
		<h3 class="text-center">To Verify your Account. Enter the codes you receive from your Email</h3>
		<form action="{{route('verify_now_morley')}}" method="POST" autocomplete="off">
			
			<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}" data-toggle="tooltip" title="{{$errors->first('password')}}" data-placement="left">
				<label>Enter Codes</label>
				<input type="text" name="codes" class="form-control" maxlength="12" >
				
			</div>
			<div class="form-group">
				{{csrf_field()}}
				<button type="submit" class="btn btn-warning btn-lg btn-block">Verify Now</button>
				
			</div>

		</form>
			
	</div>
</div>

@endsection


@section('scripts')

<script src="{{URL::to('js/jquery.js')}}"></script>
<script src="{{URL::to('js/bootstrap.min.js')}}"></script>
<script src="{{URL::to('js/sweet.js')}}"></script>
	<script>
		 @if(Session::has('verify'))
       
        swal("Good job!", "Student Account has been Activited Successfully. Enjoy!", "success");
      @endif
	</script>
@endsection