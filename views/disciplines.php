<?php require_once('../models/institutes.php'); ?>
<?php $institutes = Institutes::selectAll(); ?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php include('layouts/head.inc'); ?>
        <link rel="stylesheet" href="../vendors/owl.carousel.2.0.0-beta.2.4/assets/owl.carousel.css">
        <title>Disciplinas</title>
    </head>
    <body>
        <?php include('layouts/header.inc'); ?>
        <section>
            <div class="card left-menu">
                <div>
                    <label for="areaI" class="btn btn-area">Área I</label>
                        <input name="area" id="areaI" type="radio" class="area">
                    <ul>
                        <?php foreach($institutes as $institute): ?>
                            <?php if($institute->area == 'I'): ?>
                                <li class="btn btn-full"><?php echo $institute->name; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <label for="areaII" class="btn btn-area">Área II</label>
                    <input name="area" id="areaII" type="radio" class="area">
                    <ul>
                        <?php foreach($institutes as $institute): ?>
                            <?php if($institute->area == 'II'): ?>
                                <li class="btn btn-full"><?php echo $institute->name; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <label for="areaIII" class="btn btn-area">Área III</label>
                    <input name="area" id="areaIII" type="radio" class="area">
                    <ul>
                        <?php foreach($institutes as $institute): ?>
                            <?php if($institute->area == 'III'): ?>
                                <li class="btn btn-full"><?php echo $institute->name; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <label for="areaIV" class="btn btn-area">Área IV</label>
                    <input name="area" id="areaIV" type="radio" class="area">
                    <ul>
                        <li class="btn btn-full">Ciências da Saúde</li>
                    </ul>
                </div>
            </div>
            <div class="disciplines">
                <div class="discipline card">
                    <div class="discipline-header">
                        <img src="../assets/img/ppd.jpeg" alt="">
                        <h4>MATA01</h4>
                        <span>Geometria Analítica</span>
                        <button class="btn btn-default">Seguir</button>
                    </div>
                </div>
                <div class="discipline card">
                    <div class="discipline-header">
                        <img src="../assets/img/ppd.jpeg" alt="">
                        <h4>MATA01</h4>
                        <span>Geometria Analítica</span>
                        <button class="btn btn-default">Seguir</button>
                    </div>
                </div>
                <div class="discipline card">
                    <div class="discipline-header">
                        <img src="../assets/img/ppd.jpeg" alt="">
                        <h4>MATA01</h4>
                        <span>Geometria Analítica</span>
                        <button class="btn btn-default">Seguir</button>
                    </div>
                </div>
            </div>
        </section>
    <?php include('layouts/footer.inc'); ?>
    </body>
</html>
