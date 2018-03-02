<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NORSU BCC Enrollment Inquiry and Reservation System</title>

    
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">

   
    <link href="{{URL::to('css/sb-admin.css')}}" rel="stylesheet">

   
    <link href="{{URL::to('css/plugins/morris.css')}}" rel="stylesheet">

 

<style type="text/css">
    #txt{
        font-size: 48px;
    }
    .navbar {
     background: #2980b9 !important;
   }
   #sides ul {
    background: #2980b9 !important;
    
   }
   #sides ul li a{
    color: #fff !important;
   }
   body {
    background: #2c3e50;
   }
   span{
    font-size: 40px;
   }

  .dropdown a{
    color: #f39c12 !important;
  }

   body {
    background-color: #323232 !important;
   }

  
.badge{
  background-color: #e74c3c;
}
</style>

</head>

<body>

    <div id="wrapper">

       
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" data-toggle="modal" data-target="#test"></a>
            </div>
            
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{{Auth::user()->fname}} {{Auth::user()->lname}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Profile</a>
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('admin_logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sides">
                <ul class="nav navbar-nav side-nav">
                    <li >
                      <a href="{{route('admin_main')}}" ><i class="glyphicon glyphicon-home pull-right"></i> Home</a>
                    </li>
                    <li>
                      <a href="{{route('admin_subject')}}" ><i class="glyphicon glyphicon-education pull-right"></i> Subjects</a>
                    </li>
                     <li >
                      <a href="{{route('admin_inquiry')}}" ><i class="glyphicon glyphicon-tasks pull-right"></i> Inquiry</a>
                    </li>
                     <li >
                      <a href="{{route('admin_reserve')}}" ><i class="glyphicon glyphicon-th-list pull-right"></i> Reserve</a>
                    </li>
                    <li >
                      <a href="{{route('admin_students')}}" ><i class="glyphicon glyphicon-user pull-right"></i> Students</a>
                    </li>
                    <li class="active">
                      <a href="{{route('admin_staff')}}" ><i class="glyphicon glyphicon-tasks pull-right"></i> Staff</a>
                    </li>
                     
                     
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
          <div class="row">
            <ul class="nav nav-tabs">
              <li role="presentation" ><a href="{{route('admin_staff')}}">List</a></li>
              <li role="presentation" class="active"><a href="{{route('admin_staff_create')}}">Create</a></li>
              
            </ul>
             
              <form action="{{route('admin_staff_check')}}" method="POST">
                <div class="col-md-6">
                  <div class="form-group {{$errors->has('first_name') ? 'has-error': ''}}">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" max="20" placeholder="Enter First Name">
                    @if($errors->has('first_name'))
                      <i class="help-block">{{$errors->first('first_name')}}</i>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('middle_name') ? 'has-error': ''}}">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" max="20" placeholder="Enter Middle Name">
                    @if($errors->has('middle_name'))
                      <i class="help-block">{{$errors->first('middle_name')}}</i>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('last_name') ? 'has-error': ''}}">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" max="20" placeholder="Enter Last Name">
                    @if($errors->has('last_name'))
                      <i class="help-block">{{$errors->first('last_name')}}</i>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('contact') ? 'has-error': ''}}">
                    <label>Contact</label>
                    <input type="number" name="contact" class="form-control" min="0" maxlength="13">
                    @if($errors->has('contact'))
                      <i class="help-block">{{$errors->first('contact')}}</i>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" max="25" placeholder="Enter Email Adrress ">
                    @if($errors->has('email'))
                      <i class="help-block">{{$errors->first('email')}}</i>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('course') ? 'has-error': ''}}">
                    <label>Course</label>
                    <input type="text" name="course" class="form-control" placeholder="Enter Course">
                    @if($errors->has('course'))
                      <i class="help-block">{{$errors->first('course')}}</i>
                    @endif
                  </div>
                  <div class="form-group {{$errors->has('address') ? 'has-error': ''}}">
                    <label>Address</label>
                    <textarea name="address" class="form-control"></textarea>
                    @if($errors->has('address'))
                      <i class="help-block">{{$errors->first('address')}}</i>
                    @endif
                  </div>

               </div>
               <div class="col-md-6">
                 <div class="form-group {{$errors->has('id') ? 'has-error': ''}}">
                   <label>Student ID</label>
                   <input type="text" name="id" class="form-control" max="15" placeholder="Enter Student ID">
                   @if($errors->has('id'))
                      <i class="help-block">{{$errors->first('id')}}</i>
                    @endif
                 </div>
                 <div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
                   <label>Password</label>
                   <input type="password" name="password" class="form-control" max="12" placeholder="Enter Password">
                   @if($errors->has('password'))
                      <i class="help-block">{{$errors->first('password')}}</i>
                    @endif
                 </div>
                 <div class="form-group {{$errors->has('repeat_password') ? 'has-error': ''}}">
                   <label>Repeat Password</label>
                   <input type="password" name="repeat_password" class="form-control" max="12" placeholder="Repeat Password">
                   @if($errors->has('repeat_password'))
                      <i class="help-block">{{$errors->first('repeat_password')}}</i>
                    @endif
                 </div>
               </div>

               <div class="text-center">
                 {{csrf_field()}}
                 <button type="submit" class="btn btn-primary">SUBMIT</button>
                 <button type="button" class="btn btn-default">CLEAR</button>
               </div>
            </form>
          </div>

           

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('js/sweet.js')}}"></script>
    <script type="text/javascript">
       @if(Session::has('suc'))
              swal("Congratulations! ", "New Staff has been added Successfully!", "success");
        @endif
  </script>
 

</body>

</html>
