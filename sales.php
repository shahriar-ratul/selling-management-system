<?php include 'inc/header.php'; ?>


<div class="container">
  <div class="card">
    <!-- <h5 class="card-header">All Users</h5> -->
    <div class="card-body">
      <h5 class="card-title">

      <!-- Button trigger modal -->
      <a href="add_new_sale.php" class="btn btn-primary" >
      Add new Sale
      </a>
    </h5>
<!-- delete Product -->
<?php
       if(isset($_GET['del_id'])){
         $delid = $_GET['del_id'];
         $delquery ="delete from sales where sale_id='$delid'";
         $deldata = $db->delete($delquery);
           if($deldata){
             echo '<div class="alert alert-success" role="alert">Sales deleted Successfully </div>';
           }
           else{
              echo '<div class="alert alert-danger" role="alert">Sales is not deleted Successfully';
           }
         }


  ?>



    </div>
  </div>
  <div class="card">
    <h5 class="card-header">All Sales</h5>
    <div class="card-body">



<!-- show all users -->
<div class="table-responsive">
  <table id="product" class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">customerName</th>
      <th scope="col">quantity</th>
      <th scope="col">totalAmount</th>
      <th scope="col">paidAmount</th>
      <th scope="col">dueAmount</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
              <?php
               $user=new User();
               $get_sale=$user->getSaleData();
               if($get_sale){
               $i=1;
               foreach ($get_sale as $data) {


                ?>
    <tr>

      <th scope="row"> <?php echo $i++;?></th>
      <td><?php echo $data['customerName'] ?></td>
      <td><?php echo $data['quantity'] ?></td>
      <td><?php echo $data['totalAmount'] ?></td>
      <td><?php echo $data['paidAmount'] ?></td>
      <td><?php echo $data['dueAmount'] ?></td>
      <td>
          <a style="color:red" onclick="return confirm('Are you sure to Delete ')" href="?del_id=<?php echo $data['sale_id'] ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
      </td>
      </tr>

        <?php
              }
           } else{ ?>
       <tr>
         <td>No data Found</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#product').DataTable();
    } );
</script>



<?php include 'inc/footer.php'; ?>
