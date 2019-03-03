<?php

include_once 'Session.php';
include 'config.php';
include 'Database.php';
include 'Format.php';
class User{
    private $db;

    public function __construct(){
        $this->db=new Database();
        $this->fm=new Format();
    }
    //User register
    public function UserRegister($data){
    // $username=$data['username'];
    // $email=$data['email'];
    // $password=$data['password'];

    $username = $this->fm->validation($data['username']);
    $email = $this->fm->validation($data['email']);
    $password = $this->fm->validation($data['password']);

    $username = mysqli_real_escape_string(  $this->db->link,$username);
    $email = mysqli_real_escape_string(  $this->db->link,$email);
    $password = mysqli_real_escape_string(  $this->db->link,$password);


     $chk_email=$this->emailCheck($email);
     $chk_username=$this->userCheck($username);

    if( $username == "" || $email == "" || $password == "") {

        $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Field must not be Empty </div>";
        return $msg;
      }
      if (strlen($password)<4 ){
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Password is too short.<br/>Password must be at least 4 characters</div>";
       return $msg;
     }

     $password =  md5($password);

     if (strlen($username)<3 ){
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Username is too short</div>";
        return $msg;
      }

      if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
        $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> email address not found! Enter Correct Email Address </div>";
        return $msg;
      }
      if($chk_username == true){
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Username address already exist! </div>";
        return $msg;
      }
      if($chk_email == true){
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> email address already exist! </div>";
        return $msg;
      }
      $created_at = date("Y-m-d H:i:s");
      $updated_at = date("Y-m-d H:i:s");

      $sql= "INSERT INTO users(username,email,password,created_at,updated_at)  VALUES('$username', '$email', '$password', '$created_at' , '$updated_at')";
      $result =$this->db->insert($sql);
      if($result){
          $msg = "<div class='alert alert-success'> <strong> Success !!  </strong> Thank you, you have been registered! </div>";
          return $msg;

      }else{
        $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> there is problem try later! </div>";
      return $msg;
      }

    }

    //check email exists
    public function emailCheck($email){
    $sql = "SELECT email from users where email = '$email' ";
    $result =   $this->db->select($sql);
    if($result != false){
      if(mysqli_num_rows($result) > 0){
        return true;
      }else{
        return false;
      }
    }
  }
    //check username exists
    public function userCheck($username){
    $sql = "SELECT username from users where username = '$username' ";
    $result =   $this->db->select($sql);
    if($result != false){
    if(mysqli_num_rows($result) > 0){
        return true;
      }else{
        return false;
      }
    }
  }



    //login function
    public function UserLogin($data){
      $email = $this->fm->validation($data['email']);
      $password = $this->fm->validation(md5($data['password']));

       $email = mysqli_real_escape_string(  $this->db->link,$email);
       $password = mysqli_real_escape_string(  $this->db->link,$password);

       $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

       $result =   $this->db->select($query);

       if($result != false){
         $value = mysqli_fetch_array($result);
         $row   = mysqli_num_rows($result);
         if($row > 0){
             Session::set("login", true);
             Session::set("username", $value['username']);
             Session::set("email", $value['email']);
             Session::set("userId", $value['user_id']);
             header("Location:index.php");
         }else{
             $msg = "<span style='color:red';font-size:26px;>no result found !!</span>";
            return $msg;
         }
       }else{
         $msg = "<span style='color:red';font-size:26px;>Username or password not match !!</span>";
          return $msg;
       }

    }
    //get all user
    public function getUserData(){
      $sql = "SELECT * FROM users ORDER BY user_id DESC";
      $result =   $this->db->select($sql);
      return $result;
    }
    //get allproduct
    public function getProductData(){
      $sql = "SELECT * FROM products ORDER BY product_id DESC";
      $result =   $this->db->select($sql);
      return $result;
    }
    //insert Product
    public function AddProduct($data){

      $productName = $this->fm->validation($data['productName']);
      $price = $this->fm->validation($data['price']);
      $productName = mysqli_real_escape_string(  $this->db->link,$productName);
      $price = mysqli_real_escape_string(  $this->db->link,$price);
      $productPhoto=($_FILES['productPhoto']['name']);
      $created_at = date("Y-m-d H:i:s");
      $updated_at = date("Y-m-d H:i:s");
      if( $productName == "" || $price == "" || $productPhoto == "") {
          $msg = null;
        }

      if(move_uploaded_file($_FILES['productPhoto']['tmp_name'],SITE_ROOT.'/uploads/'.$productPhoto))
      {

        $sql= "INSERT INTO products(productName,price,productPhoto,created_at,updated_at)  VALUES('$productName', '$price', '$productPhoto', '$created_at' , '$updated_at')";
        $result =$this->db->insert($sql);
        if($result){
            $msg = true;
          }else{
              $msg = false;
          }
        }
          else{
              $msg = false;
          }


    // Display status message
    return $msg;

    }
    //get allproduct
    public function getSaleData(){
      $sql = "SELECT * FROM sales ORDER BY sale_id DESC";
      $result =   $this->db->select($sql);
      return $result;
    }
    //add new sale
    public function Addsale(){
      $orderdate = $_POST["order_date"];
      $cust_name = $_POST["cust_name"];

      $pro_id = implode( ",", $_POST["product_id"]);
      $ar_qty  = implode( ",", $_POST["qty"]);
      $sub_total = $_POST["sub_total"];
      $paid = $_POST["paid"];
      $due = $_POST["due"];
      // $pro_id=$_POST["product_id"];
      $created_at = date("Y-m-d H:i:s");
      $updated_at = date("Y-m-d H:i:s");

      $sql= "INSERT INTO sales(product_id,customerName,order_date,quantity,totalAmount,paidAmount,dueAmount,created_at,updated_at)  VALUES('$pro_id','$cust_name', '$orderdate','$ar_qty','$sub_total','$paid','$due', '$created_at' , '$updated_at')";
      $result =$this->db->insert($sql);

      if($result){

          return True;

      }else{

      return false;
      }
    }


  }
 ?>
