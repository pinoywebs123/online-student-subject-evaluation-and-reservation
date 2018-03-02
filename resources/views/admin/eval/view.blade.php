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
                     
                    <li>
                      <a href="{{route('admin_staff')}}" ><i class="glyphicon glyphicon-tasks pull-right"></i> Staff</a>
                    </li>

                    <li class="active">
                      <a href="{{route('admin_evaluation')}}" ><i class="glyphicon glyphicon-pencil pull-right"></i>Evaluation</a>
                    </li>
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
          <div class="row">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="{{route('admin_students')}}">Student Evaluation</a></li>
              <!-- <li role="presentation" ><a href="{{route('admin_students_create')}}">Create</a></li> -->
              
            </ul>

            @if(Session::has('eval'))
              <div class="alert alert-success">
                  {{Session::get('eval')}}
              </div>
            @endif

            @if(Session::has('hagbong'))
              <div class="alert alert-danger">
                  {{Session::get('hagbong')}}
              </div>
            @endif

            <div class="container">
              <h4>I.D: {{$find->id}} </h4>
              <h4>Name: {{$find->fname}} {{$find->lname}}</h4>

            </div>

            <div class="col-md-6">
              <form action="{{route('admin_eval_me', ['id'=> $find->id])}}" method="POST">
              <div class="form-group">
                <label>Select Student Year Level</label>
                <select name="year" id="year" class="form-control" required="">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>

              <div class="form-group">
                <label>Semester</label>
                <select name="semester" id="semester" class="form-control" required="">
                  <option>Select</option>
                 <option value="1">1st</option>
                 <option value="2">2nd</option>
                
                </select>
              </div>

              <div class="form-group">
                <label>Subject Code</label>
                <select name="subject_code" id="subject_code" class="form-control" required="">
                 
                </select>
              </div>

              <div class="form-group">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control" maxlength="5">
              </div>

              <div class="form-group">
                {{csrf_field()}}
                <button class="btn btn-info btn-block" type="submit">Submit</button>
                
              </div>

              </form>

            </div>

            <div class="col-md-6">
              <div class="alert alert-warning">
                <h3>Note!!!</h3>
                <h5>Please verify the subject when evaluation. As human as we are we commit mistake. But if we are as careful as the wind. Everything will be smoooth. Thank You!</h5>
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
      var token = '{{Session::token()}}';
      var url = '{{route("admin_evaluation_ajax", ["id"=> $find->id])}}';
     
      $(document).ready(function(){

        $("#semester").change(function(){
           $("#subject_code").empty();
           var year = $("#year").val();
           var semester = $("#semester").val();

          

         $.ajax({
            method : 'POST',
            url : url,
            data: {year: year,semester: semester ,_token : token}

         }).done(function(message){
          var data = message['message'];
            console.log(data );

            data.forEach(function(element) {
              $("#subject_code").append("<option value="+element['id']+">"+element['subject_code']+"</option>");
            });
           

         });

        });


       
      });
    </script>
    
 

</body>

</html>
