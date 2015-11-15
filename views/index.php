<?php session_start(); ?>
<?php require_once('../models/users.php'); ?>
<?php require_once('../models/courses.php'); ?>
<?php require_once('../helpers/session.php'); ?>
<?php home(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <title>4U</title>
    </head>
    <body>
        <header>
            <div class="logo-header"><img src="../assets/img/4u-h.png"></div>
            <div class="rg">
                <button id="login" class="btn-index" onclick="login()">Entrar</button>
                <button id="signup" class="btn-index" onclick="signup()">Inscrever-me</button>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="up lf">
                   <h2>Bem-vindo,</h2>
                   <p>Você está em uma plataforma digital com objetivo de gerar conhecimento, aqui você pode compartilhar com os usuários documentos importantes como apostilas, trabalhos, projetos, entre outros. Faça seu cadastro, escolha suas matérias e fique ligado nos arquivos e comentários que seus colegas de classe estão fazendo sobre aquela disciplina.</p>
                   <p class="hashtags">#compatilheideias #adquiraconhecimento</p>
                   <img class="img-welcome" src="../assets/img/welcome.png" alt="Bem-Vindo">
                   <p>Você também pode contribuir ainda mais com o 4U, <a href="#">saiba mais.</a></p>
                </div>
                <div class="sign up rg">
                    <?php if (isset($_SESSION['msg'])) {
                        echo '<h4 class="'.$_SESSION['msg'].'<h4>'; 
                        unset($_SESSION['msg']);}
                    ?>
                    <h2 class="top-msg">Crie o seu cadastro</h2>
                    <?php $action = 'create'; ?>
                    <?php include('../manager/includes/user-form.inc'); ?>
                </div>
            </div>
            <div class="login-form">
                <form class="sign in" action="../controllers/login.php" method="POST">
                    <div class="logo"><img src="../assets/img/4u.png"></div>
                    <input name="email" placeholder="Insira aqui o seu e-mail" type="text">
                    <input name="password" placeholder="Insira aqui a sua senha" type="password">
                    <button class="btn-index sign-btn">Entrar</button>
                    <a href="#"><h6>Esqueceu a senha, jovem?</h6></a>
                </form>
            </div>
        </section>
        <?php include('layouts/footer.inc')?>
    </body>
</html>