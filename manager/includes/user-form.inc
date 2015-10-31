<form action="../controllers/user.php" method="POST" enctype="multipart/form-data" class="s-form">
    <div class="msg-fixed warning" id="top-msg">Os campos com * são obrigatórios.</div>
    <div class="prev-img" style="background-image: url(../assets/img/logo-gT.png);">
        <div class="fake">
            <i class="icon-picture"></i>
        </div>
        <img id="prev-img">
        <input type="file" name="picture" value="" id="changer">
    </div>
    <div class="field has-label">
        <label for="name">Nome *</label>
        <input type="text" name="name" id="name" value="<?= isset($user) ? $user->name : NULL ;?>" required>
    </div>
    <div class="field has-label">
        <label for="email">E-mail *</label>
        <input type="email" name="email" id="email" value="<?= isset($user) ? $user->email : NULL ;?>" required>
    </div>
    <?php if ($action == 'create'): ?>
        <div class="form-controled">
            <div class="msg-fixed warning">A senha deve conter de 6 a 20 caracteres.</div>
            <div class="field has-label">
                <label for="new">Senha *</label>
                <input id="new" type="password" title="6 a 20 caracteres" pattern=".{6,20}">
            </div>
            <div class="field has-label">
                <label for="confirm">Confirmar Senha *</label>
                <input id="confirm" type="password" name="password" title="6 a 20 caracteres" pattern=".{6,20}">
            </div>
        </div>
    <?php else: ?>
        <button id="form-control" type="button" class="btn warning" href="#">Alterar senha?</button>
        <div class="form-controled invisible">
            <div class="msg-fixed warning">A senha deve conter de 6 a 20 caracteres.</div>
            <div class="field has-label">
                <label for="new">Nova Senha *</label>
                <input id="new" type="password" title="6 a 20 caracteres" pattern=".{6,20}">
            </div>
            <div class="field has-label">
                <label for="confirm">Confirmar Senha *</label>
                <input id="confirm" type="password" name="password" title="6 a 20 caracteres" pattern=".{6,20}">
            </div>
        </div>
    <?php endif; ?>
    <div>
        <label for="level">Nível *</label>
        <select name="level" id="level">
            <option value="0" <?php if(isset($user) && $user->level == 0) echo 'selected'; ?>>Usuário</option>
            <option value="1" <?php if(isset($user) && $user->level == 1) echo 'selected'; ?>>Admin</option>
        </select>
    </div>
    <div>
        <label for="course">Curso *</label>
        <select name="course" id="course">
            <?php $courses = Courses::selectAll(); ?>
            <?php foreach ($courses as $course): ?>
                <?php if (isset($course) && $user->course == $course->id): ?>
                    <option value="<?php echo $course->id ;?>" selected> <?php echo $course->name; ?></option>
                <?php else: ?>
                    <option value="<?php echo $course->id; ?>"><?php echo $course->name; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="btn-pair">
    	<a href="users.php" class="btn cancel">Voltar</a>
    	<button name="action" type="submit" class="btn send" value="<?php echo $action; ?>">Salvar</button>
    </div>
    <?php echo isset($user) ? '<input name="id" value="'.$user->id.'" type="hidden">' : NULL; ?>
</form>
