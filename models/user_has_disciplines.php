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
            $this->discipline = $attributes['discipline'];
        }
    }

    public function insert() {
        $connect = static::start();
        $stm = $connect->prepare("INSERT INTO users_has_disciplines (user, discipline) VALUES (:user, :discipline)");
        $stm->bindValue(":user", $this->user, PDO::PARAM_INT);
        $stm->bindValue(":discipline", $this->discipline, PDO::PARAM_INT);
        return $stm->execute();
    }

    public static function exists($id, $discipline) {
        $connect = static::start();
        $stm = $connect->prepare("SELECT * FROM users_has_disciplines WHERE user = :user AND discipline = :discipline");
        $stm->bindValue(":user", $id, PDO::PARAM_INT);
        $stm->bindValue(":discipline", $discipline, PDO::PARAM_INT);
        $stm->execute();
        return count($stm->fetchAll()) > 0;
    }

    public static function delete($user, $discipline) {
        $connect = static::start();
        $stm = $connect->prepare("DELETE FROM users_has_disciplines WHERE user=:user AND discipline=:discipline LIMIT 1");
        $stm->bindValue(":user", $user, PDO::PARAM_INT);
        $stm->bindValue(":discipline", $discipline, PDO::PARAM_INT);
        return $stm->execute();
    }
}
?>
