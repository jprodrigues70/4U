<?php session_start();
require_once('../models/users.php');
require_once('../helpers/session.php');
$users = Users::selectAll(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>
		<title>Usuários</title>
	</head>
	<body>
        <?php include('includes/header.inc');	 ?>
		<section class="box last">
            <div class="top-bar">
                <h1><i class="fa fa-user"></i> Usuários</h1>
                <a href="add-user.php" class="btn btn-add"><i class="fa fa-plus"></i>Adicionar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hxs">Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user->name; ?></td>
                        <td class="hxs"><?= $user->email; ?></td>
                        <td>
                            <a href="edit-user.php?id=<?= $user->id; ?>" class="btn-action edit" title="Editar Usuário"><i class="fa fa-edit fa-lg"></i></a>
                            <a href="../controllers/user.php?action=delete&id=<?= $user->id; ?>" class="btn-action del" title="Excluir Usuário"><i class="fa fa-trash-o fa-lg"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
		</section>
		<?php include('includes/footer.inc'); ?>
	</body>
</html>
