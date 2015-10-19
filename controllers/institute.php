<?php
    session_start();
    require('../models/institutes.php');
    class Institute {
    
        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['name']!="") {
                $institute = new Institutes($_POST);
                try {
                    $institute -> insert();
                    $_SESSION['msg'] = 'success">O instituto foi adicionado.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/institutes.php');
        }
        
        public static function update() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if($_POST['id']!="" && $_POST['name']!="") {
                $institute = new Institutes($_POST);
                try {
                    $institute -> update ($_POST['id']);
                    $_SESSION['msg'] = 'success">O instituto foi atualizado.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/institutes.php');
        }
    }
    institute::$_POST['action']();
?>