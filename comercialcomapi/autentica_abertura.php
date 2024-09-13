<?php
    $key = "PortalZ";

    $data=$_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    extract($data);
    $responsavel = $_POST['responsavel'];
    $saldo_abertura = $_POST['saldo_abertura'];
	
    $sql = "INSERT INTO financeiro (data_abertura, responsavel, saldo_abertura, entradas, saidas) VALUES (CURRENT_TIMESTAMP, '$responsavel', '$saldo_abertura', 0.00, 0.00)";

    if ($conexao->query($sql)) {
        header("location: abrir_caixa.php");
    }
?>