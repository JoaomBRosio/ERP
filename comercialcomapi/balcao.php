<?php

require_once("verifica.php");
include_once("cabec.php");

?>

<?php
$key = "PortalZ";

$data = $_REQUEST;

include_once("config.php");

$conexao = db_connect();
extract($data);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Balcão - Sistema ERP</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">

        <form id="form-venda" method="post" action="processar_venda.php" class="form card-body row border-dark justify-content-center">
            <div class="col-lg-2 col-sm-12 ">
                &nbsp;
            </div>
            <div class="row align-items-center">
                <div class="form-group">
                    <h1>Balcão - Sistema ERP</h1>
                    <label for="produto">Produto:</label>
                    <select name="produto" id="produto">
                        <?php
                        $query = "SELECT id, nome FROM produto"; // Use o nome da sua tabela de produtos aqui

                        // Executar a consulta SQL
                        $resultado = $conexao->query($query);

                        // Verificar se a consulta foi bem-sucedida
                        if ($resultado) {
                            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" name="quantidade" id="quantidade" min="1" class="form-control" required>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="form-group">
                    <label for="cliente">Cliente:</label>
                    <input type="text" name="cliente" id="cliente" class="form-control" value="<?php echo $_SESSION['usuNome']; ?>" readonly required>
                </div>

            </div>
            <div>
                &nbsp;
            </div>
            <input type="submit" value="Processar Venda" class="btn btn-lg cor_barra cor_texto_barra btn-block col-lg-3">
            <script>
document.getElementById('form-venda').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);
    fetch('processar_venda.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Parse the response as JSON
    .then(data => {
        if (data.status === 'success') {
            // Exibir um popup de sucesso com o SweetAlert2
            Swal.fire({
                title: 'Sucesso',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else {
            // Exibir um popup de erro com o SweetAlert2
            Swal.fire({
                title: 'Erro',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        Swal.fire({
            title: 'Erro',
            text: 'Ocorreu um erro ao processar a venda.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
});
            </script>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php include_once("rodape.php"); ?>