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
        <a class="navbar-brand" href="lecturer_index.php">Course Center</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="profileLecturer.php">Profile</a>
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
            <a class="nav-link" id="exam-tab" data-toggle="tab"  href="#exam" aria-controls="exam">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="students-tab" data-toggle="tab"  href="#students" aria-controls="students">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="myprofile-tab" data-toggle="tab"  href="#myprofile" aria-controls="myprofile">My Profile</a>
      </li>
      </ul>
      <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">
            <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Course Name</th>
              </tr>
            </thead>

            <tbody>
              
                <?php

                $cur_email = $_SESSION['email'];
                
                $query = "SELECT * FROM lecturer WHERE email = '$cur_email'";

                $results = mysqli_query($db, $query); 

                $row = mysqli_fetch_array($results); 

                $l_name =  $row['lecturer_name'];   //hocayı buldu

                $query2 = "SELECT * FROM course WHERE lecturer = '$l_name'";
                $results2 = mysqli_query($db, $query2); //derslerin tuple ları buldu

                while($row2 = mysqli_fetch_array($results2))
                {
                  ?>
                  <tr>
                  <td scope="row"><?php echo $row2['course_name'] ?></td>

                  </tr>
                <?php } ?>

                 
              
            </tbody>
          </table>
        </div>

        <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">
          <?php

                $cur_email = $_SESSION['email'];            
                $query = "SELECT * FROM lecturer WHERE email = '$cur_email'";

                $results = mysqli_query($db, $query); 

                $row = mysqli_fetch_array($results); 

                $l_name =  $row['lecturer_name']; 
                ?>
                <table class="table table-striped">
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Department</th>
                        <th scope="col">Email</th>
                      </tr>
                      <?php 
                       $cur_email = $_SESSION['email'];
                       $q = "SELECT * from lecturer where email='$cur_email'";
                      $res = mysqli_query($db, $q);
                      $ro = mysqli_fetch_array($res);
                      $course_name = $ro['course_name'];

                        $query2 = "SELECT * FROM student WHERE 
                        student_id IN(SELECT student_id from student_current_course 
                        WHERE course_name ='$course_name')";

                        $results2 = mysqli_query($db, $query2);
                        
                        while($row2 = mysqli_fetch_array($results2))
                        { ?>

                          <tr> 
                            <td><?php echo $row2['name']; ?></td>
                            <td><?php echo $row2['student_id']; ?></td>
                            <td><?php echo $row2['department']; ?></td>
                            <td><?php echo $row2['email']; ?></td>
                          </tr>

                       <?php } 

                      ?> 
                    
                  </table>

                   <form method="post" >
    <label id="account">
          <span>choose who passed the course</span>
          <select name="choose_student" >
            <?php
    $cur_email = $_SESSION['email'];
    $q = "SELECT * from lecturer where email='$cur_email'";
   $res = mysqli_query($db, $q);
   $ro = mysqli_fetch_array($res);
   $course_name = $ro['course_name'];
       
     $query2 = "SELECT * FROM student WHERE 
     student_id IN(SELECT student_id from student_current_course 
     WHERE course_name ='$course_name')";

     $results2 = mysqli_query($db, $query2);
     while($row2 = mysqli_fetch_array($results2))
      {                   
                      ?>
                          <option> <?php echo $row2['student_id']; ?></option>
                        <?php }?> 
          </select>
         </label>
         <button name="student_pass" class="pass_btn">PASS</button>
    </form>
           </div>




             




        <div class="tab-pane fade" id="myprofile" role="tabpanel" aria-labelledby="myprofile-tab">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <?php

              $cur_email = $_SESSION['email'];
                
                $query = "SELECT * FROM lecturer WHERE email = '$cur_email'";

                $results = mysqli_query($db, $query); 

                $row = mysqli_fetch_array($results); 

                $l_name =  $row['lecturer_name']; 
                ?>
                  <h5 class="card-title"><?php echo $row['lecturer_name']; ?></h5>
              
            </div>
              <div id="accordion">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Information
                        
                      </button>
                    </h5>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $row['email']; ?></li>
                        <li class="list-group-item"><?php echo $row['degree']; ?></li>
                      </ul>
                    </div>
                  </div>
                </div>

              </div>
          </div>
        </div>

      </div>
      
</body>
</html>