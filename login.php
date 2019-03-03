<?php
include_once 'inc/lib/Session.php';
Session::init();

 ?>
<?php
// include 'inc/header.php';

// include 'inc/lib/config.php';
// include 'inc/lib/Database.php';
// include 'inc/lib/Format.php';
include 'inc/lib/User.php';
// Session::checkSession();
$user=new User();
$db=new Database();
$fm=new Format();
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
      <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
           $msg=$user->UserLogin($_POST);
        }
       ?>


    <div class="panel panel-default">

    <div class="panel-body">
      <div style="max-width:600px; margin:0 auto">
        <div id="frmRegistration">
          <form class="form-horizontal" method="POST" action="">
          	<h3>User Login</h3>
            <?php
             if(isset($msg)){
                echo $msg;
              }
            ?>
            <div class="form-group">
              <label class="control-label col-sm-4" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd">Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
  </div>

  </body>
</html>
