<?php
    session_start();
    require_once('../models/comments.php');
    class Post {

        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['text'] != "" && $_SESSION['user'] != "") {
                $_POST['user'] = $_SESSION['user'];
                $_POST['time'] = date('Y-m-d H:i:s', strtotime('now'));
                
                $comment = new Comments($_POST);
                try {
                    $comment->insert();
                    $cs = Comments::allByPost($_POST['post']);
                    foreach($cs as $c){
                        echo
                        '<div class="comment">
                            <img src="../assets/img/4u.png" alt="">
                            <p><b>'.$c->user->name.' - </b>'.$c->text.'</p>
                        </div>';
                    }
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
        }

        public static function delete() {
            
        }
    }
    Post::$_POST['action']();
?>
