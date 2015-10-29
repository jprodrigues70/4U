<?php
require_once('../helpers/connect.php');
class UserHasDisciplines extends Connect{
    public $id;
    public $user;
    public $discipline;

    function __construct($attributes)
    {
        if (!empty($attributes))
        {
            $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : null;
            $this->user = $attributes['user'];
            $this->institute = $attributes['discipline'];
        }
    }

    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO user_has_disciplines (user, discipline) VALUES (:user, :discipline)");
        $stm->bindValue(":user", $this->user, PDO::PARAM_INT);
        $stm->bindValue(":discipline", $this->discipline, PDO::PARAM_INT);
        return $stm->execute();
    }
}
?>
