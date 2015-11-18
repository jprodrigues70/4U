    <?php
        session_start();
        require_once('../helpers/session.php');
        if (level() != true) header('Location: ../views/home');
    ?>
    <header>
        <a href="../views/index.php"><img src="../assets/img/4u.png" alt="4U"></a>
        <input type="checkbox" id="menu" class="toggle">
        <label id="menu-toggle" for="menu" onclick><i class="fa fa-bars"></i></label>
        <nav class="menu">
            <ul>
                <a href="disciplines.php"><li><i class="fa fa-book"></i> Disciplinas</li></a>
                <a href="institutes.php"><li><i class="fa fa-file-pdf-o"></i> Institutos</li></a>
                <a href="courses.php"><li><i class="fa fa-user"></i> Cursos</li></a>
                <a href="users.php"><li><i class="fa fa-user"></i> Usuários</li></a>
                <a href="#"><li><i class="fa fa-picture-o"></i> Posts</li></a>
                <a href="#"><li><i class="fa fa-picture-o"></i> Slides</li></a>
                <a href="#"><li><i class="fa fa-sign-out"></i> Sair</li></a>
            </ul>
        </nav>
    </header>
