<?php
    session_start();
    require('../models/courses.php');
    class Course {
    
        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['code']!="" && $_POST['name']!="" && $_POST['institute']!="") {
                $course = new Courses($_POST);
                try {
                    $course -> insert();
                    $_SESSION['msg'] = 'success">O curso foi adicionado.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/courses.php');
        }
        
        public static function update() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if($_POST['id']!="" && $_POST['code']!="" && $_POST['name']!="" && $_POST['institute']!="") {
                $course = new courses($_POST);
                try {
                    $course -> update ($_POST['id']);
                    $_SESSION['msg'] = 'success">O curso foi atualizado.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/courses.php');
        }
    }
    course::$_POST['action']();
?>