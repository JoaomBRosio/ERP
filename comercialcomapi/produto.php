<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<?php
require_once("verifica.php");
include_once("cabec.php");

if ($_SESSION['tipo_usuario'] !== "adm") {
	echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire({
							title: "Acesso Negado",
							text: "Você não tem permissão para acessar esta página.",
							icon: "error",
							confirmButtonText: "OK"
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "index.php"; // Redirecionar para a página inicial ou de login
							}
						});
					});
				  </script>';
				  	
	exit;

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Produto - Sistema ERP</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
    <div class="row align-items-center">
        <h1>Criar Produto</h1>
</div>

<div class="container position-absolute top-50 start-50 translate-middle">
        <form id="produto_form" method="post" action="adicionar_produto.php" class="form card-body row border-dark justify-content-center form-container">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descricao" style="padding-top: 20px;">Descrição:</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="preco" style="padding-top: 20px;">Preço:</label>
                <input type="number" name="preco" id="preco" min="0" step="0.01" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="estoque" style="padding-top: 20px;">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fornecedor" style="padding-top: 20px;">Fornecedor:</label>
                <input type="text" name="fornecedor" id="fornecedor" class="form-control" required>
            </div>
            <p>&nbsp;</p>
            <input type="submit" value="Criar produto" class="btn btn-lg cor_barra cor_texto_barra btn-block col-lg-3">
            <script>
                document.getElementById('produto_form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    var formData = new FormData(this);
                    fetch('adicionar_produto.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Exibir um popup personalizado com o SweetAlert2
                        Swal.fire({
                            title: 'Produto criado com sucesso!',
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
        </form>
        </div>
    </div>
</body>
</html>

<?php include_once("rodape.php"); ?>

<?php include_once("rodape.php"); ?>