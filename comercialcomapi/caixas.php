<?php 	

require_once("verifica.php");
include_once("cabec.php");

?>

<?php
	$key = "PortalZ";

    $data=$_REQUEST;

    include_once("config.php");

    $conexao = db_connect();
    extract($data);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Caixas</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<p>&nbsp;</p>
<div class="container">
    <h2 class="cor_texto">Lista de Caixas</h2>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Responsável</th>
                    <th>Saldo Abertura</th>
                    <th>Entradas</th>
                    <th>Saídas</th>
                    <th>Saldo Fechamento</th>
                    <th>Data Abertura</th>
                    <th>Data Fechamento</th>
                    <th>Ações</th> <!-- Nova coluna para as ações -->
                </tr>
            </thead>
            <tbody>
                <?php
                
                
                $query = "SELECT
                id,
                data_abertura,
                data_fechamento,
                responsavel,
                saldo_abertura,
                entradas,
                saidas,
                saldo_fechamento
            FROM financeiro";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                
                // Loop através dos resultados e exibir na tabela
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['responsavel']."</td>";
                    echo "<td>".$row['saldo_abertura']."</td>";
                    echo "<td>".$row['entradas']."</td>";
                    echo "<td>".$row['saidas']."</td>";
                    echo "<td>".$row['saldo_fechamento']."</td>";
                    echo "<td>".date('d/m/Y H:i:s', strtotime($row['data_abertura']))."</td>";
                    if (is_null($row['data_fechamento'])){
                        echo '<td>Não foi fechado</td>';
                    } else {
                        echo "<td>".date('d/m/Y H:i:s', strtotime($row['data_fechamento']))."</td>";
                    }
                    
                    echo "<td>
                            <button class='btn btn-danger btn-sm excluir-venda' data-id='".$row['id']."'><i class='fas fa-trash-alt'></i> Excluir</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
            </body>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

            <script>
            // Script para lidar com a exclusão de vendas usando SweetAlert2
            $(document).ready(function(){
                $('.excluir-venda').click(function(){
                    var vendaId = $(this).data('id');
                    // Exibir pop-up de confirmação de exclusão
                    Swal.fire({
                        title: 'Tem certeza?',
                        text: 'Esta ação não pode ser desfeita!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Se confirmado, redirecionar para a página de exclusão
                            window.location.href = 'excluir_caixa.php?id=' + vendaId;
                        }
                    });
                });
            });
            </script>

<script>
    // Função para buscar os produtos do servidor e preencher o select
    function carregarProdutos() {
    // Fazendo requisição AJAX para buscar os produtos
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Se a requisição for bem-sucedida, preenche o select com os produtos
                var produtos = JSON.parse(xhr.responseText);
                var selectProduto = document.getElementById('swal-produto');
                produtos.forEach(function(produto) {
                    var option = document.createElement('option');
                    option.value = produto.id;
                    option.text = produto.nome;
                    selectProduto.appendChild(option);
                });
            } else {
                // Em caso de erro, exibe uma mensagem de erro
                Swal.fire({
                    title: 'Erro!',
                    text: 'Não foi possível carregar os produtos.',
                    icon: 'error'
                });
            }
        }
    };

    // Configura a requisição AJAX
    xhr.open('GET', 'buscar_produtos.php');
    xhr.send();
}

$(document).ready(function(){
                $('.editar-venda').click(function(){
                    var vendaId = $(this).data('id');
        // Exibe o alerta de edição de vendas
        Swal.fire({
            title: 'Editar Vendas',
            html:
                '<label for="swal-nomeCliente">Nome do Cliente:</label>' +
                '<input id="swal-nomeCliente" class="swal2-input">' +
                '<label for="swal-produto">Produto:</label>' +
                '<select id="swal-produto" class="swal2-select"></select>' +
                '<br>' +
                '<label for="swal-quantidade">Quantidade:</label>' +
                '<input id="swal-quantidade" class="swal2-input" type="number" value="0">',
            focusConfirm: false,
            preConfirm: () => {
                // Captura os valores dos campos do alerta
                const nomeCliente = document.getElementById('swal-nomeCliente').value;
                const produto = document.getElementById('swal-produto').value;
                const quantidade = document.getElementById('swal-quantidade').value;
                
                // Redireciona para a página de edição de vendas com os parâmetros na URL
                window.location.href = `editar_vendas.php?id=${vendaId}&nomeCliente=${nomeCliente}&produto=${produto}&quantidade=${quantidade}`;
            },
            onOpen: () => {
                // Quando o alerta abrir, carrega os produtos
                carregarProdutos();
            }
        });
                });
            });
    </script>

</html>

<p>&nbsp;</p>

<?php include_once("rodape.php"); ?>