<form action="../controllers/institute.php" method="POST" enctype="multipart/form-data" class="s-form">
    <div class="msg-fixed warning">Os campos com * são obrigatórios.</div>
    <div class="field has-label">
        <label for="code">Nome *</label>
        <input id="code" type="text" name="name" value="<?php echo isset($institute) ? $institute->name : NULL ;?>" required>
    </div>
    <select name="area">
        <option value="I">Área I</option>
        <option value="II">Área II</option>
        <option value="III">Área III</option>
        <option value="IV">Área IV</option>
        <option value="BI">BI</option>
    </select>
    <div class="btn-pair">
        <a class="btn cancel" href="files.php">Cancelar</a>
        <button name="action" type="submit" class="btn send" value="<?php echo $action; ?>">Atualizar</button>
    </div>
    <?php echo isset($institute) ? '<input name="id" value="'.$institute->id.'" type="hidden">' : NULL; ?>
</form>
