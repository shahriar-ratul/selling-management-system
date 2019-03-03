 <?php
 define ('SITE_ROOT', realpath(dirname(__FILE__)));


  include 'inc/lib/user.php';
  Session::checkSession();
  $user=new User();
  $db=new Database();
  $fm=new Format();
?>
<!-- get login message -->
<?php
   $loginmsg = Session::get("loginmsg");
    if(isset($loginmsg)){
    echo $loginmsg;
    Session::set("loginmsg",NULL);
  }
?>
<!-- logout -->
<?php
      if(isset($_GET['action']) && $_GET['action'] == "logout"){
        Session::destroy();
      }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin dshboard</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

    <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>

  <!-- bootstrap js -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <!-- custom csss -->
  <link href="asset/css/simple-sidebar.css" rel="stylesheet">


  <!-- datatable -->
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="asset/js/order.js"></script>

  <style media="screen">
    .dropdown-item {
          padding: 0.25rem 3.5rem;
    }

  </style>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">PHP Sales System</div>
      <div class="list-group list-group-flush">
          <a href="index.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
          <a href="products.php" class="list-group-item list-group-item-action bg-light">Products</a>
          <a href="sales.php" class="list-group-item list-group-item-action bg-light">Sales</a>
          <a href="users.php" class="list-group-item list-group-item-action bg-light">users</a>
      </div>
    </div>

    <!-- /#sidebar-wrapper -->


    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"> Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php

           $id= Session::get("userId");
           $name =Session::get("username");
           $userlogin=Session::get("login");
           if($userlogin == true ){
          ?>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fa fa-user fa-fw mr-3"></span>
                <?php
                if(isset($name)){
                      echo $name;
                  }
                  ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profile.php?id=<?php echo $id ?>">Profile</a>
                <a class="dropdown-item" href="?action=logout">logout</a>
            </li>
          <?php }else{
          ?>
          <li> <a href="login.php">Login</a> </li>
         <?php } ?>
          </ul>
        </div>
      </nav>
