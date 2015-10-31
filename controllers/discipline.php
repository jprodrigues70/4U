<?php
    session_start();
    require_once('../models/disciplines.php');
    class Discipline {

        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['code']!="" && $_POST['name']!="") {
                $discipline = new Disciplines($_POST);
                try {
                    $discipline -> insert();
                    $_SESSION['msg'] = 'success">A disciplina foi adicionada.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/disciplines.php');
        }

        public static function update() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if($_POST['id']!="" && $_POST['code']!="" && $_POST['name']!="") {
                $discipline = new Disciplines($_POST);
                try {
                    $discipline -> update ($_POST['id']);
                    $_SESSION['msg'] = 'success">A disciplina foi atualizada.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/disciplines.php');
        }

        public static function selectByInstitute() {
            $disciplines = Disciplines::selectByInstitute($_POST['institute']);
            if($disciplines){
                foreach ($disciplines as $discipline) {
                    echo '
                    <div class="discipline card">
                        <div class="discipline-header">
                            <img src="../assets/img/ppd.jpeg" alt="">
                            <h4>'.$discipline->code.'</h4>
                            <span>'.$discipline->name.'</span>
                            <a class="btn btn-default" onclick="followDiscipline('.$discipline->id.')">Seguir</a>
                        </div>
                    </div>';
                }
            }
            else {
                echo '
                    <div class="discipline card">
                        <div class="discipline-header">
                            <h4 style="text-align:center">Nenhuma disciplina cadastrada.</h4>
                        </div>
                    </div>';
            }
        }
    }
    Discipline::$_POST['action']();
?>
