<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <link rel="stylesheet" href="loginCSS/btn.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Course Center</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="student_index.php">Course Center</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="student.php">Student</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
          </ul>
        </div>
        <a class="navbar-brand"></a>
        <form method="post" action="login.php" class="form-inline">
            <button type="submit" name="log_out" class="btn btn-default btn-sm">

          <span class="glyphicon glyphicon-log-out"></span> Log out</button>
        </form>
      </nav>

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" id="pastcourse-tab" data-toggle="tab"  href="#pastcourse" aria-controls="pastcourse" aria-selected="false">Past Courses</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="course-tab" data-toggle="tab"  href="#course" aria-controls="course" aria-selected="false">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="courseselection-tab" data-toggle="tab"  href="#courseselection" aria-controls="courseselection" aria-selected="false">Course Selection</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade" id="pastcourse" role="tabpanel" aria-labelledby="pastcourse-tab">
            
            <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Course Name</th>
              </tr>
            </thead>

            <tbody>
              
                <?php
                $cur_email = $_SESSION['email'];
                $query = "SELECT * FROM student WHERE email = '$cur_email'";
                $results = mysqli_query($db, $query);
                $row = mysqli_fetch_array($results);
                $st_id =  $row['student_id'];   

                $query2 = "SELECT * FROM student_past_courses WHERE student_id = '$st_id'";
                $results2 = mysqli_query($db, $query2); 
                  
                while($row = mysqli_fetch_array($results2))
                {?>
                  <tr>
                  <td scope="row"><?php echo $row['course_name'] ?></td>
                  </tr>
                <?php } ?>

                 
              
            </tbody>
          </table>
        </div>

       
       
        <div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="course-tab">
            <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Course Name</th>
                <th scope="col">Lecturer</th>
                <th scope="col">Course Type</th>
              </tr>
            </thead>

            <tbody>
              
                <?php
                $cur_email = $_SESSION['email'];
                $query = "SELECT * FROM student WHERE email = '$cur_email'";
                $results = mysqli_query($db, $query);
                $row = mysqli_fetch_array($results);
                $st_id =  $row['student_id'];   

                $query2 = "SELECT * FROM student_current_course WHERE student_id = '$st_id'";
                $results2 = mysqli_query($db, $query2); 
// ->student_current_course student_id, course_name
// OOP
                while($row = mysqli_fetch_array($results2))
                {
                  $course = $row['course_name'];// OOP
                  $query3 = "SELECT * FROM course WHERE course_name = '$course'";// OOP
                  $results3 = mysqli_query($db, $query3); 
                  $row2 = mysqli_fetch_array($results3); ?>

                  <tr>
                  <td scope="row"><?php echo $row2['course_name'] ?></td>
                  <td scope="row"><?php echo $row2['lecturer'] ?></td> 
                  <td scope="row"><?php echo $row2['course_type'] ?></td> 

                  </tr>
                <?php } ?>

            </tbody>
          </table>

          <form method="post" >
    <label id="account">
          <span>Choose Your Course</span>
          <select name="delete_course" >
            <?php
              $cur_email = $_SESSION['email'];
              $query = "SELECT * FROM student WHERE email = '$cur_email'";
              $results = mysqli_query($db, $query);
              $row = mysqli_fetch_array($results);
              $st_id =  $row['student_id'];

              $query = "SELECT * FROM student_current_course where student_id='$st_id'";
              $results = mysqli_query($db, $query);
          while($row = mysqli_fetch_array($results))
                {

                  $course = $row['course_name'];
                  $query2 = "SELECT * FROM course WHERE course_name = '$course'";
                  $results2 = mysqli_query($db, $query2); 
                
                  $row2 = mysqli_fetch_array($results2); 
                  ?>                   
              
                    <option> <?php echo $row['course_name']; ?></option>
                        <?php }?> 
          </select>
         </label>
         <button  name="remove_course" class="remove_btn">Remove</button>
    </form>



        </div>

        <div class="tab-pane fade" id="courseselection" role="tabpanel" aria-labelledby="courseselection-tab">

          <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Course Name</th>
                      <th scope="col">Lecturer</th>
                      <th scope="col">Course Type</th>
                    </tr>
                  </thead>
             <?php

                $past_course_names = array();
                $current_course_names = array();
               
           
                $cur_email = $_SESSION['email'];
                $query = "SELECT * FROM student WHERE email = '$cur_email'";
                $results = mysqli_query($db, $query);
                $row = mysqli_fetch_array($results);
                $st_id =  $row['student_id'];   

                

                $query = "SELECT * FROM student_past_courses WHERE student_id = '$st_id'";
                $results = mysqli_query($db, $query);

                while($past_courses = mysqli_fetch_array($results))
                {
                  array_push($past_course_names, $past_courses['course_name']);

                }

                $query = "SELECT * FROM student_current_course WHERE student_id = '$st_id'";
                $results = mysqli_query($db, $query);

                while($curr_courses = mysqli_fetch_array($results))
                {
                  array_push($current_course_names, $curr_courses['course_name']);            
                }

                $query = "SELECT * FROM course";
                $results = mysqli_query($db, $query);

                while($course = mysqli_fetch_array($results))
                {

                      if(in_array($course['course_name'], $current_course_names))
                      {
                         continue;
                      }

                      if(in_array($course['course_name'], $past_course_names))
                      {
                         continue;
                      }                      
                    
                      ?>
                        <tr>
                          <td> <?php echo $course['course_name']; ?></td>
                          <td> <?php echo $course['lecturer']; ?></td>
                          <td> <?php echo $course['course_type']; ?></td>
                        </tr>
                        <?php  
              } ?>
                </table>
                

    <form method="post" >
    <label id="account">
          <span>Choose Your Course</span>
          <select name="choose_course" >
            <?php
      $past_course_names = array(); 
     $current_course_names = array();

      $cur_email = $_SESSION['email'];
      $query = "SELECT * FROM student WHERE email = '$cur_email'";
      $results = mysqli_query($db, $query);
      $row = mysqli_fetch_array($results);
      $st_id =  $row['student_id'];   

      

      $query = "SELECT * FROM student_past_courses WHERE student_id = '$st_id'";
      $results = mysqli_query($db, $query);
      while($past_courses = mysqli_fetch_array($results))
      {
        array_push($past_course_names, $past_courses['course_name']);

      }

      $query = "SELECT * FROM student_current_course WHERE student_id = '$st_id'";
      $results = mysqli_query($db, $query);
      while($curr_courses = mysqli_fetch_array($results))
      {
        array_push($current_course_names, $curr_courses['course_name']);            
      }

      $query = "SELECT * FROM course";
      $results = mysqli_query($db, $query);
      while($course = mysqli_fetch_array($results))
      {
            if(in_array($course['course_name'], $current_course_names))
            {
               continue;
            }

            if(in_array($course['course_name'], $past_course_names))
            {
               continue;
            }                      
                      ?>
                          <option> <?php echo $course['course_name']; ?></option>
                        <?php }?> 
          </select>
         </label>
         <button name="add_course" class="add_btn">Add</button>
    </form>
        </div>
      
      </div>
      
</body>
</html>