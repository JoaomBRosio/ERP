
<?php
    $key = "PortalZ";

    $data=$_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    extract($data);
    $id = $_POST['id'];
    $entradas = $_POST['entradas'];
    $saidas = $_POST['saidas'];
    
	
    $sql = "UPDATE financeiro SET data_fechamento = CURRENT_TIMESTAMP, entradas = '$entradas', saidas = '$saidas' WHERE id = '$id'";
    $sql2 = "UPDATE financeiro SET saldo_fechamento = saldo_abertura + (entradas - saidas) WHERE id = '$id'";

    if ($conexao->query($sql) && $conexao->query($sql2)) {
        header("location: fechamento_caixa.php");
    }
?>
