<?php session_start(); ?>
<?php require_once('../models/disciplines.php'); ?>
<?php require_once('../models/user_has_disciplines.php'); ?>
<?php require_once('../models/posts.php'); ?>
<?php isset($_GET) ? $discipline = Disciplines::selectByCode(key($_GET)) : header("Location: disciplines.php"); ?>
<?php $posts = Posts::allByDiscipline($discipline->id);?>
<?php $myDisciplines = Disciplines::selectByUser($_SESSION['user']); ?>
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
            <div class="posts">
                <?php if($posts) : ?>
                  <?php foreach ($posts as $post): ?>
                        <div class="card">
                            <div class="post">
                                <div class="post-header">
                                    <img src="../assets/img/pp.jpeg" alt="">
                                    <h4><?php echo $post->user->name; ?></h4>
                                    <span><?php echo $post->time; ?></span><!--23 AGO 2015, 22:01-->
                                    <i onclick="config('c1')" class="config fa fa-cog"></i>
                                    <ul id="c1" class="config-menu">
                                        <li>Denunciar abuso</li>
                                        <li>Excluir publicação</li>
                                    </ul>
                                </div>
                                <div class="post-body">
                                    <div class="">
                                        <p><?php echo utf8_encode($post->text); ?></p>
                                    </div>
                                    <div class="tags">
                                        <div class="tag">Computação</div>
                                        <div class="tag" style="border-color: #ff8a84"><?php echo $post->discipline->code ?></div>
                                    </div>
                                    <div class="post-content">
                                        <div class="file-image"></div>
                                        <div class="file-description"></div>
                                    </div>
                                    <div class="post-footer">
                                        <span>256 downloads</span>
                                        <button class="btn btn-default"><i class="fa fa-download"></i> Download</button>
                                    </div>
                                </div>
                            </div>
                            <div class="comments-box">
                                <div class="comment">
                                    <img src="../assets/img/4u.png" alt="">
                                    <p><b>Rafael Coelho - </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque.</p>
                                </div>
                                <div class="comment">
                                    <img src="../assets/img/pp.jpeg" alt="">
                                    <p><b>Mateus Cordeiro - </b>Eta.</p>
                                </div>
                                <div class="do-comment">
                                    <img src="../assets/img/pp.jpeg" alt="">
                                    <input type="text" placeholder="Deixe um comentário">
                                    <button class="btn btn-default mini-send"><i class="fa fa-send"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Esta disciplina ainda não possui nenhum conteúdo enviado.</li>
                <?php endif; ?>
            </div>
            <div class="about-4u">
                <div class="about-4u-footer card">
                    <p>Minhas Disciplinas:</p>
                </div>
                <ul class="card">
                   <?php if($myDisciplines) : ?>
                       <?php foreach ($myDisciplines as $myDiscipline) : ?>
                            <li><a href="discipline?<?php echo $myDiscipline->code; ?>"><?php echo $myDiscipline->name; ?></a></li>
                        <?php endforeach;?>
                    <?php else: ?>
                        <h3>Você não segue nenhuma disciplina!</h3>
                    <?php endif; ?>
                </ul> 
            </div>   
        </section>
        <?php include('layouts/footer.inc'); ?>
    </body>
</html>