
<!-- <section class="vh-100 mt-5" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="name" name="name" class="form-control" />
                      <label class="form-label" for="name">Your Name</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="surname" name="surname" class="form-control" />
                      <label class="form-label" for="surname">Your Surname</label>
                    </div>
                  </div>


                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" />
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" />
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>

                  <div class="form-check d-flex  mb-5">
                    <input
                      class="form-check-input me-2"
                      type="checkbox"
                      value=""
                      id="form2Example3c"
                    />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="button" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->

<?php
//Database Configuration File
include('connections.php');
error_reporting(0);
if(isset($_POST['signup']))
{
//Getting Post Values
$fullname=$_POST['fname'];
$username=$_POST['username'];
$email=$_POST['email'];
$mobile=$_POST['mobilenumber'];
$password=md5($_POST['password']);
// Query for validation of username and email-id
$ret="SELECT * FROM userdata where (UserName=:uname ||  UserEmail=:uemail)";
$queryt = $conn -> prepare($ret);
$queryt->bindParam(':uemail',$email,PDO::PARAM_STR);
$queryt->bindParam(':uname',$username,PDO::PARAM_STR);
$queryt -> execute();
$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
if($queryt -> rowCount() == 0)
{
// Query for Insertion
$sql="INSERT INTO userdata(FullName,UserName,UserEmail,UserMobileNumber,LoginPassword) VALUES(:fname,:uname,:uemail,:umobile,:upassword)";
$query = $conn->prepare($sql);
// Binding Post Values
$query->bindParam(':fname',$fullname,PDO::PARAM_STR);
$query->bindParam(':uname',$username,PDO::PARAM_STR);
$query->bindParam(':uemail',$email,PDO::PARAM_STR);
$query->bindParam(':umobile',$mobile,PDO::PARAM_INT);
$query->bindParam(':upassword',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $conn->lastInsertId();
if($lastInsertId)
{
$msg="You have signup  Scuccessfully";
}
else
{
$error="Something went wrong.Please try again";
}
}
 else
{
$error="Username or Email-id already exist. Please try again";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PDO | Registration Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
<!--Javascript for check username availability-->
<script>
function checkUsernameAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
$("#username-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){
}
});
}
</script>
<!--Javascript for check email availability-->
<script>
function checkEmailAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#email-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){
 event.preventDefault();
}
});
}
</script>
</head>
<body>
<?php
    include("header.php");
    ?>
<form class="form-horizontal mt-5 ml-4" action='' method="post">
  <fieldset>
    <div id="legend" style="padding-left:4%">
      <legend class="">Register | <a href="index.php">Sign in</a></legend>
    </div>
<!--Error Message-->
  <?php if($error){ ?><div class="errorWrap">
                <strong>Error </strong> : <?php echo htmlentities($error);?></div>
                <?php } ?>
<!--Success Message-->
<?php if($msg){ ?><div class="succWrap">
                <strong>Well Done </strong> : <?php echo htmlentities($msg);?></div>
                <?php } ?>
 <div class="control-group">
      <!-- Full name -->
      <label class="control-label"  for="fullname">Full Name</label>
      <div class="controls">
        <input type="text" id="fname" name="fname"  pattern="[a-zA-Z\s]+" title="Full name must contain letters only" class="input-xlarge" required>
        <p class="help-block">Full can contain any letters only</p>
      </div>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" onBlur="checkUsernameAvailability()"  pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title="User must be alphanumeric without spaces 6 to 12 chars" class="input-xlarge" required>
            <span id="username-availability-status" style="font-size:12px;"></span>
        <p class="help-block">Username can contain any letters or numbers, without spaces 6 to 12 chars </p>
      </div>
    </div>
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="email" id="email" name="email" placeholder="" onBlur="checkEmailAvailability()" class="input-xlarge" required>
             <span id="email-availability-status" style="font-size:12px;"></span>
        <p class="help-block">Please provide your E-mail</p>
      </div>
    </div>
    <div class="control-group">
      <!-- Mobile Number -->
      <label class="control-label" for="mobilenumber">Mobile Number </label>
      <div class="controls">
        <input type="text" id="mobilenumber" name="mobilenumber" pattern="[0-9]{10}" maxlength="10"  title="10 numeric digits only"   class="input-xlarge" required>
        <p class="help-block">Mobile Number Contain only 10 digit numeric values</p>
      </div>
    </div>
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 4 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"  required class="input-xlarge">
        <p class="help-block">Password should be at least 4 characters</p>
      </div>
    </div>
    <div class="control-group">
      <!-- Confirm Password -->
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '')""  class="input-xlarge">
        <p class="help-block">Please confirm password</p>
      </div>
    </div>
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" type="submit" name="signup">Signup </button>
      </div>
    </div>
  </fieldset>
</form>
<script type="text/javascript">
</script>
</body>
</html>

    
