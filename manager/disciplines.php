<?php session_start(); ?>
<?php require_once('../models/disciplines.php'); ?>
<?php require_once('../helpers/session.php'); ?>
<?php isset($_GET['institute']) ? $disciplines = Disciplines::selectByInstitute($_GET['institute']) : $disciplines = Disciplines::selectAll(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>
		<title>Disciplinas</title>
	</head>
	<body>
        <?php include('includes/header.inc');	 ?>
		<section class="box last">
            <?php echo msg(); ?>
            <div class="top-bar">
                <h1><i class="fa fa-book"></i> Disciplinas</h1>
                <a href="add-discipline.php" class="btn btn-add"><i class="fa fa-plus"></i>Adicionar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Disciplinas</th>
                        <th>Nome</th>
                        <th>Instituto</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($disciplines as $discipline): ?>
                <tr>
                    <td><?php echo $discipline->code; ?></td>
                    <td><?php echo $discipline->name; ?></td>
                    <td><?php echo Disciplines::getInstitute($discipline->institute); ?></td>
                    <td>
                        <a href="edit-discipline.php?id=<?php echo $discipline->id; ?>" class="btn-action edit" title="Editar Disciplina"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="" class="btn-action del" title="Excluir Disciplina"><i class="fa fa-trash-o fa-lg"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
		</section>
		<?php include('includes/footer.inc'); ?>
	</body>
</html>
