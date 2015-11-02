<?php
    session_start();
    require_once('../models/disciplines.php');
    require_once('../models/user_has_disciplines.php');
    class UserHasDiscipline {

        public static function followDiscipline() {
            //TODO: Retirar quando sessão de usuário estiver implementada
            $_SESSION['user'] = 4;

            if (isset($_SESSION['user']) && isset($_POST['discipline'])) {
                $userHasDiscipline = new UserHasDisciplines(array("user" => $_SESSION['user'], "discipline" => $_POST['discipline']));
                if(!$userHasDiscipline->exists() && $userHasDiscipline->insert()) {
                    $_SESSION['msg'] = 'success">A disciplina foi adicionada.';
                    var_dump("A disciplina foi adicionada.");
                } else {
                    $_SESSION['msg'] = 'fail">Não foi possivel seguir essa disciplina.';
                    var_dump("Não foi possivel seguir essa disciplina.");
                }
            } else {
                $_SESSION['msg'] = 'fail">Informações obrigatórias não informadas.';
                var_dump("Informações obrigatórias não informadas.");
            }
        }
    }
    UserHasDiscipline::$_POST['action']();
?>
