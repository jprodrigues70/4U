<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>
		<title>Disciplinas</title>
	</head>
	<body>
        <?php include('includes/header.inc');	 ?>
		<section class="box last">
            <div class="top-bar">
                <h1><i class="fa fa-book"></i> Disciplinas</h1>
                <a href="#" class="btn btn-add"><i class="fa fa-plus"></i>Adicionar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Disciplinas</th>
                        <th class="hxs">Área</th>
                        <th class="hxs">Apelido</th>
                        <th>Instituto</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>MATA68</td>
                    <td class="hxs">I</td>
                    <td class="hxs">Computador, Ética e Sociedade</td>
                    <td class="hxs">Matemática</td>
                    <td>
                        <a href="" class="btn-action edit" title="Editar Disciplina"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="" class="btn-action del" title="Excluir Disciplina"><i class="fa fa-trash-o fa-lg"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
		</section>
		<?php include('includes/footer.inc'); ?>
	</body>
</html>
