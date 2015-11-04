<?php
    session_start();
    require('../models/users.php');
    class User {
    
        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['name']!="" && $_POST['email']!="" && $_POST['password']!="" && $_POST['course']!="") {
                if($_POST['level'] == "") $_POST['level'] = "0";
                $user = new Users($_POST);
                try {
                    $user->insert();
                    $_SESSION['msg'] = 'success">Usuário criado com sucesso.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro na criação do usuário.';
                }
            }
            if ($_SESSION["URL"] == 1){
                unset($_SESSION["URL"]);
                return header('Location:../manager/users.php');
            }
            return header('Location:../views');
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
            $_SESSION['msg'] = 'fail">Não é possível deletar este usuário.';
            if ($_GET['id']!="") {
                try {
                    Users::delete($_GET['id']);
                    $_SESSION['msg'] = 'success">Usuário deletado com sucesso.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro.';
                }
            }
            header('Location:../manager/users.php');
        }
    }
    $postActions = array('create', 'update');
    $getActions = array('delete');
    if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
        User::$_POST['action']();
    }
    elseif(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
        User::$_GET['action']();
    }
?>