<?php require_once('../models/users.php'); ?>
<?php require_once('../models/courses.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include('includes/head.inc'); ?>
        <title>Adicionar Slide</title>
    </head>
    <body>
        <?php include('includes/header.inc'); ?>
        <section class="box last">
            <div class="top-bar">
                <h2><i class="fa user"></i> Adicionar Slide</h2>
            </div>
            <?php $action = 'create';
            include('includes/slide-form.inc'); ?>
        </section>
		<?php include('includes/footer.inc'); ?>
        <script type="text/javascript" src="../vendors/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../vendors/GainTime/version_0-1/assets/js/inputLabels.js"></script>
    </body>
</html>
