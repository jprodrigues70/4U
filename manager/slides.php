<?php session_start();
require_once('../models/slides.php');
require_once('../helpers/session.php');
$slides = Slides::selectAll(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>
		<title>Usuários</title>
	</head>
	<body>
        <?php include('includes/header.inc');	 ?>
		<section class="box last">
            <?php echo msg(); ?>
            <div class="top-bar">
                <h1><i class="fa fa-file-image-o"></i> Slides</h1>
                <a href="add-slide.php" class="btn btn-add"><i class="fa fa-plus"></i>Adicionar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th class="hxs">expire</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td><?php echo $slide->title; ?></td>
                        <td class="hxs"><?php echo $slide->expire; ?></td>
                        <td>
                            <a href="edit-slide.php?id=<?php echo $slide->id; ?>" class="btn-action edit" title="Editar Usuário"><i class="fa fa-edit fa-lg"></i></a>
                            <a href="../controllers/slide.php?action=delete&id=<?php echo $slide->id; ?>" class="btn-action del" title="Excluir Usuário"><i class="fa fa-trash-o fa-lg"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
		</section>
		<?php include('includes/footer.inc'); ?>
	</body>
</html>
