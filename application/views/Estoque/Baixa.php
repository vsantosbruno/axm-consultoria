<?php $this->load->view("Static/Header.php"); ?>
<?php $this->load->view("Static/Menu");?>
<?php $this->output->enable_profiler(TRUE); ?>
<div class="col-md-10">
	<div id="header">
		<strong>
			<em>
				<h3 class="espacamentoLeft">Baixa de Produtos</h3>
				<p id="mensagem"></p>
			</em>
		</strong>
	</div>
	<div id="body" class="col-md-6 container-fluid">
		<form id="formBaixaDeProdutos" action=<?=base_url('index.php/Baixa/cadastrarBaixa')?> method="POST">
			<div class='form-group'>
				<?php $usuario = $this->session->userdata("usuario_logado");?>
				<input type="hidden" name="idUsuario" value=<?=$usuario['id']?>>
				<div class="col-md-12">
					<label for="idProduto">Produto</label>
					<select class="form-control" id="idProduto" name="idProduto">
						<option value="0">Selectione um produto</option>
						<?php foreach ($produtos_estoque as $key => $produto) :?>	
							<option value=<?=$produto['id']?> quantidade=<?=$produto['quantidade']?>><?=$produto['nome']?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="espacamentoTop col-md-6">
					<label for="quantidadeAtual">Quantidade em estoque</label>
					<input class="form-control" type="text" id="quantidadeAtual" name="quantidadeAtual" disabled="">
				</div>
				<div class="espacamentoTop col-md-6">
					<label for="quantidade">Quantidade</label>
					<input class="form-control" type="text" id="quantidade" name="quantidade">
				</div>
				<div class="espacamentoTopBottom col-md-12">
					<input class="btn btn-success" type="submit" name="darBaixa" value="Dar baixa">
					<button class="btn btn-default" id="limpar" name="limpar">Limpar</button>
				</div>
			</div>
		</form>
	</div>
</div>
</main>
<footer class="thumbnail">
	<?php $usuario = $this->session->userdata("usuario_logado");?>
	<p>Usuário logado: <strong><em><?=$usuario['nome_usuario']?></em></strong></p>
</footer>
<script src=<?=base_url("js/jquery-2.2.3.min.js")?>></script>
<script src=<?=base_url("js/bootstrap.min.js")?>></script>
<script src=<?=base_url("js/dist/jquery.validate.min.js")?>></script>
<script>
	$().ready(function(){
		$("#formBaixaDeProdutos").validate({
			rules:{
				quantidade:{
					required: true
				}
			},
			messages:{
				quantidade:{
					required: "Digite a quantidade do produto"
				}
			},
			errorElement: 'span',
			
			submitHandler: function(){
				var dados = $("#formBaixaDeProdutos").serialize();
				
				$.ajax({
              	type: "POST",
                 url: "<?=base_url('index.php/Baixa/cadastrarBaixa?ajax=true')?>",
                 data: dados,
                 dataType: 'json',
                 success: function(data){
                 	if(data.result==true){
                 		var p = '<?=$this->session->flashdata('success')?>';
                 		$("#mensagem").addClass("alert").addClass("alert-success").text(p);	
                 	} else{
						var p = '<?=$this->session->flashdata('danger')?>';
		             	$("#mensagem").addClass("alert").addClass("alert-danger").text(p);
                 	}
                 }
                 });

              	return false;
			}
		});
	});

	$("#quantidade").focusout(function(){
		$("#alerta").text("");
		var qtd = $(this).val();
		var qtdAtual = $("#quantidadeAtual").val();
		if(qtd > qtdAtual){
			alert("O valor ultrapassa a quantidade em estoque");
			$(this).val("");
		}
	});

	$("#limpar").click(function(){
		$("#idProduto").val("0");
		$("#quantidade").val("");
		$("#idProduto").focus();
	});

	$("option").click(function(){
		var qtd = $(this).attr('quantidade');
		$("#quantidadeAtual").val(qtd);
	});
</script>
<?php $this->load->view("Static/Footer.php") ?>
