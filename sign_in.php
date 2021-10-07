
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="app.css">
  <title>Document</title>
</head>
<body>
<?php
include("header.php");
?>
  
<form id="loginForm" method="post" class="w-25 mt-4">
<div class="form-group">
<label for="username" class="control-label">Username / Email id</label>
<input type="text" class="form-control" id="username" name="username"  required="" title="Please enter you username or Email-id" placeholder="email or username" >
 <span class="help-block"></span>
 </div>
<div class="form-group">
<label for="password" class="control-label">Password</label>
<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="" title="Please enter your password">
 <span class="help-block"></span>
</div>
<button type="submit" class="btn btn-success btn-block" name="login">Login</button>
</form>
<?php
  session_start();
//Database Configuration File
include('connections.php');
error_reporting(0);
  if(isset($_POST['login']))
  {
    // Getting username/ email and password
    $uname=$_POST['username'];
    $password=md5($_POST['password']);
    // Fetch data from database on the basis of username/email and password
    $sql ="SELECT UserName,UserEmail,LoginPassword FROM userdata WHERE (UserName=:usname || UserEmail=:usname) and (LoginPassword=:usrpassword)";
    $query= $conn -> prepare($sql);
    $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
    $query-> bindParam(':usrpassword', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    $_SESSION['userlogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'welcome.php'; </script>";
  } else{
    echo "<script>alert('Invalid Details');</script>";
  }
}
?>

</body>
</html>
