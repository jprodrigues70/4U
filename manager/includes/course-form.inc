<form action="../controllers/course.php" method="POST" enctype="multipart/form-data" class="s-form">
    <div class="msg-fixed warning">Os campos com * são obrigatórios.</div>
    <div class="field has-label">
        <label for="code">Código *</label>
        <input id="code" type="text" name="code" value="<?php echo isset($course) ? $course->code : NULL ;?>" required>
    </div>
    <div class="field has-label">
        <label for="code">Nome *</label>
        <input id="code" type="text" name="name" value="<?php echo isset($course) ? $course->name : NULL ;?>" required>
    </div>
    <select name="area">
        <option value="I">Área I</option>
        <option value="II">Área II</option>
        <option value="III">Área III</option>
        <option value="IV">Área IV</option>
        <option value="BI">BI</option>
    </select>
    <select name="institute">
        <?php foreach($institutes as $institute): ?>
        <option name="institute" value="<?php echo $institute->id; ?>" <?php if(isset($course) && $institute->id == $course->institute) echo 'selected'; ?>><?php echo $institute->name; ?></option>
        <?php endforeach; ?>
    </select>
    <div class="btn-pair">
        <a class="btn cancel" href="files.php">Cancelar</a>
        <button name="action" type="submit" class="btn send" value="<?php echo $action; ?>">Atualizar</button>
    </div>
    <?php echo isset($course) ? '<input name="id" value="'.$course->id.'" type="hidden">' : NULL; ?>
</form>
