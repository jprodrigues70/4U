<?php
require_once('../helpers/connect.php');
class Files extends Connect{
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
            $this->title = $attributes['title'];
            $this->file = $attributes['file'];
        }
    }
    
    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO files(title, file) VALUES (:title, :file)");
        $stm->bindValue(":title",$this->title,PDO::PARAM_STR);
        $stm->bindValue(":file",$this->file,PDO::PARAM_STR);
        $stm->execute();
        $sth = $connect->prepare("SELECT id FROM files WHERE file=:file");
        $sth->bindValue(":file",$this->file,PDO::PARAM_STR);
        $sth->execute();
        $thisFile = $sth->fetch(PDO::FETCH_OBJ);
        return $thisFile->id;
    }
    
    public static function select($id) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM files WHERE id=:id");
        $stm->bindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }
}
?>
