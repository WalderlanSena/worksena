<!DOCTYPE html>
<html lang="br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="<?php echo $this->getPageTitle("-") ?> WorkSena Framework">
    <meta name="author" content="Walderlan Sena">
    <link rel="shortcut icon" href="/assets/imgs/favicon.png" />
    <title><?php echo $this->getPageTitle("-") ?> WorkSena Framework</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
  </head>
  <body>
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><!--Toggle navigation--></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/assets/imgs/favicon.png" alt=""></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="/blog">Blog</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="/login"> <strong>Login</strong></a>
              </li>
              <li>
                <a href="/cadastre-se"> <strong>Cadastrar</strong></a>
              </li>
              <?php if ($this->auth->verifyLogin()): ?>
              <li>
                <a href="/auth/logout"> <strong><span class="glyphicon glyphicon-log-out"></span> Sair</strong></a>
              </li>
              <?php endif; ?>
            </ul>
          </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
