<?php
  include('./utils.php');
  class Users{
    private $name;
    private $email;
    private $phone;
    private $password; 

    public function userLogin($data){
      $utils = new Utils();
      $this->email = $data['email'];
      $this->password = $data['password'];

      $sql = "SELECT * FROM users WHERE email = '$this->email' AND password = '$this->password'";
      $stmt = $utils->conn->prepare($sql);
      $stmt->execute(['id' => $this->email,'password'=>$this->password]);
      $rows = $stmt->fetchAll();
    }
    public function userRegister($data){
      var_dump($data);
    }
    public function userLogout(){
      
    }
  }