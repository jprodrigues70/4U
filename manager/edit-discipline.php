<?php require_once('../models/disciplines.php'); ?>
<?php isset($_GET['id']) ? $discipline = Disciplines::select($_GET['id']) : NULL; ?>
<?php require_once('../models/institutes.php'); ?>
<?php $institutes = Institutes::selectAll(); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include('includes/head.inc'); ?>
        <title>Edição de Disciplinas</title>
    </head>
    <body>
        <?php include('includes/header.inc'); ?>
        <section class="box last">
            <div class="top-bar">
                <h2><i class="fa fa-book"></i> Editar Disciplina</h2>
            </div>
            <?php $action = 'update'; ?>
            <?php include('includes/discipline-form.inc'); ?>
        </section>
		<?php include('includes/footer.inc'); ?>
        <script type="text/javascript" src="../vendors/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../vendors/GainTime/version_0-1/assets/js/inputLabels.js"></script>
    </body>
</html>
