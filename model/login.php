<?php
$action = $_GET['action'];
require_once '../controller/login.php';
switch ($action) {
  case 'auth_user':
    $email = $_POST['username'];
    $pass = md5($_POST['password']);
    $authUser = new AuthUser($email, $pass);
    echo $authUser->loginAuthUser();
    break;

  default:
    // code...
    break;
}
 ?>
