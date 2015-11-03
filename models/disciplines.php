<?php
require_once('../helpers/connect.php');
require_once('institutes.php');
class Disciplines extends Connect{
    public $id;
    public $code;
    public $name;
    public $institute;
    function __construct($attributes = array())
    {
        $attributes = empty($attributes) ? get_object_vars($this) : $attributes;

        if (!empty($attributes))
        {
            $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : null;
            $this->code = $attributes['code'];
            $this->name = $attributes['name'];
            $this->institute = Institutes::select($attributes['institute']);
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
        $stm->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stm->fetch();
    }

    public static function selectByCode($code) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM disciplines WHERE LOWER(code)=:code");
        $stm->bindValue(":code", $code, PDO::PARAM_STR);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public static function selectAll() {
        $connect = static::start();
        $stm = $connect->query("SELECT * FROM disciplines ORDER BY code");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($term) {
        $term = strtolower($term)."%";
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM disciplines WHERE LOWER(code) LIKE :term OR LOWER(name) LIKE :term");
        $stm->bindValue(":term", $term, PDO::PARAM_INT);
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
