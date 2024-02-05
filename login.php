<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">

    <title>Login | Pix Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="include/animated.css" rel="stylesheet">
    <link href="include/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="include/login.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


<body>
<?php session_start();

require './database/db.php';

//for login processing

   if (isset($_POST['login'])) {
  $email=$_POST['email'];
  $password=$_POST['password'];

   $query = "SELECT * FROM `user` WHERE email='$email' AND password='$password' ";
  
  $result = mysqli_query ($connect, $query);
  $count = mysqli_num_rows ($result);

    if ($count == 1) {
    header("location:index.php");
    $_SESSION['email'] = $email;
    
  }else{
  	$error = "Wrong Username or Password";
  }
}
?>

							

										    <div class="container">

										      <form class="form-signin animated shake" method="POST">
										        <h3 class="form-signin-heading">Inventory Management System</h3>

										        <label for="inputEmail" class="sr-only">Email address</label>
										        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" required>

										        <label for="inputPassword" class="sr-only">Password</label>
										        <input type="password" name="password" class="form-control"  placeholder="password" id="myInput" required>

										        <div class="custom-control custom-checkbox mb-3">
													<input    type="checkbox" class="custom-control-input" id="customCheck1" onclick="myFunction()">
													<label class="custom-control-label label" for="customCheck1">Show password</label>
												</div>

                              <div class="checkbox">
                                <label>
                                <?php
                                if (isset($error)) {
                                  echo "$error";
                                }
                                ?>
                                </label>
                              </div>

										        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>

										      </form>

										    </div> <!-- /container -->


										    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
										    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
										


<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


</script>
</body>
</html>
