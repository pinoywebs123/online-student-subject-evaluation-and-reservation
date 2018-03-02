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
                    <li class="active">
                      <a href="{{route('admin_subject')}}" ><i class="glyphicon glyphicon-education pull-right"></i> Subjects</a>
                    </li>
                     <li>
                      <a href="{{route('admin_inquiry')}}" ><i class="glyphicon glyphicon-tasks pull-right"></i> Inquiry</a>
                    </li>
                     <li>
                      <a href="{{route('admin_reserve')}}" ><i class="glyphicon glyphicon-th-list pull-right"></i> Reserve</a>
                    </li>
                    <li>
                      <a href="{{route('admin_students')}}" ><i class="glyphicon glyphicon-user pull-right"></i> Students</a>
                    </li>
                     
                    <li>
                      <a href="{{route('admin_staff')}}" ><i class="glyphicon glyphicon-tasks pull-right"></i> Staff</a>
                    </li>
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
          <div class="row">
           
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="{{route('admin_subject')}}">List of Subjects</a></li>
            <li role="presentation"><a href="{{route('admin_subject_create')}}">Create Subject</a></li>
            
          </ul>
            @if(Session::has('delete'))
              <div class="alert alert-danger">
                {{Session::get('delete')}}
              </div>
            @endif
             @if(Session::has('update'))
              <div class="alert alert-warning">
                {{Session::get('update')}}
              </div>
            @endif
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Subject Code</th>
                  <th>Subject Description</th>
                  <th>Pre-Requisite</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{$subject->subject_code}}</td>
                    <td>{{$subject->subject_description}}</td>
                    <td>{{$subject->requisite->subject_code}}</td>
                    <td>{{$subject->created_at->toDayDateTimeString()}}</td>
                    <td>
                        @if($subject->status_id == 0)
                          <button class="btn btn-success btn-xs" disabled="">CLOSED</button>
                        @else
                          <a href="{{route('admin_subject_delete', ['subject_id'=> $subject->id])}}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                        <a href="{{route('admin_subject_close', ['subject_id'=> $subject->id])}}" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-lock"></i></a>
                        @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    
 

</body>

</html>
