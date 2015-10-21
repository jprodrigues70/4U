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
        <section class="first">
            <div class="left-menu">
                <div class="input-group">
                    <div class="btn btn-default"><i class="fa fa-search"></i></div>
                    <input type="search" value="" placeholder="Procurar Disciplina">
                </div>
                <div>
                    <label for="areaI" class="btn btn-area">Área I</label>
                        <input name="area" id="areaI" type="radio" class="area">
                    <ul>
                        <?php foreach($institutes as $institute): ?>
                            <?php if($institute->area == 'I'): ?>
                                <li class="btn btn-full" onclick="pullDiscipline(<?php echo $institute->id; ?>)"><?php echo $institute->name; ?></li>
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
                                <li class="btn btn-full" onclick="pullDiscipline(<?php echo $institute->id; ?>)"><?php echo $institute->name; ?></li>
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
                                <li class="btn btn-full" onclick="pullDiscipline(<?php echo $institute->id; ?>)"><?php echo $institute->name; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <label for="areaIV" class="btn btn-area">Área IV</label>
                    <input name="area" id="areaIV" type="radio" class="area">
                    <ul>
                        <?php foreach($institutes as $institute): ?>
                            <?php if($institute->area == 'IV'): ?>
                                <li class="btn btn-full" onclick="pullDiscipline(<?php echo $institute->id; ?>)"><?php echo $institute->name; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <label for="areaV" class="btn btn-area">Área V</label>
                    <input name="area" id="areaV" type="radio" class="area">
                    <ul>
                        <?php foreach($institutes as $institute): ?>
                            <?php if($institute->area == 'V'): ?>
                                <li class="btn btn-full" onclick="pullDiscipline(<?php echo $institute->id; ?>)"><?php echo $institute->name; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <label for="BI" class="btn btn-area">BI</label>
                    <input name="area" id="BI" type="radio" class="area">
                    <ul>
                        <?php foreach($institutes as $institute): ?>
                            <?php if($institute->area == 'BI'): ?>
                                <li class="btn btn-full" onclick="pullDiscipline(<?php echo $institute->id; ?>)"><?php echo $institute->name; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="disciplines">
                <div class="discipline card">
                    <div class="discipline-header">
                        <h4 style="text-align:center">Escolha uma Área e um "instituto" no menu lateral</h4>
                    </div>
                </div>
            </div>
        </section>
    <?php include('layouts/footer.inc'); ?>
    <script src="../vendors/jquery/jquery-2.1.4.min.js"></script>
    <script>
        function pullDiscipline(id){
            $.post('../controllers/discipline.php',{ institute: id, action: 'selectByInstitute'}, function(result) {
                $('.discipline').remove();
                $('.disciplines').append(result);
            });
        }
        $('.btn-area').click(function(){
            $('.btn-area').removeClass('active');
            $(this).addClass('active');
        });
        $('.btn-full').click(function(){
            $('.btn-full').removeClass('active');
            $(this).addClass('active');
        });
    </script>
    </body>
</html>
