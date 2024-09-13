
<?php 
    require_once("verifica.php"); 
    include_once("cabec.php"); 
?>
<head>
	<style>
		.form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
	</style>
</head>
<p>&nbsp;</p>

<h2 align="center" class="cor_texto"><?php echo $lng['fechamentoCaixa']; ?></h2>
<div class="container position-absolute top-50 start-50 translate-middle">
<form id="fechar_form" action="autentica_fechamento.php" method="post" class="form card-body row border-dark justify-content-center form-container">
	<div class="col-lg-8 col-sm-12">
		<div class="row g-3 align-items-center">
			<div class="col-lg-2 col-sm-12 ">
				&nbsp;
			</div>
			<div class="col-auto">
				<label for="id" class="col-form-label corTextoInverso"><?php echo $lng['idConta']; ?></label>
			</div>
			<div class="col-auto">
				<input type="number" id="id" name="id" size="80" class="form-control" aria-describedby="textoHelpIdConta">
			</div>
		</div>

		<p>&nbsp;</p>

		<div class="row g-3 align-items-center">
			<div class="col-lg-2 col-sm-12 ">
				&nbsp;
			</div>
			<div class="col-auto">
				<label for="entradas" class="col-form-label corTextoInverso"><?php echo $lng['entradas']; ?></label>
			</div>
			<div class="col-auto">
				<input type="number" id="entradas" name="entradas" size="80" class="form-control" aria-describedby="textoHelpEntradas">
			</div>
		</div>

		<p>&nbsp;</p>

		<div class="row g-3 align-items-center">
			<div class="col-lg-2 col-sm-12 ">
				&nbsp;
			</div>
			<div class="col-auto">
				<label for="saidas" class="col-form-label corTextoInverso"><?php echo $lng['saidas']; ?></label>
			</div>
			<div class="col-auto">
				<input type="number" id="saidas" name="saidas" size="80" class="form-control" aria-describedby="textoHelpSaidas">
			</div>
		</div>

		<p>&nbsp;</p>

		<div class="row g-3 justify-content-center">
			<button type="submit" class="btn btn-lg cor_barra cor_texto_barra btn-block col-lg-3 fechar-caixa"><?php echo $lng['fecharCaixa']; ?></button>	
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

			<script>
                document.getElementById('fechar_form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    var formData = new FormData(this);
                    fetch('autentica_fechamento.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Exibir um popup personalizado com o SweetAlert2
                        Swal.fire({
                            title: 'Caixa fechado com sucesso!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        });
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                    });
                });
            </script>
		</div>
		
	</div>
</form>
</div>

<p>&nbsp;</p>

<?php include_once("rodape.php"); ?>