<header>
    <a href=""><img src="../assets/img/4u-ico-b.png" class="menu-logo"></a>
    <nav class="menu" role="full-horizontal">
        <input type="checkbox" id="button">
        <label for="button" onclick><i class="fa fa-bars"></i></label>
        <ul class="options">
            <li><a href="home.php">Início</a></li>
            <li><a href="disciplines.php">Disciplinas</a></li>
        </ul>
        <ul class="me" id="me-menu-bt">
            <li><?php echo $_SESSION['name']; ?> <img src="" alt=""></li>
            <ul id="me-menu">
                <a href=""><li>Perfil</li></a>
                <a href="../controllers/logout.php"><li>Sair</li></a>
            </ul>
        </ul>
    </nav>
</header>
