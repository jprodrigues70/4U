<?php
require_once('../helpers/connect.php');
require_once('../models/users.php');
require_once('../models/disciplines.php');
require_once('../models/institutes.php');
require_once('../models/files.php');
require_once('../models/comments.php');
class Posts extends Connect{
    public $id;
    public $text;
    public $time;
    public $user;
    public $file;
    public $discipline;
    public $comments;
    public $institute;

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
            $this->file = Files::select($attributes['file']);
            $this->discipline = Disciplines::select($attributes['discipline']);
            $this->comments = Comments::AllByPost($attributes['id']);
        }
    }
    
    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO posts(text, time, user, discipline, file) VALUES (:text, :time, :user, :discipline, :file)");
        $stm->bindValue(":text",$this->text,PDO::PARAM_STR);
        $stm->bindValue(":time",$this->time,PDO::PARAM_STR);
        $stm->bindValue(":user",$this->user->id,PDO::PARAM_INT);
        $stm->bindValue(":file",$this->file->id,PDO::PARAM_INT);
        $stm->bindValue(":discipline",$this->discipline->id,PDO::PARAM_INT);
        return $stm->execute();
    }

    public static function allByDiscipline($discipline) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM posts WHERE discipline = :discipline ORDER BY time DESC");
        $stm->bindValue(":discipline", $discipline, PDO::PARAM_INT);
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stm->fetchAll();
    }
    
    public static function allByUserFollowing($user) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT p.* FROM posts p INNER JOIN users_has_disciplines ud ON ud.discipline = p.discipline and ud.user = :user ORDER BY time DESC");
        $stm->bindValue(":user", $user, PDO::PARAM_INT);
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stm->fetchAll();
    }
}
?>
