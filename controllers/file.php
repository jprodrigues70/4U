<?php
session_start();
require_once('../models/posts.php');
require_once('../models/files.php');
    class File {
        public static function download(){
            $file = Files::select($_POST['file']);
            if(file_exists('../uploads/files/'.$file->file)) {
                $path = pathinfo($file->file);
                header('Content-Type: application/'.$path['extension']);
                header('Content-Disposition: attachment; filename="'.$file->title.'.'.$path['extension'].'"');
                readfile('../uploads/files/'.$file->file);
            }
            else {
                $_SESSION['msg'] = 'info"> Erro ao realizar download.';
                header('Location:../views/activities');
            }
        }
    }
    $postActions = array('download');
    $getActions = array('delete');
    if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
        File::$_POST['action']();
    }
    elseif(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
        File::$_GET['action']();
    }
?>