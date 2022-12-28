<?php 

session_start();

$db = mysqli_connect('192.168.56.1', 'root', '', 'try');




// pass students from lecturer

if(isset($_POST['student_pass'])){ 
   $student_id= mysqli_real_escape_string($db, $_POST['choose_student']);

   $cur_email = $_SESSION['email'];
   $q = "SELECT * from lecturer where email='$cur_email'";
   $res = mysqli_query($db, $q);
   $ro = mysqli_fetch_array($res);
   $course_name = $ro['course_name'];

  $query = "DELETE from student_current_course where student_id='$student_id' and course_name='$course_name'";
  mysqli_query($db, $query);

  $query2 = "INSERT INTO student_past_courses(student_id,course_name)
  VALUES('$student_id','$course_name')";
  mysqli_query($db, $query2);
}






// when student want to remove course

if(isset($_POST['remove_course'])){
  $deleted_course = mysqli_real_escape_string($db, $_POST['delete_course']);

  $cur_email = $_SESSION['email'];
  $query = "SELECT * FROM student WHERE email = '$cur_email'";
  $results = mysqli_query($db, $query);
  $row = mysqli_fetch_array($results);
  $st_id =  $row['student_id'];

  $query="DELETE from student_current_course where course_name='$deleted_course' and student_id='$st_id'";
 mysqli_query($db,$query);
  echo "<script type='text/javascript'>alert('the course is deleted');</script>";
}











// the student adding courses

if(isset($_POST['add_course'])){
  $chosen_course = mysqli_real_escape_string($db, $_POST['choose_course']);

  $cur_email = $_SESSION['email'];
  $query = "SELECT * FROM student WHERE email = '$cur_email'";
  $results = mysqli_query($db, $query);
  $row = mysqli_fetch_array($results);
  $st_id =  $row['student_id'];   

  $query = "INSERT INTO student_current_course (course_name,student_id)
  VALUES('$chosen_course','$st_id')";
  mysqli_query($db,$query);
  
  echo "<script type='text/javascript'>alert('the course is added');</script>";
}












// the student signing up

if (isset($_POST['register_user'])) {						

  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $college= mysqli_real_escape_string($db, $_POST['college']);

  $user_check_query = "SELECT * FROM student WHERE name='$name' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
    if ($user) { 

      if ($user['email'] == $email) {
        $register_message = "The user already registered the system!";
        echo "<script type='text/javascript'>alert('$register_message');</script>";
    }
  }
  else
  {
  	$password = md5($password_1);
  

    $query = "INSERT INTO student (name,email,department,password)
    VALUES('$name', '$email','$college','$password')";
    mysqli_query($db,$query);
  
    echo "<script type='text/javascript'>alert('Successfully registered'); 
    window.location.href='login.php'; </script>";
  }
  

}














// the lecturer singing in 

if (isset($_POST['login_lecturer']))      
{

  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  $password = md5($password);
  $query = "SELECT * FROM lecturer WHERE email='$email'";
  $results = mysqli_query($db, $query);


  if(mysqli_num_rows($results) == 0)
  {

    echo "<script type='text/javascript'>alert('lecturer not found!');</script>";

  }

  else if (isset($email) and isset($password) )
  {
    $query = "SELECT * FROM lecturer WHERE email='$email'";
    $results = mysqli_query($db, $query);
    $row = mysqli_fetch_array($results); 

    if($password != $row['password'])
    {
      echo "<script type='text/javascript'>alert('Password is wrong, Please try again!');</script>";
    }
    
    else if($password == $row['password'])
    {
      $username = $row['lecturer_name'];
      $_SESSION['lecturer_name'] = $username;
      $_SESSION['email'] = $email;
    
      echo "<script type='text/javascript'>alert('Login Success, Welcome ' +'$username' ); 
      window.location.href='lecturer_index.php'; </script>";
    }
   
    else
    {
      echo "<script type='text/javascript'>alert('The account type is not lecturer!');</script>";
    }
  }
}












// Student login

if (isset($_POST['login_student']))           
{

  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  $password = md5($password);
  $query = "SELECT * FROM student WHERE email='$email'";
  $results = mysqli_query($db, $query);


  if(mysqli_num_rows($results) == 0)
  {

    echo "<script type='text/javascript'>alert('Student is not found!');</script>";

  }
  else if (isset($email) and isset($password) )
  {

    $row = mysqli_fetch_array($results); 
    $username = $row['name'];


    if($password != $row['password'])
    {
      echo "<script type='text/javascript'>alert('Password is wrong, Please try again!');</script>";
    }
    else
    {
      $_SESSION['name'] = $username;
      $_SESSION['email']= $email;
      $_SESSION['student_id'] = "SELECT student_id from student where email=$email";
    
      echo "<script type='text/javascript'>alert('Login Success, Welcome ' + '$username'); 
      window.location.href='student_index.php'; </script>";
    }
  }
}















if (isset($_POST['log_out']))					//Log out
{
	      echo "<script type='text/javascript'>alert('Login Success, Welcome); 
      window.location.href='login.php'; </script>";
}    


 ?>