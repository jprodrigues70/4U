<?php
session_start();
require_once('../models/login.php');

if (isset($_POST['email'])) {
    $login = new Login($_POST);
    $got = $login->login();
    if ($got) {
        $_SESSION = $got;
        $_SESSION['on'] = true;
        $_SESSION['user'] = $got['id'];
        $_SESSION['id'] = NULL;
        header('Location: ../views/home');
    } else {
        $_SESSION['msg'] = "<div class='msg fail'>Opa! Parece que você digitou algo errado.</div>";
        header('Location: ../views/index?login');
    }
}
?>
