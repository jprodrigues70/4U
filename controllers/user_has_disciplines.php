<?php
    session_start();
    require_once('../models/user_has_disciplines.php');
    class UserHasDiscipline {

        public static function followDiscipline() {
            if (isset($_SESSION['user'])) {
                $disciplines = UserHasDisciplines::selectByInstitute($_POST['discipline']);
                if($disciplines){
                    foreach ($disciplines as $discipline) {
                        echo '
                        <div class="discipline card">
                            <div class="discipline-header">
                                <img src="../assets/img/ppd.jpeg" alt="">
                                <h4>'.$discipline->code.'</h4>
                                <span>'.$discipline->name.'</span>
                                <a class="btn btn-default">Seguir</a>
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
    }
    Discipline::$_POST['action']();
?>
