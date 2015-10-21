<?php session_start(); ?>
<?php require_once('../models/institutes.php'); ?>
<?php require_once('../helpers/session.php'); ?>
<?php $institutes = Institutes::selectAll(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>
		<title>Institutos</title>
	</head>
	<body>
        <?php include('includes/header.inc');	 ?>
		<section class="box last">
            <?php echo msg(); ?>
            <div class="top-bar">
                <h1><i class="fa fa-bank"></i> Institutos</h1>
                <a href="add-institute.php" class="btn btn-add"><i class="fa fa-plus"></i>Adicionar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Área</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($institutes as $institute): ?>
                <tr>
                    <td><a href="disciplines.php?institute=<?php echo $institute->id ; ?>"><?php echo $institute->name; ?></a></td>
                    <td><?php echo $institute->area; ?></td>
                    <td>
                        <a href="edit-institute.php?id=<?php echo $institute->id; ?>" class="btn-action edit" title="Editar Instituto"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="" class="btn-action del" title="Excluir Instituto"><i class="fa fa-trash-o fa-lg"></i></a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
		</section>
		<?php include('includes/footer.inc'); ?>
	</body>
</html>
