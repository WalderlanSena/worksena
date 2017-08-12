  <div class="col-md-12">
    <?php $this->renderNotify("success"); ?>
  </div>
  <aside class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading profile-aside">
        <header>
          <h1 class="text-center">Meu Perfil</h1>
        </header>
      </div>
      <div class="panel-body profile-body">
        <a href="#">
          <img src="/assets/imgs/user.png" class="img-responsive profile"/>
        </a>
        <h4 class="text-center"><strong>@<?php echo $_SESSION['user']['nome']; ?></strong></h4>
        <div class="list-group">
          <a href="#">
            <button type="button" class="list-group-item"><span class="glyphicon glyphicon-user"></span> Meu Perfil</button>
          </a>

          <a href="#">
            <button type="button" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Configurações</button>
          </a>

          <a href="#">
            <button type="button" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> Últimos Posts</button>
          </a>
        </div>
      </div>
    </div>
    <aside class="col-md-12 text-center">
      <div class="list-group">
        <span class="list-group-item active">
          <h1>Últimas 5 postagens realizadas </h1>
        </span>
        <?php foreach($this->view->posts as $postagens): ?>
        <a href="blog/post/<?php echo $postagens->link; ?>" target="_blank" class="list-group-item">
          <?php echo $postagens->titulo; ?>
        </a>
        <?php endforeach; ?>
      </div>
    </aside>
  </aside>


  <div class="col-md-9 updates">
    <div class="col-sm-3">
      <div class="hero-widget numpost well well-sm">
          <div class="icon">
            <figure>
              <img src="/assets/imgs/list.png" alt="">
            </figure>
          </div>
          <div class="text">
            <var>3</var>
            <label class="text-muted">Postagens Realizadas</label>
          </div>
          <div class="options">

        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="hero-widget visulisacao well well-sm">
        <div class="icon">
          <figure>
            <img src="assets/imgs/visualizacoes.png" alt="">
          </figure>
        </div>
        <div class="text">
          <var>614</var>
          <label class="text-muted">Visualizações</label>
        </div>
        <div class="options">

        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="hero-widget mensages well well-sm">
        <div class="icon">
          <figure>
            <img src="assets/imgs/mail.png" alt="">
          </figure>
        </div>
        <div class="text">
          <var>73</var>
          <label class="text-muted">Mensagens</label>
        </div>
        <div class="options">

        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="hero-widget config well well-sm">
        <div class="icon">
          <figure>
            <img src="assets/imgs/config.png" alt="">
          </figure>
        </div>
        <div class="text">
          <var>75%</var>
          <label class="text-muted">Configurações</label>
        </div>
        <div class="options">

        </div>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading titulo-dash"><h1><span class="glyphicon glyphicon-dashboard"></span> Dashboard</h1></div>
      <div class="panel-body">
        <div class="col-md-12">
          <header>
            <h2 class="text-center"><span class="glyphicon glyphicon-pencil"></span> Cadastrar nova postagem</h2>
          </header>
          <!-- Formulario de cadastro de postagem no blog -->
          <form class="form-cad-blog" action="/administrator/createnewpost" method="post">
            <div class="form-group <?php echo (isset($this->errors['titulo']) ? 'has-error' : ''); ?>">
              <input type="text" class="form-control" name="titulo" placeholder="Digite seu titulo" value="<?php echo (isset($this->inputs['titulo']) ? $this->inputs['titulo'] : ''); ?>">
              <strong><p class="help-block"><?php echo (isset($this->errors['titulo']) ? $this->errors['titulo'] : ''); ?></p></strong>
            </div>

            <div class="form-group <?php echo (isset($this->errors['autor']) ? 'has-error' : ''); ?>">
              <input type="text" class="form-control" name="autor" placeholder="Digite o nome do autor" value="<?php echo (isset($this->inputs['autor']) ? $this->inputs['autor'] : ''); ?>">
                <strong><p class="help-block"><?php echo (isset($this->errors['autor']) ? $this->errors['autor'] : ''); ?></p></strong>
            </div>

            <div class="form-group <?php echo (isset($this->errors['link']) ? 'has-error' : ''); ?>">
              <input type="text" class="form-control" name="link" placeholder="Link do post" value="<?php echo (isset($this->inputs['link']) ? $this->inputs['link'] : ''); ?>">
              <strong><p class="help-block"><?php echo (isset($this->errors['link']) ? $this->errors['link'] : ''); ?></p></strong>
            </div>

            <div class="form-group <?php echo (isset($this->errors['descricao']) ? 'has-error' : ''); ?>">
              <textarea name="descricao" rows="4" cols="80" class="form-control" placeholder="Digite uma breve descrição do post..." value="<?php echo (isset($this->inputs['descricao']) ? $this->inputs['descricao'] : ''); ?>"></textarea>
              <strong><p class="help-block"><?php echo (isset($this->errors['descricao']) ? $this->errors['descricao'] : ''); ?></p></strong>
            </div>

            <div class="form-group <?php echo (isset($this->errors['conteudo']) ? 'has-error' : ''); ?>">
              <textarea name="conteudo" rows="10" cols="80" class="form-control" placeholder="Digite o conteúdo do publicação"></textarea>
              <strong><p class="help-block"><?php echo (isset($this->errors['conteudo']) ? $this->errors['conteudo'] : ''); ?></p></strong>
            </div>

            <div class="alert alert-warning">
              A micro-framework ainda não há suporte dinâmico de criação de postagem como o upload de de imagem e montagem dentro do textarea, ou seja, o conteúdo para que tenha uma modificação de fonte, se faz nescessario a incrementação de tag relacionadas, como: (< h1 >Meu Titulo< h1 >)
            </div>
            <button type="submit" class="pull-right btn btn-primary btn-lg input-lg" name="postar"><span class="glyphicon glyphicon-pencil"></span> Postar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
