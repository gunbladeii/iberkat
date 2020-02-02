<?php require('adminAFM/conn.php'); ?>
<?php

session_start();
  if(isset($_GET['message'])){
		if($_GET['message'] == "fail"){
			echo "Please check again your username/password";
		}else if($_GET['message'] == "logout"){
			echo "You've been logout";
		}else if($_GET['message'] == "not_login"){
			echo "You're not login yet";
		}
	}
  if(isset($_POST['submit']))
  {
      $username = $_POST["username"];
      $password = $_POST["password"];
      
      $query = "SELECT * FROM login WHERE username = '$username' AND password='$password'";
      $result = mysqli_query($mysqli, $query);
      
      if(mysqli_num_rows($result) > 0)
      {
          while($row = mysqli_fetch_assoc($result))
          {
              if($row["role"] == "administrator")
              {
                  $_SESSION['user'] = $row['username'];
                  $_SESSION['role'] = $row["role"];
                  $_SESSION['password'] = $row["password"];
                  header('Location:adminAFM/index.php');
              }
              else if($row["role"] == "rider")
              {
                  $_SESSION['user'] = $row['username'];
                  $_SESSION['role'] = $row["role"];
                  $_SESSION['password'] = $row["password"];
                  header('Location:riderAFM/profileRider.php');
              }
              else if($row["role"] == "ss")
              {
                  $_SESSION['user'] = $row['username'];
                  $_SESSION['role'] = $row["role"];
                  $_SESSION['password'] = $row["password"];
                  header('Location:supervisorAFM/index.php');
              }
              else if($row["role"] != "administrator" || $row["role"] != "ss" ||$row["role"] != "rider")
              {
                  header('Location:index.php?message=fail');
              }
          }  
      }
      
  }
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>iBerkat | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="adminAFM/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminAFM/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box shadow p-3 mb-5 bg-white rounded">
  <div class="login-logo">
  <a href="index.php"><img src="adminAFM/iberkat.jpeg" style="width:55%"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form role="form" method="POST" class="login-form" name="prosesLogin">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" id="username" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
          <div class="input-group-append input-group-text">
              <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember" value="1">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Log In">
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!--
      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
