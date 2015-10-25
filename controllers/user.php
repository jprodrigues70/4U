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
            if($_POST['id']!="" && $_POST['name']!="" && $_POST['email']!=""&& $_POST['level']!="" && $_POST['course']!="") {
            	$user = new Users($_POST);
                try {
                	$hash = md5($_POST['password']);
	            	if ($hash != 'd41d8cd98f00b204e9800998ecf8427e') {
	            		Users::changePassword($_POST['id'], $hash);
	            	}
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
    $_POST ? User::$_POST['action']() : User::$_GET['action']();
?>