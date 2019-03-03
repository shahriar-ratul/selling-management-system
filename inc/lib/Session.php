<?php

class Session{

  //session start
  public static function init(){
    session_start();
  }
  //get session value
  public static function set($key,$val){
    $_SESSION[$key] = $val;
  }
  //set session value
  public static function get($key){

      if(isset($_SESSION[$key])){
        return $_SESSION[$key];
      }else{
        return false;
      }
  }
  //check login
  public static function checkSession(){
      self::init();
      if (self::get("login") == false) {
        self::destroy();
        header("Location:login.php");
      }
  }
  //logout
  public static function destroy(){
    session_destroy();
    header("Location:login.php");
  }

}


 ?>
