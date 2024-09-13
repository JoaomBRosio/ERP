<?php
$key = "PortalZ";

$data = $_REQUEST;

include_once("config.php");

$conexao = db_connect();

$response = array('status' => '', 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar os dados do formulário
    $produto_id = $_POST["produto"];
    $quantidade = $_POST["quantidade"];
    $cliente = $_POST["cliente"];

    // Consulta SQL para inserir a venda na tabela de vendas
    $query = "INSERT INTO vendas (produto_id, quantidade, cliente) VALUES (:produto_id, :quantidade, :cliente)";

    // Preparar a consulta SQL
    $stmt = $conexao->prepare($query);

    // Bind dos parâmetros
    $stmt->bindParam(':produto_id', $produto_id);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':cliente', $cliente);

    // Executar a consulta SQL
    try {
        $stmt->execute();
        $response['status'] = 'success';
        $response['message'] = 'Venda processada com sucesso.';
    } catch (PDOException $e) {
        // Capturar a exceção e verificar a mensagem de erro
        $error_message = $e->getMessage();
        if (strpos($error_message, 'Estoque insuficiente') !== false) {
            $response['status'] = 'error';
            $response['message'] = 'Estoque insuficiente para o produto.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Erro ao processar a venda: ' . $error_message;
        }
    }
}

// Retornar a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
