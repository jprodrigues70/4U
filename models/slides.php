<?php
require_once('../helpers/connect.php');
class Slides extends Connect{
    public $title;
    public $link;
    public $expire;
    public $image;

    function __construct($attributes) {
        if (!empty($attributes)) {
            $this->title = $attributes['title'];
            $this->link = $attributes['link'];
            $this->expire = $attributes['expire'];
            $this->image = $attributes['image'];
        }
    }

    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO slides(title, link, expire, image) VALUES (:title, :link, :expire, :image)");
        $stm->bindValue(":title",$this->title,PDO::PARAM_STR);
        $stm->bindValue(":link",$this->link,PDO::PARAM_STR);
        $stm->bindValue(":expire",$this->expire,PDO::PARAM_STR);
        $stm->bindValue(":image",$this->image,PDO::PARAM_STR);
        return $stm->execute();
    }

    public function update($id) {
        $connect = static::start();
        $stm = $connect->prepare("UPDATE slides SET title=:title, link=:link, image=:image WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->bindValue(":title",$this->title,PDO::PARAM_STR);
        $stm->bindValue(":link",$this->link,PDO::PARAM_STR);
        $stm->bindValue(":image",$this->image,PDO::PARAM_STR);
        return $stm->execute();
    }

    public static function select($id) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM slides WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public static function selectAll() {
        $connect = static::start();
        $stm = $connect->query("SELECT * FROM slides ORDER BY title, link");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public static function delete($id) {
        $connect = static::start();
        $stm = $connect->prepare("DELETE FROM slides WHERE id=:id LIMIT 1");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        return $stm->execute();
    }
}
?>