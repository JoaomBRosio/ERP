<?php
require_once("verifica.php");
include_once("cabec.php");

$key = "PortalZ";
$data = $_REQUEST;
include_once("config.php");
$conexao = db_connect();
extract($data);

// Definir o número de itens por página
$itensPorPagina = 5;

// Pegar o número da página atual, se não houver, usar a página 1
$paginaAtual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;

// Consulta SQL para contar o número total de vendas
$totalQuery = "SELECT COUNT(*) FROM vendas";
$totalStmt = $conexao->prepare($totalQuery);
$totalStmt->execute();
$totalVendas = $totalStmt->fetchColumn();

// Calcular o número total de páginas
$totalPaginas = ceil($totalVendas / $itensPorPagina);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<p>&nbsp;</p>
<div class="container">
    <h2 class="cor_texto">Lista de Vendas</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Fornecedor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta SQL para selecionar as vendas com limite e offset
                $query = "SELECT id, nome, descricao, preco, estoque, fornecedor 
                          FROM produto
                          LIMIT :limite OFFSET :offset";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':limite', $itensPorPagina, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                                
                // Loop através dos resultados e exibir na tabela
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['nome']."</td>";
                    echo "<td>".$row['descricao']."</td>";
                    echo "<td>".$row['preco']."</td>";
                    echo "<td>".$row['estoque']."</td>";
                    echo "<td>".$row['fornecedor']."</td>";
                    echo "<td>
                            <button class='btn btn-primary btn-sm editar-venda' data-id='".$row['id']."'><i class='fas fa-edit'></i> Editar</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <nav aria-label="Navegação de página exemplo">
        <ul class="pagination justify-content-center">
            <?php if ($paginaAtual > 1): ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $paginaAtual - 1; ?>">Anterior</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php echo ($paginaAtual == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($paginaAtual < $totalPaginas): ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $paginaAtual + 1; ?>">Próxima</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function carregarProdutos() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var produtos = JSON.parse(xhr.responseText);
                    var selectProduto = document.getElementById('swal-produto');
                    produtos.forEach(function(produto) {
                        var option = document.createElement('option');
                        option.value = produto.id;
                        option.text = produto.nome;
                        selectProduto.appendChild(option);
                    });
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Não foi possível carregar os produtos.',
                        icon: 'error'
                    });
                }
            }
        };
        xhr.open('GET', 'buscar_produtos.php');
        xhr.send();
    }

    $(document).ready(function(){
        $('.editar-venda').click(function(){
            var vendaId = $(this).data('id');
            Swal.fire({
                title: 'Editar Vendas',
                html:
                    //'<label for="swal-nomeCliente">Nome do Cliente:</label>' +
                    //'<input id="swal-nomeCliente" class="swal2-input" v>' +
                    '<label for="swal-produto">Produto:</label>' +
                    '<select id="swal-produto" class="swal2-select"></select>' +
                    '<br>' +
                    '<label for="swal-quantidade">Quantidade:</label>' +
                    '<input id="swal-quantidade" class="swal2-input" type="number" value="0">',
                focusConfirm: false,
                preConfirm: () => {
                    const produto = document.getElementById('swal-produto').value;
                    const quantidade = document.getElementById('swal-quantidade').value;
                    window.location.href = `editar_vendas.php?id=${vendaId}&produto=${produto}&quantidade=${quantidade}`;
                },
                onOpen: () => {
                    carregarProdutos();
                }
            });
        });
    });
</script>
</body>
</html>
<p>&nbsp;</p>
<?php include_once("rodape.php"); ?>
