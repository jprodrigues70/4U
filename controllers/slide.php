<?php
    session_start();
    require_once('../models/slides.php');
    require_once('../helpers/image.php');
    class Slide {
        public static function create() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if ($_POST['title']!="") {
                $image = is_uploaded_file($_FILES['image']['tmp_name']);
                if ($image) {
                    $image = new Image($_FILES['image']);
                    $image->resize(950);
                    $image->save('../uploads/slides/');
                    $_POST['image'] = $image->name.'.'.$image->type;
                }
                $slide = new Slides($_POST);
                try {
                    $slide -> insert();
                    $_SESSION['msg'] = 'success">O curso foi adicionado.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/slides.php');
        }
        
        public static function update() {
            $_SESSION['msg'] = 'fail">Você não forneceu as informações obrigatórias.';
            if($_POST['id']!="" && $_POST['title']!="") {
                $slide = new slides($_POST);
                try {
                    $slide -> update ($_POST['id']);
                    $_SESSION['msg'] = 'success">O slide foi atualizado.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro. Lamento';
                }
            }
            return header('Location:../manager/slides.php');
        }

        public static function delete() {
            $_SESSION['msg'] = 'fail">Não é possível deletar este slide.';
            if ($_GET['id']!="") {
                try {
                    Slides::delete($_GET['id']);
                    $_SESSION['msg'] = 'success">Slide deletado com sucesso.';
                }
                catch(PDOException $e) {
                    $_SESSION['msg'] = 'fail">Ocorreu um erro.';
                }
            }
            header('Location:../manager/slides.php');
        }
    }
    $postActions = array('create', 'update');
    $getActions = array('delete');
    if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
        Slide::$_POST['action']();
    }
    elseif(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
        Slide::$_GET['action']();
    }
?>