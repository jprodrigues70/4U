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
    }
    Discipline::$_POST['action']();
?>