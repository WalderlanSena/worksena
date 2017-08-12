<div class="login-page">
    <?php $this->renderNotify('success'); ?>
    <?php $this->renderNotify('errors');  ?>
    <?php $this->renderNotify('info'); ?>
    <div class="form">
        <figure>
            <img src="/assets/imgs/logo-sm.png" class="img-reponsive" alt="Logo worksena">
        </figure>
        <br>
        <form class="login-form " action="/auth/login" method="post">
            <input type="text" name="login" placeholder="Digite seu login" value="<?php echo (isset($this->inputs['email']) ? $this->inputs['email'] : ''); ?>" autofocus required/>
            <input type="password" name="senha" placeholder="Digite sua senha" required/>
            <button>Entrar</button>
            <p class="message">Não é registrado? <a href="/cadastre-se">Criar uma conta !</a></p>
        </form>
    </div>
</div>
