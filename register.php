
<?php
include_once 'inc/lib/Session.php';
// include 'inc/header.php';
include 'inc/lib/User.php';
Session::checkSession();
 ?>

 <?php
     $user=new User();
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
       // code...
        $msg=$user->UserRegister($_POST);
     }
  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    </head>
  <body>
    <div class="container">

      <!-- As a link -->
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand mb-5 h1" href="#">PHP Sales System</a>
      </nav>


    <div class="panel panel-default">
      <div class="panel-body">
        <div style="max-width:600px; margin:0 auto">

          <?php
           if(isset($msg)){
              echo $msg;
            }
          ?>

        <form  action="" method="POST">
          	<h3>User Register</h3>
          <div class="form-group">
            <label for="name">Username</label>
            <input type="text" id="username" name="username" class="form-control"  />
          </div>
          <div class="form-group">
            <label for="Email">Email Address</label>
            <input type="text" id="email" name="email" class="form-control"  />
          </div>


          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control"  />

          </div>

            <button type="submit" name="register" class="btn btn-success">register</button>

        </form>
      </div>

      </div>

    </div>
  </div>
