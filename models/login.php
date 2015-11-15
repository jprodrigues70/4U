<?php
require_once('../helpers/connect.php');

class Login extends Connect{
    public $email;
    public $password;

    public function __construct($attributes){
        if (!empty($attributes))
        {
            $this->email = $attributes['email'];
            $this->password = md5($attributes['password']);
        }
    }
    public function login(){
        $connect = static::start();
        $sth = $connect->prepare("SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1");
        $sth->bindValue(":email", $this->email, PDO::PARAM_STR);
        $sth->bindValue(":password", $this->password, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
