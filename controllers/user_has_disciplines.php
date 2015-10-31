<?php
    session_start();
    require_once('../models/disciplines.php');
    require_once('../models/user_has_disciplines.php');
    class UserHasDiscipline {

        public static function followDiscipline() {
            //TODO: Retirar quando sessão de usuário estiver implementado
            $_SESSION['user'] = 1;

            if (isset($_SESSION['user']) && isset($_POST['discipline'])) {
                $userHasDiscipline = new UserHasDisciplines(array("user" => $_SESSION['user'], "discipline" => $_POST['discipline']));
                var_dump($userHasDiscipline);
                if($userHasDiscipline->insert()) {
                    $_SESSION['msg'] = 'success">A disciplina foi adicionada.';
                    var_dump("funfou");
                } else {
                    $_SESSION['msg'] = 'fail">Não foi possivel seguir essa disciplina.';
                    var_dump("deu ruim");
                }
            } else {
                $_SESSION['msg'] = 'fail">Informações obrigatórias não informadas.';
                var_dump("void");
            }
        }
    }
    UserHasDiscipline::$_POST['action']();
?>
