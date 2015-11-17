<?php session_start(); ?>
<?php require_once('../models/disciplines.php'); ?>
<?php require_once('../models/user_has_disciplines.php'); ?>
<?php isset($_GET) ? $discipline = Disciplines::selectByCode(key($_GET)) : header("Location: disciplines.php"); ?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php include('layouts/head.inc'); ?>
        <link rel="stylesheet" href="../vendors/owl.carousel.2.0.0-beta.2.4/assets/owl.carousel.css">
        <title>Disciplinas</title>
    </head>
    <body>
        <?php include('layouts/header.inc'); ?>
        <section class="first">
            <?php $myDiscipline = UserHasDisciplines::exists($_SESSION['user'],$discipline->id); ?>
            <div class="discipline card">
                <div class="discipline-header">
                    <img src="../assets/img/ppd.jpeg" alt="">
                    <h4><?php echo $discipline->code ?></h4>
                    <span><?php echo $discipline->name ?></span>
                    <?php if($myDiscipline) : ?>
                        <button class='btn btn-default' disabled='true'>Seguindo...</button>
                    <? else : ?>
                        <button class='btn btn-default' onclick='followDiscipline(<?php echo $discipline->id ?>, this)'>Seguir</button>
                    <?php endif ?>
                </div>
            </div>
        </section>
        <section>
            <div class="up lf">
            </div>
            <div class="up rg">
               <p>Minhas Disciplinas:</p>
               <ul>
                    <?php $myDisciplines = Disciplines::selectByUser($_SESSION['user']); ?>
                    <?php if($myDisciplines) : ?>
                        <?php foreach ($myDisciplines as $myDiscipline) : ?>
                            <li><?php echo $myDiscipline->name; ?></li>
                        <?php endforeach;?>
                    <?php else: ?>
                        <li>Você não segue nenhuma disciplina!</li>
                    <?php endif; ?>
               </ul> 
            </div>   
        </section>
        <?php include('layouts/footer.inc'); ?>
    </body>
</html>