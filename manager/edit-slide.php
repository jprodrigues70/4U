<?php require_once('../models/slides.php');
require_once('../models/courses.php');
isset($_GET['id']) ? $slide = Slides::select($_GET['id']) : NULL; ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include('includes/head.inc'); ?>
        <title>Edição de Slides</title>
    </head>
    <body>
        <?php include('includes/header.inc'); ?>
        <section class="box last">
            <div class="top-bar">
                <h2><i class="fa fa-file-pdf-o"></i> Editar Slide</h2>
            </div>
            <?php $action = "update"; ?>
            <?php include('includes/slide-form.inc'); ?>
        </section>
		<?php include('includes/footer.inc'); ?>
        <script type="text/javascript" src="../vendors/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../assets/js/inputLabels.js"></script>
    </body>
</html>
