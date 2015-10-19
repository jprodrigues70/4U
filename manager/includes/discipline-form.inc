<form action="../controllers/discipline.php" method="POST" enctype="multipart/form-data" class="s-form">
    <div class="msg-fixed warning">Os campos com * são obrigatórios.</div>
    <div class="field has-label">
        <label for="code">Código *</label>
        <input id="code" type="text" name="code" value="<?php echo isset($discipline) ? $discipline->code : NULL ;?>" required>
    </div>
    <div class="field has-label">
        <label for="code">Nome *</label>
        <input id="code" type="text" name="name" value="<?php echo isset($discipline) ? $discipline->name : NULL ;?>" required>
    </div>
    <select name="institute">
        <?php foreach($institutes as $institute): ?>
        <option name="institute" value="<?php echo $institute->id; ?>" <?php if($institute->id == $discipline->institute) echo 'selected'; ?>><?php echo $institute->name; ?></option>
        <?php endforeach; ?>
    </select>
    <div class="btn-pair">
        <a class="btn cancel" href="files.php">Cancelar</a>
        <button name="action" type="submit" class="btn send" value="<?php echo $action; ?>">Atualizar</button>
    </div>
    <?php echo isset($discipline) ? '<input name="id" value="'.$discipline->id.'" type="hidden">' : NULL; ?>
</form>
