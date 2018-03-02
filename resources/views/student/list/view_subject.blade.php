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
                    <li class="active">
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
              <div class="col-md-6">
                <div class="alert alert-warning">
                  @if($find->requisite->subject_code == "none")
                    <h3>This subject has no Pre-requisite subject.</h3>
                  @else
                    <h3>Pre-Requisite: {{$find->requisite->subject_code}}</h3>
                    <h3><strong>Note: </strong> You have to take and get a passing grade of the Pre-requisite subject above.</h3>
                  @endif
                  
                </div>
              </div>

               <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="{{URL::to('image/student.png')}}" alt="IMAGE HERE" width="150px">
                  <div class="caption">
                    <h3 class="text-center">Subject Code: {{$find->subject_code}}</h3>
                    <p class="text-center">{{$find->subject_description}}</p>
                    
                    <center>
                       <form action="{{route('studnet_reserve_me_now', ['id'=> $find->id])}}" method="POST" id="reserveBtn">
                        {{csrf_field()}}
                        <button type="button" class="btn btn-danger" id="submitBtn">Reserve</button>
                         <a href="{{route('student_main')}}" class="btn btn-default" role="button">Cancel</a>
                      </form>
                    </center>

                  </div>
                </div>
              </div>


            </div>

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('js/sweet.js')}}"></script>

    <script type="text/javascript">
      @if(Session::has('ok'))
       
        swal("Good job!", "You already have reserve for this subject!", "success");
      @endif

        @if(Session::has('not'))
        swal("OOppss!", "You need to take the Pre-Requisite subject first!", "error");
       
      @endif

       @if(Session::has('check'))
        swal("OOppss!", "You already have reserve for this subject!", "error");
       
      @endif

      $(document).ready(function(){

        $("#submitBtn").click(function(){
            swal({
                title: "Are you sure?",
                text: "You want to reserve this subject? Kindly Review the Pre-Requisite!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  $("#reserveBtn").submit();
                  
                } else {
                  
                }
              });
            });
          });
    </script>
 

</body>

</html>
