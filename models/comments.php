<?php
require_once('../helpers/connect.php');
require_once('../models/users.php');
require_once('../models/disciplines.php');
require_once('../models/institutes.php');
require_once('../models/files.php');

class Comments extends Connect{
    public $id;
    public $text;
    public $time;
    public $user;
    public $post;

    function __construct($attributes = array())
    {
        $attributes = empty($attributes) ? get_object_vars($this) : $attributes;

        //TODO: Refatorar
        if (!empty($attributes))
        {
            $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : null;
            $this->text = $attributes['text'];
            $this->time = $attributes['time'];
            $this->post = $attributes['post'];
            $this->user = Users::select($attributes['user']);
        }
    }
    
    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO comments(text, time, user, post) VALUES (:text, :time, :user, :post)");
        $stm->bindValue(":text",$this->text,PDO::PARAM_STR);
        $stm->bindValue(":time",$this->time,PDO::PARAM_STR);
        $stm->bindValue(":user",$this->user->id,PDO::PARAM_INT);
        $stm->bindValue(":post",$this->post,PDO::PARAM_INT);
        return $stm->execute();
    }

    public static function allByPost($post) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM comments WHERE post = :post ORDER BY time ASC");
        $stm->bindValue(":post", $post, PDO::PARAM_INT);
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stm->fetchAll();
    }

    public function delete() {
        $connect = static::start();
        $stm = $connect->prepare("DELETE FROM comments WHERE id = :id");
        $stm->bindValue(":id", $this->id, PDO::PARAM_INT);
        return $stm->execute();
    }

    public static function find($id) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM comments WHERE id = :id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stm->fetch();
    }
}
?>
