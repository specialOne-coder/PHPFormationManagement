  
  <?php
  session_start();
  $_SESSION = array();
  session_destroy();
  setcookie('login', '');
  setcookie('pass_hach','');
  header('location:../index.html');
  ?>