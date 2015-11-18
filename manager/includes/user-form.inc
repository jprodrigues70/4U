<?php $noHomePage = ($_SERVER['SCRIPT_NAME'] != "/4U/views/index.php") ;?>
   <form action="../controllers/user.php" method="POST" enctype="multipart/form-data" class="s-form">
    <div class="prev-img" style="background-image: url(../assets/img/logo-gT.png);">
        <div class="fake">
            <i class="icon-picture"></i>
        </div>
        <img id="prev-img" src="../<?php echo isset($user->image) ? 'uploads/users/' . $user->image : 'assets/img/default.png' ; ?>">
        <?php if ($noHomePage):?>
            <input type="file" name="picture" value="<?php echo isset($user) ? $user->image : NULL ; ?>" id="changer">
        <?php endif; ?>
    </div>
    <?php if (isset($user)) echo '<input type="hidden" name="image" value="'.$user->image.'"' ?>
    <div class="field has-label">
        <label for="name">Nome de Usuário *</label>
        <input type="text" name="name" id="name" value="<?php echo isset($user) ? $user->name : NULL ;?>" required>
    </div>
    <div class="field has-label">
        <label for="email">E-mail *</label>
        <input type="email" name="email" id="email" value="<?php echo isset($user) ? $user->email : NULL ;?>" required>
    </div>
    <?php if ($action == 'create'): ?>
        <div class="form-controled">
            <div class="field has-label">
                <label for="new">Senha *<small class="rg">A senha deve conter de 6 a 20 caracteres.</small></label>
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
    <?php if ($noHomePage): $_SESSION["url"] = 1;?>
        <div>
            <label for="level">Nível *</label>
            <select name="level" id="level">
                <option value="0" <?php if(isset($user) && $user->level == 0) echo 'selected'; ?>>Usuário</option>
                <option value="1" <?php if(isset($user) && $user->level == 1) echo 'selected'; ?>>Admin</option>
            </select>
        </div>
    <?php endif; ?>
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
    <div class="msg-fixed warning" id="top-msg">Os campos com * são obrigatórios.</div>
    <div class="btn-pair">
        <?php if ($noHomePage): ?>
    	   <a href="users.php" class="btn cancel">Voltar</a>
        <?php endif; ?>
    	<button name="action" type="submit" class="btn send" value="<?php echo $action; ?>">Cadastrar</button>
    </div>
    <?php echo isset($user) ? '<input name="id" value="'.$user->id.'" type="hidden">' : NULL; ?>
</form>