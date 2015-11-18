<?php session_start(); ?>
<?php require_once('../models/disciplines.php'); ?>
<?php require_once('../models/user_has_disciplines.php'); ?>
<?php require_once('../models/posts.php'); ?>
<?php require_once('../helpers/date.php'); ?>
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
                        <button class='btn btn-danger' onclick='unfollowDiscipline(<?php echo $discipline->id ?>, this)'>Deixar de Seguir</button>
                    <?php else : ?>
                        <button class='btn btn-default' onclick='followDiscipline(<?php echo $discipline->id ?>, this)'>Seguir</button>
                    <?php endif ?>
                </div>
            </div>
        </section>
        <section>
            <div class="posts">
                <?php if($posts) : ?>
                  <?php $count = 0; foreach ($posts as $post): ?>
                    <div class="card">
                        <div class="post">
                            <div class="post-header">
                                <img src="../assets/img/pp.jpeg" alt="">
                                <h4><?php echo $post->user->name; ?></h4>
                                <?php $date =  parseDate($post->time); ?>
                                <span><?php echo $date->short.', '.$date->hour ; ?></span><!--23 AGO 2015, 22:01-->
                                <i onclick="config('c<?php echo $count; ?>')" class="config fa fa-cog"></i>
                                <ul id="c<?php echo $count; ?>" class="config-menu">
                                    <li>Denunciar abuso</li>
                                    <?php if($post->user->id == $_SESSION['user']): ?>
                                    <a href=""><li>Excluir publicação</li></a>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="post-body">
                                <div class="">
                                    <p><?php echo $post->text; ?></p>
                                </div>
                                <div class="tags">
                                    <div class="tag"><?php echo $post->discipline->institute->name ?></div>
                                    <a href="discipline?<?php echo strtolower($post->discipline->code) ?>"><div class="tag tag-discipline"><?php echo $post->discipline->code ?></div></a>
                                </div>
                                <?php if($post->file): ?>
                                <div class="post-content">
                                    <div class="file-image">
                                        <i class="fa fa-file"></i>
                                    </div>
                                    <div class="file-description">
                                        <h4><?php echo $post->file->title; ?></h4>
                                    </div>
                                </div>
                                <form class="post-footer" action="../controllers/file.php" method="post">
                                    <span><?php echo $post->file->downloads; ?> download<?php echo ($post->file->downloads > 1) ? 's' : null;?> </span>
                                    <input type="hidden" name="file" value="<?php echo $post->file->id; ?>">
                                    <button class="btn btn-default" name="action" value="download"><i class="fa fa-download"></i> Download</button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="c-box<?php echo $count; ?>" class="comments-box">
                            <?php foreach($post->comments as $comment): ?>
                            <div class="comment">
                                <?php if($comment->user->id == $_SESSION['user']): ?>
                                <i class="c-action fa fa-remove"></i>
                                <?php else: ?>
                                <i class="c-action fa fa-sort-down"></i>
                                <ul id="c<?php echo $count; ?>" class="config-menu">
                                    <li>Denunciar abuso</li>
                                </ul>
                                <?php endif; ?>
                                <img src="../assets/img/4u.png" alt="">
                                <p><b><?php echo $comment->user->name; ?> - </b><?php echo $comment->text; ?></p>
                                <?php $date = NULL;$date =  parseDate($post->time); ?>
                                <span class="time"><?php echo $date->short.', '.$date->hour ; ?></span>
                            </div>
                            <?php endforeach; ?>
                            <div class="do-comment">
                                <img src="../<?php echo (isset($_SESSION['image'])) ? 'uploads/users/' . $_SESSION['image'] : 'assets/img/default.png'; ?>" alt="">
                                <form id="my-post-comment<?php echo $count; ?>">
                                    <input type="hidden" name="post" value="<?php echo $post->id; ?>">
                                    <input type="hidden" name="action" value="create">
                                    <input type="text" name="text" placeholder="Deixe um comentário">
                                </form>
                                <button class="btn btn-default mini-send" type="button" onclick="comment('<?php echo $count; ?>')"><i class="fa fa-send"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php $count++; ?>
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