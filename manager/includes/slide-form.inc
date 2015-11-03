<form action="../controllers/slide.php" method="POST" enctype="multipart/form-data" class="s-form">
    <div class="msg-fixed warning">Os campos com * são obrigatórios.</div>
    <div class="field has-label">
        <label for="title">Título</label>
        <input id="title" type="text" name="title" value="<?php echo isset($slide) ? $slide->title : NULL; ?>" required>
    </div>    
    <div class="field has-label">
        <label for="link">Link</label>
        <input id="link" type="text" name="link" value="<?php echo isset($slide) ? $slide->link : NULL; ?>" required>
    </div>
    <div class="input-file">
        <div class="btn btn-file">
            <i class="fa fa-upload"></i>
            <input type="file" class="real" name="image" value="">
        </div>
        <div class="field">
            <input class="false" type="text" value="" placeholder="Nenhum arquivo foi selecionado.">
        </div> *
    </div>
    <div class="msg-fixed warning">* Arquivo não deve possuir tamanho maior que 20 Megabytes.</div>
    <div class="btn-pair">
        <?php echo isset($slide) ? '<input name="id" value="'.$slide->id.'" type="hidden">' : NULL; ?>
        <a class="btn cancel" href="files.php">Cancelar</a>
        <button name="action" type="submit" class="btn send" value="<?php echo $action; ?>">Enviar</button>
    </div>
</form>
