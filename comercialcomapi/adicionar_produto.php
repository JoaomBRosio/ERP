

<?php
	$key = "PortalZ";

    $data=$_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validação dos dados recebidos do formulário
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        $fornecedor = $_POST['fornecedor'];

        // Inserir os dados na tabela de produtos
        $sql = "INSERT INTO produto (nome, descricao, preco, estoque, fornecedor) VALUES (:nome, :descricao, :preco, :estoque, :fornecedor)";
        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':fornecedor', $fornecedor);

        if ($stmt->execute()) {
            // Se a inserção for bem-sucedida, redirecione para a página de sucesso ou faça algo semelhante
            header("location: produto_criado_sucesso.php");
            exit();
        }
    }

    // Processar a venda aqui...

    // Simulação de uma venda bem-sucedida
    $venda_processada = "Venda processada com sucesso.";

    // Retorna a mensagem de venda processada para o JavaScript
    echo $venda_processada;
?>
