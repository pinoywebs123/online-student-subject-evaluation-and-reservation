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

    .hovereffect {
width:100%;
height:100%;
float:left;
overflow:hidden;
position:relative;
text-align:center;
cursor:default;
}

.hovereffect .overlay {
width:100%;
height:100%;
position:absolute;
overflow:hidden;
top:0;
left:0;
opacity:0;
background-color:rgba(0,0,0,0.5);
-webkit-transition:all .4s ease-in-out;
transition:all .4s ease-in-out
}

.hovereffect img {
display:block;
position:relative;
-webkit-transition:all .4s linear;
transition:all .4s linear;
}

.hovereffect h2 {
text-transform:uppercase;
color:#fff;
text-align:center;
position:relative;
font-size:17px;
background:rgba(0,0,0,0.6);
-webkit-transform:translatey(-100px);
-ms-transform:translatey(-100px);
transform:translatey(-100px);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
padding:10px;
}

.hovereffect a.info {
text-decoration:none;
display:inline-block;
text-transform:uppercase;
color:#fff;
border:1px solid #fff;
background-color:transparent;
opacity:0;
filter:alpha(opacity=0);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
margin:50px 0 0;
padding:7px 14px;
}

.hovereffect a.info:hover {
box-shadow:0 0 5px #fff;
}

.hovereffect:hover img {
-ms-transform:scale(1.2);
-webkit-transform:scale(1.2);
transform:scale(1.2);
}

.hovereffect:hover .overlay {
opacity:1;
filter:alpha(opacity=100);
}

.hovereffect:hover h2,.hovereffect:hover a.info {
opacity:1;
filter:alpha(opacity=100);
-ms-transform:translatey(0);
-webkit-transform:translatey(0);
transform:translatey(0);
}

.hovereffect:hover a.info {
-webkit-transition-delay:.2s;
transition-delay:.2s;
}
.badge{
  background-color: #e74c3c;
}
#inquire{
  color: #fff;
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
                            <a href="{{route('staff_settings')}}"><i class="glyphicon glyphicon-cog"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('staff_logout')}}"><i class="glyphicon glyphicon-power"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sides">
                <ul class="nav navbar-nav side-nav">
                    <li >
                      <a href="{{route('staff_main')}}" ><i class="glyphicon glyphicon-home pull-right"></i> Home</a>
                    </li>

                    <li>
                      <a href="{{route('staff_subjects')}}" ><i class="glyphicon glyphicon-book pull-right"></i> Subjects</a>
                    </li>

                    <li>
                      <a href="{{route('staff_students')}}" ><i class="glyphicon glyphicon-list pull-right"></i> Students</a>
                    </li>
                    
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
            <div class="row">
              <h3 class="text-center">My Settings</h3>
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
                 <form action="{{route('staff_settings_check')}}" method="POST">
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

    
 

</body>

</html>
