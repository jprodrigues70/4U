<?php
    session_start();
    require_once('../models/disciplines.php');
    require_once('../models/user_has_disciplines.php');
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
            return header('Location:../manager/disciplines');
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
            return header('Location:../manager/disciplines');
        }
        
        public static function selectByInstitute() {
            $disciplines = Disciplines::selectByInstitute($_POST['institute']);
            if($disciplines) {
                foreach ($disciplines as $discipline) {
                    $myDiscipline = UserHasDisciplines::exists($_SESSION['user'],$discipline->id);
                    if($myDiscipline) {
                        $button = "<button class='btn btn-default' onclick='unfollowDiscipline(".$discipline->id.", this)'>Deixar de Seguir</button>";
                    }else{
                        $button = "<button class='btn btn-default' onclick='followDiscipline(".$discipline->id.", this)'>Seguir</button>";
                    }
                    echo '
                    <div class="discipline card">
                        <div class="discipline-header">
                            <img src="../assets/img/ppd.jpeg" alt="">
                            <a href="discipline?'.strtolower($discipline->code).'"><h4>'.$discipline->code.'</h4>
                            <span>'.$discipline->name.'</span></a>
                            '.$button.'
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
        
        public static function find() {
            $disciplines = Disciplines::find($_POST['term']);
            if($disciplines){
                foreach ($disciplines as $discipline) {
                    echo '
                    <div class="discipline card">
                        <div class="discipline-header">
                            <img src="../assets/img/ppd.jpeg" alt="">
                            <h4>'.$discipline->code.'</h4>
                            <span>'.$discipline->name.'</span>
                            <button class="btn btn-default" onclick="followDiscipline('.$discipline->id.', this)">Seguir</button>
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
