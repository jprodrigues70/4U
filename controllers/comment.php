<?php
    session_start();
    require_once('../models/comments.php');
    class Comment {

        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['post'] != "" && $_POST['text'] != "" && $_SESSION['user'] != "") {
                $_POST['user'] = $_SESSION['user'];
                date_default_timezone_set('America/Recife');
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
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            
            if (isset($_GET['comment'])) {
                $comment = Comments::find($_GET['comment']);
                if(!empty($comment) && $comment->user->id == $_SESSION['user']) {
                    try {
                        if($comment->delete()) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                    catch(PDOException $e) {
                        $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                        return false;
                    }
                }
            }
        }
    }
    $postActions = array('create');
    $getActions = array('delete');
    if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
        Comment::$_POST['action']();
    }
    elseif(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
        Comment::$_GET['action']();
    }
?>
