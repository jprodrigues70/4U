<?php
require_once('../helpers/connect.php');
require_once('../models/users.php');
require_once('../models/disciplines.php');
class Posts extends Connect{
    public $id;
    public $text;
    public $time;
    public $user;
    public $file;
    public $discipline;
    public $comments;

    function __construct($attributes = array())
    {
        $attributes = empty($attributes) ? get_object_vars($this) : $attributes;

        //TODO: Refatorar
        if (!empty($attributes))
        {
            $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : null;
            $this->text = $attributes['text'];
            $this->time = $attributes['time'];
            $this->user = Users::select($attributes['user']);
            $this->file = $attributes['file'];
            $this->discipline = Disciplines::select($attributes['discipline']);
        }
    }

    public static function allByUserFollowing($user) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT p.* FROM posts p INNER JOIN users_has_disciplines ud
            ON ud.discipline = p.discipline and ud.user = :user");
        $stm->bindValue(":user", $user, PDO::PARAM_INT);
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stm->fetchAll();
    }
}
?>
