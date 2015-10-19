<?php require_once('../models/institutes.php'); ?>
<?php $institutes = Institutes::selectAll(); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include('includes/head.inc'); ?>
        <title>Adição de Disciplinas</title>
    </head>
    <body>
        <?php include('includes/header.inc'); ?>
        <section class="box last">
            <div class="top-bar">
                <h2><i class="fa fa-book"></i> Adicionar Disciplina</h2>
            </div>
            <?php $action = 'create'; ?>
            <?php include('includes/discipline-form.inc'); ?>
        </section>
		<?php include('includes/footer.inc'); ?>
        <script type="text/javascript" src="../vendors/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../vendors/GainTime/version_0-1/assets/js/inputLabels.js"></script>
    </body>
</html>
