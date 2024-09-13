<?php 
    require_once("verifica.php"); 
    include_once("cabec.php"); 
?>

<p>&nbsp;</p>

<h2 align="center" class="cor_texto"><?php echo $lng['aberturaCaixa']; ?></h2>
<div class="container position-absolute top-50 start-50 translate-middle">
<form id="abrir_form" action="autentica_abertura.php" method="post" class="form card-body row border-dark justify-content-center form-container">
	<div class="col-lg-8 col-sm-12">
		<div class="row g-3 align-items-center">
			<div class="col-lg-2 col-sm-12 ">
				&nbsp;
			</div>
			<div class="col-auto">
				<label for="responsavel" class="col-form-label corTextoInverso"><?php echo $lng['responsavel']; ?></label>
			</div>
			<div class="col-auto">
				<!-- <input type="text" id="responsavel" name="responsavel" size="80" class="form-control" aria-describedby="textoHelpResponsavel"> -->

				<input type="text" id="responsavel" name="responsavel" size="18" class="form-control" value="<?php echo $_SESSION['usuNome']; ?>" readonly aria-describedby="textoHelpResponsavel">

			</div>
		</div>

		<p>&nbsp;</p>

		<div class="row g-3 align-items-center">
			<div class="col-lg-2 col-sm-12 ">
				&nbsp;
			</div>
			<div class="col-auto">
				<label for="saldo_abertura" class="col-form-label corTextoInverso"><?php echo $lng['saldoAbertura']; ?></label>
			</div>
			<div class="col-auto">
				<input required type="number" id="saldo_abertura" name="saldo_abertura" size="80" class="form-control" aria-describedby="textoHelpSaldoAbertura">
			</div>
		</div>

		<p>&nbsp;</p>

		<div class="row g-3 justify-content-center">
			<button type="submit" class="btn btn-lg cor_barra cor_texto_barra btn-block col-lg-3 abrir-caixa"><?php echo $lng['abrirCaixa']; ?></button>	
		</div>

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

		<script>
                document.getElementById('abrir_form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    var formData = new FormData(this);
                    fetch('autentica_abertura.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Exibir um popup personalizado com o SweetAlert2
                        Swal.fire({
                            title: 'Caixa aberto com sucesso!',
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
</form>
</div>

<p>&nbsp;</p>

<?php include_once("rodape.php"); ?>