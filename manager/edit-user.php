<?php require_once('../models/users.php');
require_once('../models/courses.php');
isset($_GET['id']) ? $user = Users::select($_GET['id']) : NULL; ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include('includes/head.inc'); ?>
        <title>Editar Usuário</title>
    </head>
    <body>
        <?php include('includes/header.inc'); ?>
        <section class="box last">
            <div class="top-bar">
                <h2><i class="fa fa-user"></i> Editar Usuário</h2>
            </div>
            <?php $action = 'update';
            include('includes/user-form.inc'); ?>
        </section>
		<?php include('includes/footer.inc'); ?>
        <script type="text/javascript" src="../vendors/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../vendors/GainTime/version_0-1/assets/js/inputLabels.js"></script>
    </body>
</html>
