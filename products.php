<?php include 'inc/header.php'; ?>


  <!-- add Product -->
 <?php
     $user=new User();
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
       // code...
       $msg=$user->AddProduct($_POST);
     }
  ?>



<div class="container">
  <div class="card">
    <!-- <h5 class="card-header">All Users</h5> -->
    <div class="card-body">
      <h5 class="card-title">


      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add new Product
</button>

</h5>
<h6>
  <?php
 if(isset($msg)){
     if($msg==true){
        echo '<div class="alert alert-success" role="alert">Product Added Successfully </div>';
     }elseif($msg==false){
        echo '<div class="alert alert-danger" role="alert">Product is not Added Successfully';
     }else{

     }
  }
?>
</h6>
<!-- delete Product -->
<?php
       if(isset($_GET['del_id'])){
         $delid = $_GET['del_id'];
         $sql ="Select * from products where product_id='$delid'";
         $data = $db->select($sql);
         $data=$data->fetch_assoc();
         $filename=$data['productPhoto'];
        $unlink = unlink('inc/uploads/'.$filename);
        if($unlink){
         $delquery ="delete from products where product_id='$delid'";
         $deldata = $db->delete($delquery);
           if($deldata){
             echo '<div class="alert alert-success" role="alert">Product deleted Successfully </div>';
           }
           else{
              echo '<div class="alert alert-danger" role="alert">Product is not deleted Successfully';
           }
         }else{
             echo '<div class="alert alert-danger" role="alert">Image is not deleted Successfully';
          }
     }


  ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="form" action="" method="POST"  enctype="multipart/form-data" >
            <h3>Add new Product</h3>

          <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" id="productName" name="productName" class="form-control"  />
          </div>

          <div class="form-group">
            <label for="price">Product Price</label>
            <input type="text" id="price" name="price" class="form-control"  />
          </div>

          <div class="form-group">
            <label for="productPhoto">product Photo</label>
            <input id="productPhoto" name="productPhoto" type="file" >
          </div>

          <div class="form-group text-center">
              <button type="submit" name="add_product" class="btn btn-success">ADD Product</button>
          </div>
    </form>


      </div>

    </div>
  </div>
</div>


    </div>
  </div>
  <div class="card">
    <h5 class="card-header">All Product</h5>
    <div class="card-body">



<!-- show all users -->
<div class="table-responsive">
  <table id="product" class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">productName</th>
      <th scope="col">price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
              <?php
               $user=new User();
               $get_product=$user->getProductData();
               if($get_product){
               $i=1;
               foreach ($get_product as $data) {


                ?>
    <tr>

      <th scope="row"> <?php echo $i++;?></th>
      <td><?php echo $data['productName'] ?></td>
      <td><?php echo $data['price'] ?></td>
      <td><img src="inc/uploads/<?php echo $data['productPhoto'] ?>" style="height:100px; width:100px;" ></td>
      <!-- <td><img src="<?php SITE_ROOT.'/uploads/'.$data['productPhoto'] ?>"  /></td> -->
        <td>
          <a onclick="return confirm('Are you sure to Delete ')" style="color:red" href="?del_id=<?php echo $data['product_id'] ?>"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
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
$('#modal').on('hidden.bs.modal', function(e) {
$('#modal form :input').val("");
});
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#product').DataTable();
    } );
</script>



<?php include 'inc/footer.php'; ?>
