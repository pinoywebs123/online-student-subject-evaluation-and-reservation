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

                    <li >
                      <a href="{{route('student_activity')}}" ><i class="glyphicon glyphicon-book pull-right"></i> Activity</a>
                    </li>

                    <li class="active">
                      <a href="{{route('student_inquiries')}}" ><i class="glyphicon glyphicon-list pull-right"></i> Inquiries</a>
                    </li>
                     <li >
                      <a href="{{route('student_evaluated')}}" ><i class="glyphicon glyphicon-user pull-right"></i>Evaluated Subjects</a>
                    </li>
                    
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
          <div class="row">
            <h3 class="text-center">List of Inquiries</h3>
            @foreach($inquiry as $morley)
              <div class="list-group">
                <a href="#" class="list-group-item" data-toggle="collapse" data-target="#demo{{$morley->id}}">
                  @if($morley->status_id == 0)

                  <i class="glyphicon glyphicon-envelope pull-right" style="color:red;">Unread</i>
                  @else
                  <i class="glyphicon glyphicon-folder-open pull-right" style="color:green;">Read</i>
                  @endif
                  <h4 class="list-group-item-heading">{{$morley->inquiry_title}}</h4>
                  <p class="list-group-item-text">by: {{$morley->student->fname}} {{$morley->student->lname}} @ {{$morley->created_at->todayDAteTimeString()}}</p>
                  <div id="demo{{$morley->id}}" class="collapse">
                    <mark>{{$morley->inquiry_content}}</mark>
                  </div>

                </a>
                
            </div>
            @endforeach
            

          </div>

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    
 

</body>

</html>
