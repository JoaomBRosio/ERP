<html>
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</head>

</html>
<?php
// Verifica se os parâmetros foram passados na URL
if (isset($_GET['produto']) && isset($_GET['quantidade']) && isset($_GET['id'])) {
    $produto = $_GET['produto'];
    $quantidade = $_GET['quantidade'];
    $idVenda = $_GET['id'];

    $key = "PortalZ";

    $data = $_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    try {
        // Iniciar transação
        $conexao->beginTransaction();

        // Verificar o estoque atual do produto
        $query = "SELECT estoque FROM produto WHERE id = :produto_id";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':produto_id', $produto);
        $stmt->execute();
        $produtoData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produtoData) {
            $estoqueAtual = $produtoData['estoque'];

            // Verificar a quantidade vendida anteriormente
            $query = "SELECT quantidade FROM vendas WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id', $idVenda);
            $stmt->execute();
            $vendaData = $stmt->fetch(PDO::FETCH_ASSOC);
            $quantidadeAnterior = $vendaData['quantidade'];

            // Calcular a diferença de quantidade
            $diferencaQuantidade = $quantidade - $quantidadeAnterior;

            // Verificar se há estoque suficiente para a nova quantidade
            if ($estoqueAtual >= $diferencaQuantidade) {
                // Atualizar a quantidade do produto no estoque
                $novoEstoque = $estoqueAtual - $diferencaQuantidade;
                $query = "UPDATE produto SET estoque = :novoEstoque WHERE id = :produto_id";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':novoEstoque', $novoEstoque);
                $stmt->bindParam(':produto_id', $produto);
                $stmt->execute();

                // Atualizar a venda
                $query = "UPDATE vendas SET produto_id = :produto, quantidade = :quantidade, data_venda = CURRENT_TIMESTAMP WHERE id = :id";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':produto', $produto);
                $stmt->bindParam(':quantidade', $quantidade);
                $stmt->bindParam(':id', $idVenda);
                $stmt->execute();

                // Confirmar a transação
                $conexao->commit();

                // Exibir mensagem de sucesso
                echo "<script>
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Venda editada com sucesso.',
                            icon: 'success'
                        }).then(function() {
                            window.location.href = 'vendas.php';
                        });
                      </script>";
            } else {
                // Reverter a transação
                $conexao->rollBack();

                // Exibir mensagem de erro por estoque insuficiente
                echo "<script>
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Estoque insuficiente para o produto.',
                            icon: 'error'
                        }).then(function() {
                            window.location.href = 'vendas.php';
                        });
                      </script>";
            }
        } else {
            throw new Exception("Produto não encontrado.");
        }
    } catch (Exception $e) {
        // Reverter a transação em caso de erro
        $conexao->rollBack();

        // Exibir mensagem de erro genérica
        echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao editar a venda: " . $e->getMessage() . "',
                    icon: 'error'
                }).then(function() {
                    window.location.href = 'vendas.php';
                });
              </script>";
    }
} else {
    // Parâmetros inválidos
    echo "<script>
            Swal.fire({
                title: 'Erro!',
                text: 'Parâmetros inválidos.',
                icon: 'error'
            }).then(function() {
                window.location.href = 'index.php';
            });
          </script>";
}
?>
