<?php
    session_start();
    require('../models/users.php');
    class User {
    
        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['name']!="" && $_POST['email']!="" && $_POST['password']!="" && $_POST['level']!="" && $_POST['course']!="") {
                $user = new Users($_POST);
                try {
                    $user->insert();
                    $_SESSION['msg'] = 'success">Usuário criado com sucesso.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro na criação do usuário.';
                }
            }
            return header('Location:../manager/users.php');
        }
        
        public static function update() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if($_POST['id']!="" && $_POST['name']!="" && $_POST['email']!="" && $_POST['password']!="" && $_POST['level']!="" && $_POST['course']!="") {
                $user = new Users($_POST);
                try {
                    $user->update($_POST['id']);
                    $_SESSION['msg'] = 'success">Usuário atualizado com sucesso.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro na atualização do usuário.';
                }
            }
            return header('Location:../manager/users.php');
        }

        public static function delete() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_GET['id']!="") Users::delete($_GET['id']);
            header('Location:../manager/users.php');
        }
    }
    if (isset($_POST['action']))
        User::$_POST['action']();
    else
        User::$_GET['action']();
?>