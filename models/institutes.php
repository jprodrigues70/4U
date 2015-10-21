<?php
require_once('../helpers/connect.php');
class Institutes extends Connect{
    public $name;
    public $area;
    function __construct($attributes)
    {
        if (!empty($attributes))
        {
            $this->name = $attributes['name'];
            $this->area = $attributes['area'];
        }
    }

    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO institutes(name, area) VALUES (:name, :area)");
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":area",$this->area,PDO::PARAM_STR);
        return $stm->execute();
    }

    public function update($id) {
        $connect = static::start();
        $stm = $connect->prepare("UPDATE institutes SET name=:name, area=:area WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->bindValue(":name",$this->name,PDO::PARAM_STR);
        $stm->bindValue(":area",$this->area,PDO::PARAM_STR);
        return $stm->execute();
    }

    public static function select($id) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM institutes WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public static function selectAll() {
        $connect = static::start();
        $stm = $connect->query("SELECT * FROM institutes ORDER BY name");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}
?>