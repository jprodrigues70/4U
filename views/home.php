<?php
    session_start();
    require_once('../models/posts.php');
    require_once('../helpers/session.php');
    on();
    if(isset($_SESSION['user'])) {
        $posts = Posts::allByUserFollowing($_SESSION['user']);
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
                <div class="do-comment post">
                    <img src="../assets/img/pp.jpeg" alt="">
                    <input type="text" placeholder="Deixe um comentário">
                    <div class="post-footer">
                        <button id="upfile" class="btn"><i class="fa fa-upload"></i> Adicionar arquivo</button>
                        <button class="btn btn-default"><i class="fa fa-send"></i> Publicar</button>
                    </div>
                </div>
            </div>
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
        </section>
        <section id="modal-container" class="modal-fa">
            <div id="modal">
                <i title="Fechar" id="dismiss-modal" class="fa fa-remove"></i>
                <form action="">
                    <div class="input-group">
                        <input type="text" placeholder="Título do arquivo" name="title" required>
                        <span class="addon">
                            <i class="fa fa-file"></i>
                        </span>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Descrição do arquivo" name="description" required>
                        <span class="addon">
                            <i class="fa fa-align-justify"></i>
                        </span>
                    </div>
                    <div class="input-file input-group">
                        <div class="btn btn-file btn-default">
                            <i class="fa fa-upload"></i>
                            <input type="file" class="real" name="file" value="">
                        </div>
                        <input class="false" type="text" value="" placeholder="Nenhum arquivo foi selecionado." >
                    </div>
                    <button class="btn btn-default" title="Assinar newsletter">PRONTO</button>
                </form>
            </div>
        </section>
    <?php include('layouts/footer.inc'); ?>
    <script src="../vendors/jquery/jquery-2.1.4.min.js"></script>
    <script src="../vendors/owl.carousel.2.0.0-beta.2.4/owl.carousel.min.js"></script>
    <script src="../assets/js/general.js"></script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:true,
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
                margin:10,
                items:1
            })
        });
        var tops = document.getElementById('footer').offsetTop;
        window.onscroll = function(){
            if($(document).scrollTop() >= tops){
                var e = document.getElementById('aboutus');
                e.style.position="fixed";
                e.style.top="0";
                e.style.right="0";
            }
            else{
                document.getElementById('aboutus').style.position="";
            }
        }

        function config(id){
            el = document.getElementById(id);
            if(el.style.maxHeight == "150px"){
                el.style.maxHeight = '0';
            }
            else{
                el.style.maxHeight = '150px';
            }
        }
        document.getElementById('upfile').onclick = function(){
            $('.modal-fa').fadeIn();
            $("html, body").animate({ scrollTop: $('.modal-fa').offset().top }, 0);
            $('body').css('overflow', 'hidden');
        }

        document.getElementById('modal-container').onclick = function(e) {
            target = e.target;
            if (target.id == 'modal'||($(target).parents().is('#modal')  && target.id != "dismiss-modal")){
                return true;
            }
            else {
                $('.modal-fa').fadeOut();
                $('body').removeAttr('style');
            }
        }

        $(document).keyup(function(e){
         if(e.which==27 && $('.modal-fa').is(':visible')){
                $('.modal-fa').fadeOut();
                $('body').removeAttr('style');
            }
        });
    </script>
    </body>
</html>
