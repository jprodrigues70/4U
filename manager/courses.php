<?php session_start(); ?>
<?php require_once('../models/courses.php'); ?>
<?php require_once('../helpers/session.php'); ?>
<?php isset($_GET['institute']) ? $courses = Courses::selectByInstitute($_GET['institute']) : $courses = Courses::selectAll(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>
		<title>Cursos</title>
	</head>
	<body>
        <?php include('includes/header.inc');	 ?>
		<section class="box last">
            <?php echo msg(); ?>
            <div class="top-bar">
                <h1><i class="fa fa-book"></i> Cursos</h1>
                <a href="add-course.php" class="btn btn-add"><i class="fa fa-plus"></i>Adicionar</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Cursos</th>
                        <th>Nome</th>
                        <th>Instituto</th>
                        <th>Area</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($courses as $course): ?>
                <tr>
                    <td><?php echo $course->code; ?></td>
                    <td><?php echo $course->name; ?></td>
                    <td><?php echo Courses::getInstitute($course->institute); ?></td>
                    <td><?php echo $course->area; ?></td>
                    <td>
                        <a href="edit-course.php?id=<?php echo $course->id; ?>" class="btn-action edit" title="Editar Curso"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="" class="btn-action del" title="Excluir Curso"><i class="fa fa-trash-o fa-lg"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
		</section>
		<?php include('includes/footer.inc'); ?>
	</body>
</html>
