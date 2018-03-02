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
            <li role="presentation" ><a href="{{route('admin_subject')}}">List of Subjects</a></li>
            <li role="presentation" class="active"><a href="{{route('admin_subject_create')}}">Create Subject</a></li>
            
          </ul>
            @if(Session::has('info'))
              <div class="alert alert-success">
                <p class="text-center"><strong>{{Session::get('info')}}</strong></p>
              </div>
            @endif
            <form action="{{route('admin_create_check')}}" method="POST">
            <div class="col-md-6">
              
               <div id="yes">
                 <h3 class="text-center">Pre-Requisite</h3>
                <div class="form-group {{$errors->has('requisite_subject_code') ? 'has-error': ''}}">
                  <label>Subject Code</label>
                  <input type="text" name="requisite_subject_code" class="form-control" placeholder="Enter Subject Code" maxlength="200" value="none">
                  @if($errors->has('requisite_subject_code'))
                    <i class="help-block">{{$errors->first('requisite_subject_code')}}</i>
                  @endif
                </div>
                <div class="form-group {{$errors->has('requisite_subject_description') ? 'has-error': ''}}">
                  <label>Subject Description</label>
                  <textarea class="form-control" name="requisite_subject_description" placeholder="Enter Subject Description" maxlength="100">none</textarea>
                   @if($errors->has('requisite_subject_description'))
                    <i class="help-block">{{$errors->first('requisite_subject_description')}}</i>
                  @endif
                </div>
               </div>
                
              
            </div>

            <div class="col-md-6">
               <h3 class="text-center">New Subject</h3>
               <div class="form-group {{$errors->has('new_subject_code') ? 'has-error': ''}}">
                  <label>Subject Code</label>
                  <input type="text" name="new_subject_code" class="form-control" placeholder="Enter Subject Code" maxlength="15" id="new_subject_code">
                   @if($errors->has('new_subject_code'))
                    <i class="help-block">{{$errors->first('new_subject_code')}}</i>
                  @endif
                </div>
                <div class="form-group {{$errors->has('new_subject_description') ? 'has-error': ''}}">
                  <label>Subject Description</label>
                  <textarea class="form-control" name="new_subject_description" placeholder="Enter Subject Description" maxlength="100" id="new_subject_description"></textarea>
                   @if($errors->has('new_subject_description'))
                    <i class="help-block">{{$errors->first('new_subject_description')}}</i>
                  @endif
                </div>

                <div class="form-group">
                  <label>Subject Unit</label>
                  <select name="unit" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Choose Regular or Iregular subjects</label><br>
                  <label class="radio-inline"><input type="radio" name="regular" value="1">Regular</label>
                  <label class="radio-inline"><input type="radio" name="regular" value="0">Iregular</label>
                </div>

                <div class="form-group">
                  <label>Course</label>
                  <select name="course" class="form-control">
                    <option value="bsit">BSIT</option>
                    <option value="bscs">BSCS</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Semester</label>
                  <select name="semester" class="form-control">
                    
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                    <option value="3">Summer Class</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Year Level</label>
                  <select name="department" class="form-control">
                   
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                   
                  </select>
                </div>
            </div>

            <div class="text-center col-md-12">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-default" id="clearBtn">Clear</button>
                </div>
            </form>

          </div>

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    <script type="text/javascript">
       $(document).ready(function(){
        $("#clearBtn").click(function(){
          $("#new_subject_code").val("");
          $("#new_subject_description").val("");

        });
      });
    </script>
 

</body>

</html>
