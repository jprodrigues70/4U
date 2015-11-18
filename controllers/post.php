<?php
    session_start();
    require_once('../models/posts.php');
    require_once('../models/files.php');
    class Post {

        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['text'] != "" && $_SESSION['user'] != "") {
                $_POST['user'] = $_SESSION['user'];
                $_POST['time'] = date('Y-m-d H:i:s', strtotime('now'));
                
                if(is_uploaded_file($_FILES['file']['tmp_name']) && $_POST['title'] != "") {
                    $finalname = time().'_'.$_FILES['file']['name'];
                    if(move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/files/' . $finalname)) {
                        $_POST['file'] = $finalname;
                        $file = new Files($_POST);
                        $thisFile = $file->insert();
                        $_POST['file'] = NULL;
                        $_POST['file'] = $thisFile;
                    }
                }
                
                $post = new Posts($_POST);
                try {
                    $post->insert();
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            header('Location:../views/home');
        }

        public static function delete() {
            
        }
    }
    Post::$_POST['action']();
?>
