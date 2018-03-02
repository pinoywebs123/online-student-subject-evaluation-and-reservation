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
		<center><a href="{{url('/')}}"><img src="{{URL::to('image/logo.png')}}" alt="Logo here" width="120px"></a></center>
		<form action="{{route('forget_change_pass', ['id'=> $find->id])}}" method="POST" autocomplete="off">
			
			<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}" data-toggle="tooltip" title="{{$errors->first('password')}}" data-placement="left">
				<label>New Password</label>
				<input type="password" name="new_password" class="form-control" maxlength="12" placeholder="Enter Password">
				
			</div>
			<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}" data-toggle="tooltip" title="{{$errors->first('password')}}" data-placement="left">
				<label>Repeat Password</label>
				<input type="password" name="repeat_password" class="form-control" maxlength="12" placeholder="Enter Password">
				
			</div>
			<div class="form-group">
				{{csrf_field()}}
				<button type="submit" class="btn btn-warning btn-lg btn-block">Change Password</button>
				
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
		$(document).ready(function(){
		   
		    @if($errors->has('student_id'))
				$("[data-toggle='tooltip']").tooltip('show');	
			@endif  
			@if($errors->has('password'))
				$("[data-toggle='tooltip']").tooltip('show');	
			@endif 
		});
	</script>

    
  <script type="text/javascript">
       @if(Session::has('teacher'))
              swal("OOpps!", "Teacher and Staff can only login through mobile app.!", "error");
        @endif

         @if(Session::has('verify'))
       
        swal("Good job!", "Student Account has been Activited Successfully. Enjoy!", "success");
      @endif
  </script>

@endsection