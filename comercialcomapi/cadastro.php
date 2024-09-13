<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        .tab-pane.active {
            display: block;
        }
    </style>
</head>
<body>

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

<div class="container position-absolute top-50 start-50 translate-middle">
    <form action="autentica_cad.php" method="post" class="form-container">
        <div class="col-lg-8 col-sm-12">
            <ul class="nav nav-tabs mb-3" id="etapasTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="etapa1-tab" data-toggle="tab" href="#etapa1" role="tab" aria-controls="etapa1" aria-selected="true">Etapa 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="etapa2-tab" data-toggle="tab" href="#etapa2" role="tab" aria-controls="etapa2" aria-selected="false">Etapa 2</a>
                </li>
            </ul>

            <div class="tab-content" id="etapasTabContent">
                <div class="tab-pane fade show active" id="etapa1" role="tabpanel" aria-labelledby="etapa1-tab">
                    <div class="form-group row">
                        <label for="edtMail" class="col-sm-3 col-form-label"><?php echo $lng['email']; ?></label>
                        <div class="col-sm-9">
                            <input type="email" id="edtMail" name="edtMail" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="edtName" class="col-sm-3 col-form-label"><?php echo $lng['nome']; ?></label>
                        <div class="col-sm-9">
                            <input type="text" id="edtName" name="edtName" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="edtSenha" class="col-sm-3 col-form-label"><?php echo $lng['senha']; ?></label>
                        <div class="col-sm-9">
                            <input type="password" id="edtSenha" name="edtSenha" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo_usuario" class="col-sm-3 col-form-label"><?php echo $lng['tipoUsuario']; ?></label>
                        <div class="col-sm-9">
                            <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                                <option value="usuario"><?php echo $lng['usuario']; ?></option>
                                <option value="usuario_intermediario"><?php echo $lng['usuarioIntermediario']; ?></option>
                                <option value="adm"><?php echo $lng['usuarioAdm']; ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="etapa2" role="tabpanel" aria-labelledby="etapa2-tab">
                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" maxlength="9" onblur="pesquisacep(this.value);">
                    </div>
                    <div class="form-group">
                        <label for="rua">Rua:</label>
                        <input type="text" class="form-control" id="rua" name="rua">
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" id="bairro" name="bairro">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cidade">Cidade:</label>
                            <input type="text" class="form-control" id="cidade" name="cidade">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="uf">Estado:</label>
                            <input type="text" class="form-control" id="uf" name="uf">
                        </div>
                    </div>

                    <div class="row justify-content-center">   
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>

   
    <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            $("#cep").blur(function() {

                var cep = $(this).val().replace(/\D/g, '');

                if (cep != "") {

                    var validacep = /^[0-9]{8}$/;

                    if(validacep.test(cep)) {

                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } 
                            else {
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } 
                    else {
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } 
                else {
                    limpa_formulário_cep();
                }
            });
        });

    </script>

</body>
</html>
