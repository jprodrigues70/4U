<?php
    session_start();
    require_once('../models/users.php');
    require_once('../helpers/session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("../views/layouts/head.inc"); ?>
    </head>
    <body>
        <?php include('../views/layouts/header.inc'); ?>
        <section>
            <a href="../index.php"><img src="../assets/img/4u.png"></a>
            <h1>Desculpe, mas a página que você solicitou não está disponível.</h1>
            <h3>O link que você inseriu está quebrado ou não existe.</h3>
        </section>
        <?php include("../views/layouts/footer.inc"); ?>
    </body>
</html>
