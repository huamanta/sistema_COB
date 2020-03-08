<?php
/**
 *
 */
class AuthUser
{
  private $conn;
  public $firstName;
  public $lastName;
  function __construct(string $usuario, string $password)
  {
    require_once 'connection.php';
    $this->firstName = $usuario;
    $this->lastName = $password;
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

  public function loginAuthUser()
  {
    try {
            $stm = $this->conn->prepare("SELECT * FROM usuario WHERE username = ? AND password = ?");
            $stm->execute(array($this->firstName, $this->lastName));
            $result = $stm->fetch(PDO::FETCH_OBJ);
            if($result){
                if($this->firstName === $result->username && $this->lastName === $result->password){
                  session_start();
                  $_SESSION["username"] = $result->username;
                  $_SESSION["id_usuario"] = $result->id_usuario;
                  $_SESSION["id_rol"] = $result->id_rol;
                  if ($result->estado != '1') {
                    return json_encode(array('success' => 2));
                  }else {
                    return json_encode(array('success' => 1));
                  }
                }else {
                  return json_encode(array('success' => 0));
                }
            }else{
                return json_encode(array('success' => 0));
            }
    } catch (\Exception $e) {
      die($e->getMessage());
    }

  }
}

 ?>
