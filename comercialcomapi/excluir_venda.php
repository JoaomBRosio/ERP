<?php
	$key = "PortalZ";

    $data=$_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    if(isset($_GET['id'])) {
        $venda_id = $_GET['id'];
            
            // Query para excluir a venda
            $query = "DELETE FROM vendas WHERE id = :id";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':id', $venda_id);
            
            // Executa a query
            $stmt->execute();
            
            header("location: vendas.php");
}
?>