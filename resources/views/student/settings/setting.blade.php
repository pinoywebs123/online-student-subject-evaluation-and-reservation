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
               <li>
                  <a href="{{route('student_inquire_now')}}" id="inquire"><span class="badge">INQUIRE NOW</span></a>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{{Auth::user()->fname}} {{Auth::user()->lname}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        
                        
                         <li>
                            <a href="{{route('student_settings')}}"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('student_logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sides">
                <ul class="nav navbar-nav side-nav">
                    <li >
                      <a href="{{route('student_main')}}" ><i class="glyphicon glyphicon-home pull-right"></i> Home</a>
                    </li>

                    <li>
                      <a href="{{route('student_activity')}}" ><i class="glyphicon glyphicon-book pull-right"></i> Activity</a>
                    </li>

                    <li>
                      <a href="{{route('student_inquiries')}}" ><i class="glyphicon glyphicon-list pull-right"></i> Inquiries</a>
                    </li>
                    
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
           <div class="row">
             <h2 class="text-center">My Settings</h2>

             @if(Session::has('pass_change'))
              <div class="alert alert-success">
                {{Session::get('pass_change')}}
              </div>
             @endif
             <div>
               <div class="col-md-6">
                 <h3 class="text-center">Profile</h3>
                 <div class="list-group">
                  <button type="button" class="list-group-item">Name: {{Auth::user()->fname}} {{Auth::user()->lname}}</button>
                  <button type="button" class="list-group-item">Course:{{Auth::user()->course}} </button>
                  <button type="button" class="list-group-item">Email: {{Auth::user()->email}}</button>
                  <button type="button" class="list-group-item">Contact: {{Auth::user()->contact}}</button>
                  <button type="button" class="list-group-item">Address: {{Auth::user()->address}}</button>
                  
                </div>
               </div>
               <div class="col-md-6">
                 <h3 class="text-center">Change Password</h3>
                 <form action="{{route('student_settings_check')}}" method="POST">
                   <div class="form-group {{$errors->has('new_password') ? 'has-error' : ''}}">
                     <label for="new_password">Enter New Password</label>
                     <input type="password" name="new_password" class="form-control" maxlength="12" id="new_password">
                     <i class="help-block">{{$errors->first('new_password')}}</i>
                   </div>
                   <div class="form-group {{$errors->has('repeat_password') ? 'has-error' : ''}}">
                     <label for="repeat_password">Repeat Password</label>
                     <input type="password" name="repeat_password" class="form-control" maxlength="12" id="repeat_password">
                     <i class="help-block">{{$errors->first('repeat_password')}}</i>
                   </div>
                   <div class="form-group">
                      {{csrf_field()}}
                     <button type="submit" class="btn btn-success">SUBMIT</button>
                     <button type="button" class="btn btn-default" id="clearBtn">CLEAR</button>
                   </div>
                 </form>
               </div>
             </div>
           </div>

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    <script>
      $(document).ready(function(){

        $("#clearBtn").click(function(){

          $("#new_password").val("");
          $("#repeat_password").val("");
        });
      });
    </script>
 

</body>

</html>
