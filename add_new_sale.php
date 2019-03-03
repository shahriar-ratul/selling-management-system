<?php include 'inc/header.php'; ?>

<div class="container">
  <div class="card">
    <!-- <h5 class="card-header">All Users</h5> -->
    <div class="card-body">
      <h5 class="card-title">

       </h5>
     </div>
   </div>

   <?php
       $user=new User();
       if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
         // code...
         $msg=$user->Addsale($_POST);
       }
    ?>

<div class="overlay"><div class="loader"></div></div>
 <div class="card">
  <h5 class="card-header">New Sale</h5>
  <form  id="get_order_data" action="" method="post">

    <div class="form-group row">
      <label class="col-sm-3 col-form-label" align="right">Order Date</label>
      <div class="col-sm-6">
        <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label" align="right">Customer Name*</label>
      <div class="col-sm-6">
        <input type="text" id="cust_name" name="cust_name"class="form-control form-control-sm" placeholder="Enter Customer Name" required/>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
              <?php
               $user=new User();
               $get_product=$user->getProductData();
               if($get_product){
               $i=1;
               foreach ($get_product as $data) {
              ?>

                 <?php
                      }
                     }
                 ?>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <!-- <th scope="col">total Price</th> -->
              <th scope="col">Total Amount</th>
            </tr>
          </thead>
          <tbody id="invoice_item">
          </tbody>
        </table>

        <center style="padding:10px;">
          <button id="add" style="width:150px;" class="btn btn-success">Add</button>
          <button id="remove" style="width:150px;" class="btn btn-danger">Remove</button>
       </center>

      </div>
      <p></p>
        <div class="form-group row">
           <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
         <div class="col-sm-6">
           <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required/>
         </div>
       </div>
        <div class="form-group row">
          <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
          <div class="col-sm-6">
            <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
          <div class="col-sm-6">
            <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required/>
          </div>
        </div>


        <center>
          <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
        </center>


    </form>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>
