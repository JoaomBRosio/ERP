<?php
function db_connect()
{

	$host = "localhost";
	$port = 5432;
	$dbname = "fatec";
	$user = "postgres";
	$password = "pg482";

	try {
		$conexao = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conexao;
	} catch (PDOException $e) {
		die("Erro na conexão: " . $e->getMessage());
	}
}

function ConverteData($data)
{
	if (strstr($data, "/")) //verifica se tem a barra /
	{
		$d = explode("/", $data); //tira a barra
		$rstData = "$d[2]-$d[1]-$d[0]"; //separa as datas $d[2] = ano $d[1] = mes etc...
		return $rstData;
	} elseif (strstr($data, "-")) {
		$d = explode("-", $data);
		$rstData = "$d[2]/$d[1]/$d[0]";
		return $rstData;
	} else {
		return "Data inválida";
	}
}
