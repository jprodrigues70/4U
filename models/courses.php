<?php
require_once('../helpers/connect.php');
class Courses extends Connect{
    public $code;
    public $name;
    public $institute;
    public $area;
    function __construct($attributes)
    {
        if (!empty($attributes))
        {
            $this->code = $attributes['code'];
            $this->name = $attributes['name'];
            $this->institute = $attributes['institute'];
            $this->area = $attributes['area'];
        }
    }

    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO courses(code, name, institute, area) VALUES (:code, :name, :institute, :area)");
        $stm->bindValue(":code",$this->code,PDO::PARAM_STR);
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":institute",$this->institute,PDO::PARAM_STR);
        $stm->bindValue(":area",$this->area,PDO::PARAM_STR);
        return $stm->execute();
    }

    public function update($id) {
        $connect = static::start();
        $stm = $connect->prepare("UPDATE courses SET code=:code, name=:name, institute=:institute, area=:area WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->bindValue(":code",$this->code,PDO::PARAM_STR);
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":institute",$this->institute,PDO::PARAM_STR);
        $stm->bindValue(":area",$this->area,PDO::PARAM_STR);
        return $stm->execute();
    }

    public static function select($id) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM courses WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public static function selectAll() {
        $connect = static::start();
        $stm = $connect->query("SELECT * FROM courses ORDER BY area, name");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public static function selectByInstitute($institute) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM courses WHERE institute=:institute");
        $stm->bindValue(":institute", $institute, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public static function selectByArea($institute) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM courses WHERE area=:area");
        $stm->bindValue(":area", $area, PDO::PARAM_INT);
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