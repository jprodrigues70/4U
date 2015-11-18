<?php
    session_start();
    require_once('../models/posts.php');
    require_once('../models/disciplines.php');
    require_once('../helpers/session.php');
    require_once('../helpers/date.php');
    on();
    if(isset($_SESSION['user'])) {
        $posts = Posts::allByUserFollowing($_SESSION['user']);
        $disciplines = Disciplines::selectByUser($_SESSION['user']);
    }
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php include('layouts/head.inc'); ?>
        <link rel="stylesheet" href="../vendors/owl.carousel.2.0.0-beta.2.4/assets/owl.carousel.css">
        <title>Home</title>
    </head>
    <body>
        <?php include('layouts/header.inc'); ?>
        <section class="slides owl-carousel">
            <div class="slide">
                <img src="../assets/img/scomp.jpg" alt="">
            </div>
            <div class="slide">
                <img src="../assets/img/sufba.png" alt="">
            </div>
            <div class="slide">
                <img src="../assets/img/cmama.png" alt="">
            </div>
        </section>
        <section class="posts">
            <div id="post" class="card comments-box">
                <form id="my-post" class="do-comment post" action="../controllers/post.php" method="post" enctype="multipart/form-data">
                    <div class="select-container">
                        <select name="discipline" id="" class="btn" form="my-post" formmethod="post">
                            <?php foreach($disciplines as $discipline): ?>
                            <option value="<?php echo $discipline->id; ?>"><?php echo $discipline->code; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <img src="../<?php echo (isset($_SESSION['image'])) ? 'uploads/users/' . $_SESSION['image'] : 'assets/img/default.png'; ?>" alt="">
                    <input type="text" placeholder="Deixe um comentário" name="text">
                    <div class="post-footer">
                        <button id="upfile" class="btn" type="button"><i class="fa fa-upload"></i> Adicionar arquivo</button>
                        <button class="btn btn-default" name="action" value="create"><i class="fa fa-send"></i> Publicar</button>
                    </div>
                </form>
            </div>
            <?php $count = 0; ?>
            <?php foreach ($posts as $post): ?>
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
        </section>
        <section id="aboutus" class="about-4u">
            <div class="card">
                <h4><b>O que é o 4U?</b></h4>
                <p>O 4U é uma ferramenta que visa facilitar a vida acadêmica na UFBA. Sim!</p>
                <p>Esperamos que, de forma colaborativa, os alunos façam o nosso sistema crescer com upload de arquivos que possam contribuir com a formação de alguém, ou com o seu crescimento pessoal.</p>
                <p>É importante deixar claro que o 4U não é uma rede social tão livre quanto o facebook. Postagens que não atendem à proposta do sistema serão removidas pela moderação. O rigor maior virá do sistema de denúncias.
    </p>
                <p>Esperamos que compreendam que o 4U foi planejado para ser um ambiente agradável e direto. As pessoas devem acessar o nosso sistema e encontrar rapidamente informações relevantes.</p>
            </div>
            <div id="footer" class="about-4u-footer card">
                <p>Projeto para aprovação na disciplina de Computador, Ética e Sociedade. 2015.</p>
            </div>
            <a href="https://github.com/jprodrigues70/4U" target="_blank"><i class="fa fa-github"></i> Contribua conosco!</a>
        </section>
        <section id="modal-container" class="modal-fa">
            <div id="modal">
                <i title="Fechar" id="dismiss-modal" class="fa fa-remove"></i>
                <div class="input-group">
                    <input type="text" placeholder="Título do arquivo" name="title" form="my-post" formmethod="post">
                    <span class="addon">
                        <i class="fa fa-file"></i>
                    </span>
                </div>
                <!-- <div class="input-group">
                    <input type="text" placeholder="Descrição do arquivo" name="description" form="my-post" formmethod="post">
                    <span class="addon">
                        <i class="fa fa-align-justify"></i>
                    </span>
                </div> -->
                <div class="input-file input-group">
                    <div class="btn btn-file btn-default">
                        <i class="fa fa-upload"></i>
                        <input type="file" class="real" name="file" value="" form="my-post" formmethod="post">
                    </div>
                    <input class="false" type="text" value="" placeholder="Nenhum arquivo foi selecionado." >
                </div>
                <button id="ok" class="btn btn-default" title="É esse arquivo que quero.">PRONTO</button>
            </div>
        </section>
        <?php include('layouts/footer.inc'); ?>
        <script src="../vendors/owl.carousel.2.0.0-beta.2.4/owl.carousel.min.js"></script>
        <script>
            function comment(num){
                $.ajax({
                    type: "POST",
                    url: "../controllers/comment.php",
                    data: $("#my-post-comment"+num).serialize()
                }).done(function(data) {
                    $("#c-box"+num).children('.comment').remove();
                    $( "#c-box"+num ).prepend(data);
                });
            }
        </script>
    </body>
</html>
