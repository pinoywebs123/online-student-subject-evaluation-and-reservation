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
               <li>
                  <a href="{{route('student_inquire_now')}}" id="inquire"><span class="badge">INQUIRE NOW</span></a>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{{Auth::user()->fname}} {{Auth::user()->lname}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        
                      
                         <li>
                            <a href="{{route('student_settings')}}"><i class="glyphicon glyphicon-cog"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('student_logout')}}"><i class="glyphicon glyphicon-power"></i> Log Out</a>
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
                     <li class="active">
                      <a href="{{route('student_evaluated')}}" ><i class="glyphicon glyphicon-user pull-right"></i>Evaluated Subjects</a>
                    </li>
                    
                    
                </ul>
            </div>
           
        </nav>

        <div id="page-wrapper">
            <div class="row">
              <h3 class="text-center">Student Profile Subject</h3>
            


              
              <div class="col-md-6">
              

                 <h4 class="text-center">First Year 1st Semester</h4>
                  <table class="table table-bordered">
                    <thead style="background: #c0392b; ">
                      <tr>
                        <th>Subject</th>
                        <th>Descriptive Title</th>
                        <th>Unit</th>
                        <th>Grade</th>
                        <th>Pre-req</th>
                        <th>Date Evaluated</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($subjects->count())
                      <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 1 AND $subj->semester == 1)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                        <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>

                        @endif
                    </tbody>
                  </table>

                  <h4 class="text-center">Second Year 1st Semester</h4>
                  <table class="table table-bordered">
                    <thead style="background: #c0392b;">
                      <tr>
                        <th>Subject</th>
                        <th>Descriptive Title</th>
                        <th>Unit</th>
                        <th>Grade</th>
                        <th>Pre-req</th>
                        <th>Date Evaluated</th>
                      </tr>
                    </thead>
                    <tbody>
                       @if($subjects->count())
                     <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 2 AND $subj->semester == 1)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                       @if($subj->year == 2 AND $subj->semester == 1)
                          <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>
                       @endif
                        
                        @endif
                    </tbody>
                  </table>

                  <h4 class="text-center">Third Year 1st Semester</h4>
                  <table class="table table-bordered">
                    <thead style="background: #c0392b;">
                      <tr>
                        <th>Subject</th>
                        <th>Descriptive Title</th>
                        <th>Unit</th>
                        <th>Grade</th>
                        <th>Pre-req</th>
                        <th>Date Evaluated</th>
                      </tr>
                    </thead>
                    <tbody>
                       @if($subjects->count())
                      <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 3 AND $subj->semester == 1)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                        @if($subj->year == 3 AND $subj->semester == 1)
                        <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>
                        @endif
                        @endif
                    </tbody>
                  </table>

                  <h4 class="text-center">Fourth Year 1st Semester</h4>
                  <table class="table table-bordered">
                    <thead style="background: #c0392b;">
                      <tr>
                        <th>Subject</th>
                        <th>Descriptive Title</th>
                        <th>Unit</th>
                        <th>Grade</th>
                        <th>Pre-req</th>
                        <th>Date Evaluated</th>
                      </tr>
                    </thead>
                    <tbody>
                       @if($subjects->count())
                      <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 4 AND $subj->semester == 1)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                         @if($subj->year == 4 AND $subj->semester == 1)
                        <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>
                        @endif
                        @endif
                    </tbody>
                  </table>

              </div>

              <div class="col-md-6">
                 <h4 class="text-center">First Year 2nd Semester</h4>
                  <table class="table table-bordered">
                    <thead style="background: #c0392b;">
                      <tr>
                        <th>Subject</th>
                        <th>Descriptive Title</th>
                        <th>Unit</th>
                        <th>Grade</th>
                        <th>Pre-req</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       @if($subjects->count())
                      <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 1 AND $subj->semester == 2)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                        @if($subj->year == 1 AND $subj->semester == 2)
                        <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>
                        @endif
                        @endif
                    </tbody>
                  </table>

                   <h4 class="text-center">Second Year 2nd Semester</h4>
                    <table class="table table-bordered">
                      <thead style="background: #c0392b;">
                        <tr>
                          <th>Subject</th>
                          <th>Descriptive Title</th>
                          <th>Unit</th>
                          <th>Grade</th>
                          <th>Pre-req</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         @if($subjects->count())
                       <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 2 AND $subj->semester == 2)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                        @if($subj->year == 2 AND $subj->semester == 2)
                        <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>
                        @endif
                        @endif
                      </tbody>
                    </table>

                    <h4 class="text-center">Third Year 2nd Semester</h4>
                    <table class="table table-bordered">
                      <thead style="background: #c0392b;">
                        <tr>
                          <th>Subject</th>
                          <th>Descriptive Title</th>
                          <th>Unit</th>
                          <th>Grade</th>
                          <th>Pre-req</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         @if($subjects->count())
                       <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 3 AND $subj->semester == 2)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                        @if($subj->year == 3 AND $subj->semester == 2)
                        <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>
                        @endif
                        @endif
                      </tbody>
                    </table>


                    <h4 class="text-center">Fourth Year 2nd Semester</h4>
                    <table class="table table-bordered">
                      <thead style="background: #c0392b;">
                        <tr>
                          <th>Subject</th>
                          <th>Descriptive Title</th>
                          <th>Unit</th>
                          <th>Grade</th>
                          <th>Pre-req</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         @if($subjects->count())
                        <?php $unit = 0; $count = 0; $sum_grade = 0;?>
                      @foreach($subjects as $subj)
                        @if($subj->year == 4 AND $subj->semester == 2)
                        <?php 
                          $unit = $unit + $subj->subject->unit;
                          $count = $count + 1;
                           $sum_grade =  $sum_grade + $subj->grade;
                           $gpa = $sum_grade / $count;
                        ?>
                          <tr>
                           <td>{{$subj->subject->subject_code}}</td>
                           <td>{{$subj->subject->subject_description}}</td>
                            <td>{{$subj->subject->unit}}</td>
                            <td>{{$subj->grade}}</td>
                            <td>{{$subj->subject->requisite->subject_code}}</td>
                            <td>{{$subj->created_at->toDayDateTimeString()}}</td>
                         </tr>
                          @endif
                        @endforeach
                        @if($subj->year == 4 AND $subj->semester == 2)
                        <tr>

                          <td ></td>
                          <td colspan="2">Total Units: {{$unit}}</td>
                          <td colspan="2">GPA: {{$gpa}}</td>
                          <td>by: {{$subj->evaluator->fname}} {{$subj->evaluator->lname}}</td>
                         
                        </tr>
                        @endif
                        @endif
                      </tbody>
                    </table>


              </div>

              



            </div>

        </div>
           

        </div>
       
       

    </div>
   

   
    <script src="{{URL::to('js/jquery.js')}}"></script>

    
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

    
 

</body>

</html>
