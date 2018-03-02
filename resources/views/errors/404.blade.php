@extends('template.default')

@section('styles')

<style type="text/css">
	body{
		background: url('{{URL::to('image/2.png')}}') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	}

	a{
		margin-top: 50%;
		background: transparent !important;
		color: #fff !important;
	}
</style>
@endsection


@section('contents')
<div class="col-md-4 col-md-offset-4">
	<p class="text-center"><a href="{{route('login')}}" class="btn btn-default btn-lg">GO HOME &raquo;</a></p>
</div>

@endsection


@section('scripts')

@endsection