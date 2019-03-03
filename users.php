<?php include 'inc/header.php'; ?>
  <!-- add user -->
 <?php
     $user=new User();
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
       // code...
        $msg=$user->UserRegister($_POST);
     }
  ?>






<div class="container">
  <div class="card">
    <!-- <h5 class="card-header">All Users</h5> -->
    <div class="card-body">
      <h5 class="card-title">


      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add new User
</button>

</h5>
<h6>
  <?php
 if(isset($msg)){
    echo $msg;
  }
  $msg=null;
?>
</h6>
<!-- delete user -->
<?php
       if(isset($_GET['del_id'])){
         $delid = $_GET['del_id'];
         $delquery ="delete from users where user_id='$delid'";
         $deldata = $db->delete($delquery);
         if($deldata){
           echo '<div class="alert alert-success" role="alert">user deleted Successfully </div>';

         }
         else{
            echo '<div class="alert alert-danger" role="alert">User is not deleted Successfully';
         }

       }


  ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


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

          <div class="form-group text-center">
              <button type="submit" name="register" class="btn btn-success">register</button>
          </div>
    </form>


      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="register">Add</button>
      </div> -->

    </div>
  </div>
</div>


    </div>
  </div>
  <div class="card">
    <h5 class="card-header">All Users</h5>
    <div class="card-body">



<!-- show all users -->
<div class="table-responsive">
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">email</th>
      <!-- <th scope="col">Password</th> -->
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
              <?php
               $user=new User();
               $userdata=$user->getUserData();
               if($userdata){
               $i=1;
               foreach ($userdata as $data) {


                ?>
    <tr>

      <th scope="row"> <?php echo $i++;?></th>
      <td><?php echo $data['username'] ?></td>
      <td><?php echo $data['email'] ?></td>
      <!-- <td><?php echo md5($data['password']) ?></td> -->
      <?php if($data['user_id']!=$id){ ?>
        <td>
          <!-- <a href="profile.php?id=<?php echo $data['user_id'] ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a> -->
            &nbsp
          <a style="color:red" onclick="return confirm('Are you sure to Delete ')" href="?del_id=<?php echo $data['user_id'] ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
        </td>
      </tr>

    <?php
          }else{

          }
    ?>


        <?php
              }
           } else{ ?>
       <tr>
         <td>No data Found</td>
      </tr>
      <?php
          }
      ?>
    </tbody>
</table>
</div>

</div>
</div>
</div>




<?php include 'inc/footer.php'; ?>
