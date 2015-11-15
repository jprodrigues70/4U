<?php require_once('../models/disciplines.php'); ?>
<?php isset($_GET) ? $discipline = Disciplines::selectByCode(key($_GET)) : header("Location: disciplines.php"); ?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php include('layouts/head.inc'); ?>
        <link rel="stylesheet" href="../vendors/owl.carousel.2.0.0-beta.2.4/assets/owl.carousel.css">
        <title>Disciplinas</title>
    </head>
    <body>
        <?php include('layouts/header.inc'); ?>
        <section class="first">
            <div class="discipline card">
                <div class="">
                    <div class="discipline-header">
                        <img src="../assets/img/ppd.jpeg" alt="">
                        <h3><?php echo $discipline->name; ?></h3>
                        <span><?php echo $discipline->code; ?></span>
                        <button class="btn btn-default">Seguir</button>
                    </div>
                </div>
            </div>
        </section>
    <?php include('layouts/footer.inc'); ?>
    </body>
</html>
