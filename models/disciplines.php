<?php
require_once('../helpers/connect.php');
class Disciplines extends Connect{
    public $code;
    public $name;
    public $institute;
    function __construct($attributes)
    {
        if (!empty($attributes))
        {
            $this->code = $attributes['code'];
            $this->name = $attributes['name'];
            $this->institute = $attributes['institute'];
        }
    }

    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO disciplines(code, name, institute) VALUES (:code, :name, :institute)");
        $stm->bindValue(":code",$this->code,PDO::PARAM_STR);
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":institute",$this->institute,PDO::PARAM_STR);
        return $stm->execute();
    }

    public function update($id) {
        $connect = static::start();
        $stm = $connect->prepare("UPDATE disciplines SET code=:code, name=:name, institute=:institute WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->bindValue(":code",$this->code,PDO::PARAM_STR);
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":institute",$this->institute,PDO::PARAM_STR);
        return $stm->execute();
    }

    public static function select($id) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM disciplines WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public static function selectAll() {
        $connect = static::start();
        $stm = $connect->query("SELECT * FROM disciplines ORDER BY code");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public static function selectByInstitute($institute) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM disciplines WHERE institute=:institute ORDER BY code");
        $stm->bindValue(":institute", $institute, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    
    public static function getInstitute($id){
        $connect = static::start();
        $stm = $connect->prepare("SELECT name FROM institutes WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_OBJ);
        return $result->name;
    }
}
?>