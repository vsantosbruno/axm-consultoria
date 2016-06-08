<main class="container-fluid">
	<div class="list-group col-md-2 thumbnail">
		<button class="list-group-item btn btn-default" data-target="#cadastro" data-toggle="collapse">Cadastrar <span class="caret"/></button>
			<ul id="cadastro" class="collapse nav list-group">
				<li><?= anchor('Usuario','Usuários'); ?></li>
				<li><?= anchor('gestao/financeira/saidas','Fornecedores'); ?></li>
				<li><?= anchor('gestao/financeira/arrecadacao','Produtos'); ?></li>
			</ul>
		<button class="list-group-item btn btn-default" data-target="#gestaoCelular" data-toggle="collapse">Gestão Celular <span class="caret"/></button>
			<ul id="gestaoCelular" class="collapse nav list-group">
				<li><?= anchor('gestao/celular/pessoas','Pessoas'); ?></li>
				<li><?= anchor('gestao/celular/patentes','Patentes'); ?></li>
				<li><?= anchor('gestao/celular/lideres','Líderes'); ?></li>
				<li><?= anchor('gestao/celular/celulas','Células'); ?></li>
				<li><?= anchor('gestao/celular/geracoes','Gerações'); ?></li>
				<li><?= anchor('gestao/celular/relatorioCelular','Relatório Celular'); ?></li>
			</ul>
		<button class="list-group-item btn btn-default">Gestão patrimonial <span class="caret"/></button>
	</div>