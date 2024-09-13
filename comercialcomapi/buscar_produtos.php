<?php
// Incluir a conexão com o banco de dados
$key = "PortalZ";

$data=$_REQUEST;

include_once("config.php");

$conexao = db_connect();
// Realizar a consulta SQL para buscar os produtos
$query = "SELECT id, nome FROM produto";

// Executar a consulta SQL
$resultado = $conexao->query($query);

// Inicializar um array para armazenar os produtos
$produtos = array();

// Loop pelos resultados e adicionar cada produto ao array
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $produtos[] = $row;
}

// Retornar os produtos como JSON
echo json_encode($produtos);
?>
