<?php require_once('../models/users.php'); ?>
<?php require_once('../models/courses.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../assets/css/index.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <title>4U</title>
    </head>
    <body>
        <header>
            <div class="logo-header"><img src="../assets/img/4u-h.png"></div>
            <div class="rg">
                <button id="login" class="btn" onclick="login()"><h2>Entrar</h2></button>
                <button id="signup" class="btn" onclick="signup()"><h2>Inscrever-me</h2></button>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="logo up lf">
                    <img src="../assets/img/4u-b.png" alt="4U - Compartilhamento de Arquivos">
                </div>
                <div class="sign up rg">
                    <h3 class="top-msg">Crie o seu cadastro</h3>
                    <?php $action = 'create';
                    include('../manager/includes/user-form.inc'); ?>
                </div>
            </div>
            <div class="login-form">
                <form class="sign in">
                    <div class="logo"><img src="../assets/images/logo.png"></div>
                    <input name="email" placeholder="Insira aqui o seu e-mail" type="text">
                    <input name="password" placeholder="Insira aqui a sua senha" type="text">
                    <button class="btn sign-btn"><h2>Entrar</h2></button>
                    <a href="#"><h6>Esqueceu a senha, jovem?</h6></a>
                </form>
            </div>
        </section>
        <footer>
            <div></div>
            <div></div>
        </footer>
        <script type="text/javascript" src="../vendors/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript">
            function login(){
                $(".container").hide();
                $(".login-form").show();
                $("#login").hide();
                $("#signup").show();
            }
            function signup(){
                $(".container").show();
                $(".login-form").hide();
                $("#login").show();
                $("#signup").hide();
            }
        </script>
    </body>
</html>
