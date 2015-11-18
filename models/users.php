<?php
require_once('../helpers/connect.php');
class Users extends Connect{
    public $name;
    public $email;
    public $password;
    public $level;
    public $course;

    function __construct($attributes) {
        if (!empty($attributes)) {
            $this->name = $attributes['name'];
            $this->email = $attributes['email'];
            $this->password = md5($attributes['password']);
            $this->level = $attributes['level'];
            $this->course = $attributes['course'];
        }
    }

    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO users(name, email, password, level, course, image) VALUES (:name, :email, :password, :level, :course, :image)");
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":email",$this->email,PDO::PARAM_STR);
        $stm->bindValue(":password",$this->password,PDO::PARAM_STR);
        $stm->bindValue(":level",$this->level,PDO::PARAM_INT);
        $stm->bindValue(":course",$this->course,PDO::PARAM_INT);
        $stm->bindValue(":image",$this->image,PDO::PARAM_STR);
        return $stm->execute();
    }

    public function update($id) {
        $connect = static::start();
        $stm = $connect->prepare("UPDATE users SET name=:name, email=:email, level=:level, course=:course, image=:image WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":email",$this->email,PDO::PARAM_STR);
        $stm->bindValue(":level",$this->level,PDO::PARAM_INT);
        $stm->bindValue(":course",$this->course,PDO::PARAM_INT);
        $stm->bindValue(":image",$this->image,PDO::PARAM_STR);
        return $stm->execute();
    }

    public function changePassword($id, $password) {
    	$connect = static::start();
        $stm = $connect->prepare("UPDATE users SET password=:password WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->bindValue(":password",$password,PDO::PARAM_STR);
        return $stm->execute();
    }

    public static function select($id) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM users WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public static function selectAll() {
        $connect = static::start();
        $stm = $connect->query("SELECT * FROM users ORDER BY name, email");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public static function delete($id) {
        $connect = static::start();
        $stm = $connect->prepare("DELETE FROM users WHERE id=:id LIMIT 1");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        return $stm->execute();
    }
}
?>