<?php
  include_once 'inc/lib/Session.php';
  include 'inc/lib/config.php';
  include 'inc/lib/Database.php';
  Session::checkSession();
  $db=new Database();


   if (isset($_POST["getNewOrderItem"])) {
    $sql = "SELECT * FROM products ORDER BY product_id DESC";
    $result =   $db->select($sql);
    if ($result) {
    ?>
      <tr>
        <td><b class="number">1</b></td>
        <td>
            <select name="product_id[]" class="form-control form-control-sm product_id" required>
                <option value="">Choose Product</option>
                <?php
                  foreach ($result as $row) {
                ?>
              <option value="<?php echo $row['product_id']; ?>"><?php echo $row["productName"]; ?></option>
                <?php
                  }
                ?>
            </select>
          </td>
      <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></td>
      <td><input name="qty[]" type="text"  class="form-control form-control-sm qty" ></span>
    <!-- <td>  <span><input name="tprice[]" type="text" class="form-control form-control-sm tprice" readonly> -->
      <span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></td>
      <td>BDT.<span class="amt">0</span></td>
    </tr>
<?php
      exit();
    }
  }

  //Get price and qty of one item
if (isset($_POST["getPriceAndQty"])) {
  // echo $id=$_POST["product_id"];
  $id=$_POST["id"];
  $query = "SELECT * FROM products WHERE product_id ='$id'";
  $result =  $db->select($query);
  $result = Mysqli_fetch_assoc($result);
	echo json_encode($result);
	exit();
}


 function Addsale($data){
  die();
  $orderdate = $data["order_date"];
  $cust_name = $data["cust_name"];


  //Now getting array from order_form
  $ar_qty = $data["qty"];
  $ar_price = $data["price"];
  $ar_pro_name = $data["pro_name"];

  $sub_total = $data["sub_total"];
  $paid = $data["paid"];
  $due = $data["due"];

  $created_at = date("Y-m-d H:i:s");
  $updated_at = date("Y-m-d H:i:s");

  $sql= "INSERT INTO sales(customerName,order_date,quantity,totalAmount,paidAmount,dueAmount,created_by,updated_by,created_at,updated_at)  VALUES('$cust_name', '$orderdate', '$ar_qty','$sub_total','$paid','$due', '$created_at' , '$updated_at')";
  $result =$db->insert($sql);

  if($result){

      return True;

  }else{

  return false;
  }
}



if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])) {


	$data['orderdate'] = $_POST["order_date"];
	$data['cust_name'] = $_POST["cust_name"];

	//Now getting array from order_form
	$data['ar_qty'] = $_POST["qty"];
	$data['ar_price'] = $_POST["price"];
	$data['ar_pro_name'] = $_POST["pro_name"];

	$data['sub_total'] = $_POST["sub_total"];
	$data['paid'] = $_POST["paid"];
	$data['due'] = $_POST["due"];

  $data['created_at'] = date("Y-m-d H:i:s");
  $data['updated_at'] = date("Y-m-d H:i:s");

  Addsale($data);

  }



 ?>
