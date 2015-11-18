<?php
    session_start();
    require_once('../models/disciplines.php');
    require_once('../models/user_has_disciplines.php');
    class UserHasDiscipline {

        public static function followDiscipline() {
            if (isset($_SESSION['user']) && isset($_POST['discipline'])) {
                $userHasDiscipline = new UserHasDisciplines(array("user" => $_SESSION['user'], "discipline" => $_POST['discipline']));
                if (!$userHasDiscipline->exists()) $userHasDiscipline->insert();
            }
        }

        public static function unfollowDiscipline() {
            if (isset($_SESSION['user']) && isset($_POST['discipline'])) {
                UserHasDisciplines::delete($_SESSION['user'], $_POST['discipline']);
            }
        }
    }
    UserHasDiscipline::$_POST['action']();
?>
