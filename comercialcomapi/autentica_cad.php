<?php
    $key = "PortalZ";

    $data = $_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    extract($data);
    $nome = $_POST['edtName'];
    $email = $_POST['edtMail'];
    $senha = $_POST['edtSenha'];
    $senhacripto = base64_encode($senha . '::' . $key);
    $tipo_usuario = $_POST['tipo_usuario'];

    $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
    $rua = isset($_POST['rua']) ? $_POST['rua'] : '';
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
    $uf = isset($_POST['uf']) ? $_POST['uf'] : '';

    $sql = "INSERT INTO usuario (usuNome, usuMail, usuSenha, usuStatus, tipo_usuario, usuCep, usuRua, usuBairro, usuCidade, usuUf) 
            VALUES ('$nome', '$email', '$senhacripto', 'A', '$tipo_usuario', '$cep', '$rua', '$bairro', '$cidade', '$uf')";

    if ($conexao->query($sql)) {
        header("location: login.php");
    }
