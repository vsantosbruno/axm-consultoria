<main class="container-fluid">
	<div class="list-group col-md-2 thumbnail">
		<button class="list-group-item btn btn-default" data-target="#cadastro" data-toggle="collapse">Cadastrar <span class="caret"/></button>
			<ul id="cadastro" class="collapse nav list-group">
				<li><?= anchor('Usuarios','Usuários'); ?></li>
				<li><?= anchor('Produtos','Produtos'); ?></li>
				<li><?= anchor('Fornecedores','Fornecedores'); ?></li>
			</ul>
		<button class="list-group-item btn btn-default" data-target="#gestaoCelular" data-toggle="collapse">Estoque <span class="caret"/></button>
			<ul id="gestaoCelular" class="collapse nav list-group">
				<li><?= anchor('Estoque','Compra de produtos'); ?></li>
			</ul>
	</div>