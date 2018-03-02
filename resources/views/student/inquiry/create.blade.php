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
               
                <li class="active">
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
           
            <div class="col-md-6 text-center">
              <img src="{{URL::to('image/i1.png')}}">
            </div>
            <div class="col-md-6">
              <form action="{{route('student_inquiry_check')}}" method="POST">
                <div class="form-group {{$errors->has('inquiry_title') ? 'has-error' : ''}}">
                  <label>Inquiry Title</label>
                  <input type="text" name="inquiry_title" class="form-control" placeholder="Enter Inquiry Title Here" maxlength="120" id="inquiry_title"> 
                  @if($errors->has('inquiry_title'))
                    <i class="help-block">{{$errors->first('inquiry_title')}}</i>
                  @endif
                </div>
                <div class="form-group {{$errors->has('inquiry_content') ? 'has-error' : ''}}">
                  <label>Inquiry Content</label>
                  <textarea class="form-control" name="inquiry_content" placeholder="Enter Inquiry Content Here" rows="5" id="inquiry_content"></textarea>
                   @if($errors->has('inquiry_content'))
                    <i class="help-block">{{$errors->first('inquiry_content')}}</i>
                  @endif
                </div>
                <div class="form-group">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-primary">SUBMIT</button>
                  <button type="button" class="btn btn-default" id="clearBtn">CLEAR</button>
                </div>
              </form>
            </div>
          </div>
        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::to('js/sweet.js')}}"></script>
    
  <script type="text/javascript">
      $(document).ready(function(){
        $("#clearBtn").click(function(){
          $("#inquiry_content").val("");
          $("#inquiry_title").val("");

        });
      });


       @if(Session::has('ok'))
              swal("Good job!", "You have successfully send your inquiry!", "success");
        @endif
  </script>

</body>

</html>
