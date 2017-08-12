<div class="login-page">
  <?php $this->renderNotify('success'); ?>
  <?php $this->renderNotify('errors');  ?>
  <div class="form">
    <figure>
      <img src="/assets/imgs/logo-sm.png" class="img-reponsive" alt="">
    </figure>
    <br>
    <form class="login-form" action="/novo/registro" method="post">
      <div class="form-group <?php echo (isset($this->errors['nome']) ? 'has-error' : ''); ?>">
        <input type="text" name="nome" placeholder="Digite seu nome" value="<?php echo (isset($this->inputs['nome']) ? $this->inputs['nome'] : ''); ?>" autofocus/>

        <strong><p class="help-block"><?php echo (isset($this->errors['nome']) ? $this->errors['nome'] : ''); ?></p></strong>
      </div>

      <div class="form-group <?php echo (isset($this->errors['email']) ? 'has-error' : ''); ?>">
        <input type="text" name="email" value="<?php echo (isset($this->inputs['email']) ? $this->inputs['email'] : ''); ?>" placeholder="Digite seu login" />

        <strong><p class="help-block"><?php echo (isset($this->errors['login']) ? $this->errors['login'] : ''); ?></p></strong>
      </div>

      <div class="form-group <?php echo (isset($this->errors['senha']) ? 'has-error' : ''); ?>">
        <input type="password" name="senha" value="<?php echo (isset($this->inputs['senha']) ? $this->inputs['senha'] : ''); ?>"  placeholder="Digite sua senha"/>

        <strong><p class="help-block"><?php echo (isset($this->errors['senha']) ? $this->errors['senha'] : ''); ?></p></strong>
      </div>

      <button type="submit">Cadastre-se</button>

      <p class="message">Já é registrado? <a href="/login">Fazer login !</a></p>
    </form>
  </div>
</div>
