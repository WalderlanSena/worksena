	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<header>
					<h1 class="text-center">Blog ~ WorkSena - Framework - Default</h1>
					<?php $this->renderNotify("success"); ?>
					<?php $this->renderNotify("errors");  ?>
				</header>
			</div>
			<div class="col-md-3">
				<h2 class="text-center">Autor do Post:</h2>
				<figure>
					<img src="/assets/imgs/exemplo.png" class="img-responsive thumbnail" alt="">
				</figure>
				<p class="text-justify">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehende
				</p>
			</div>

			<div class="col-md-9">
				<?php foreach($this->view->posts as $post): ?>
				<article>
					<h1><a href="/blog/post/<?php echo $post->link; ?>"><?php echo $post->titulo; ?></a></h1>
					<p>
						<?php echo $post->descricao; ?>
					</p>
				</article>
				<hr>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
