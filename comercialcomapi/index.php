<?php
	require_once("verifica.php");

	include_once("cabec.php");

	include_once("config.php");

?>

<?php

$conexao = db_connect();
$query = "SELECT tipo_usuario FROM usuario WHERE usucodigo = :usuCodigo";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':usuCodigo', $_SESSION['usuCodigo'], PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $tipo_usuario = $resultado['tipo_usuario'];
    $_SESSION['tipo_usuario'] = $tipo_usuario;
}

?>
	<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrQkz7B2Xbq0ZG3mFNnmrzl19p6lUg1qkGhPviLjBZXf7I22vCDuNCb+p3KwzEY7ZoAIA5V6JQ0QMiwbTg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<style>
			.mae {
				display: flex;
				justify-content: center;
			}
			#wifi-loader {
				--background: #62abff;
				--front-color: #4f29f0;
				--back-color: #c3c8de;
				--text-color: #414856;
				width: 64px;
				height: 64px;
				border-radius: 50px;
				position: relative;
				display: flex;
				justify-content: center;
				align-items: center;
				}

				#wifi-loader svg {
				position: absolute;
				display: flex;
				justify-content: center;
				align-items: center;
				}

				#wifi-loader svg circle {
				position: absolute;
				fill: none;
				stroke-width: 6px;
				stroke-linecap: round;
				stroke-linejoin: round;
				transform: rotate(-100deg);
				transform-origin: center;
				}

				#wifi-loader svg circle.back {
				stroke: var(--back-color);
				}

				#wifi-loader svg circle.front {
				stroke: var(--front-color);
				}

				#wifi-loader svg.circle-outer {
				height: 86px;
				width: 86px;
				}

				#wifi-loader svg.circle-outer circle {
				stroke-dasharray: 62.75 188.25;
				}

				#wifi-loader svg.circle-outer circle.back {
				animation: circle-outer135 1.8s ease infinite 0.3s;
				}

				#wifi-loader svg.circle-outer circle.front {
				animation: circle-outer135 1.8s ease infinite 0.15s;
				}

				#wifi-loader svg.circle-middle {
				height: 60px;
				width: 60px;
				}

				#wifi-loader svg.circle-middle circle {
				stroke-dasharray: 42.5 127.5;
				}

				#wifi-loader svg.circle-middle circle.back {
				animation: circle-middle6123 1.8s ease infinite 0.25s;
				}

				#wifi-loader svg.circle-middle circle.front {
				animation: circle-middle6123 1.8s ease infinite 0.1s;
				}

				#wifi-loader svg.circle-inner {
				height: 34px;
				width: 34px;
				}

				#wifi-loader svg.circle-inner circle {
				stroke-dasharray: 22 66;
				}

				#wifi-loader svg.circle-inner circle.back {
				animation: circle-inner162 1.8s ease infinite 0.2s;
				}

				#wifi-loader svg.circle-inner circle.front {
				animation: circle-inner162 1.8s ease infinite 0.05s;
				}

				#wifi-loader .text {
				position: absolute;
				bottom: -40px;
				display: flex;
				justify-content: center;
				align-items: center;
				text-transform: lowercase;
				font-weight: 500;
				font-size: 14px;
				letter-spacing: 0.2px;
				}

				#wifi-loader .text::before, #wifi-loader .text::after {
				content: attr(data-text);
				}

				#wifi-loader .text::before {
				color: var(--text-color);
				}

				#wifi-loader .text::after {
				color: var(--front-color);
				animation: text-animation76 3.6s ease infinite;
				position: absolute;
				left: 0;
				}

				@keyframes circle-outer135 {
				0% {
					stroke-dashoffset: 25;
				}

				25% {
					stroke-dashoffset: 0;
				}

				65% {
					stroke-dashoffset: 301;
				}

				80% {
					stroke-dashoffset: 276;
				}

				100% {
					stroke-dashoffset: 276;
				}
				}

				@keyframes circle-middle6123 {
				0% {
					stroke-dashoffset: 17;
				}

				25% {
					stroke-dashoffset: 0;
				}

				65% {
					stroke-dashoffset: 204;
				}

				80% {
					stroke-dashoffset: 187;
				}

				100% {
					stroke-dashoffset: 187;
				}
				}

				@keyframes circle-inner162 {
				0% {
					stroke-dashoffset: 9;
				}

				25% {
					stroke-dashoffset: 0;
				}

				65% {
					stroke-dashoffset: 106;
				}

				80% {
					stroke-dashoffset: 97;
				}

				100% {
					stroke-dashoffset: 97;
				}
				}
		</style>
	</head>
	<p>&nbsp;</p>

	<h2 align="center" class="cor_texto">Jaos - ERP</h2>
	<h3 align="center" class="cor_texto">Sistema em manutenção!</h3>
	<h2>&nbsp;</h2>
	<h2>&nbsp;</h2>
	<h2>&nbsp;</h2>
	<h2>&nbsp;</h2>
	<h2>&nbsp;</h2>
	<div class="mae">
		<div id="wifi-loader">
			<svg class="circle-outer" viewBox="0 0 86 86">
				<circle class="back" cx="43" cy="43" r="40"></circle>
				<circle class="front" cx="43" cy="43" r="40"></circle>
				<circle class="new" cx="43" cy="43" r="40"></circle>
			</svg>
			<svg class="circle-middle" viewBox="0 0 60 60">
				<circle class="back" cx="30" cy="30" r="27"></circle>
				<circle class="front" cx="30" cy="30" r="27"></circle>
			</svg>
			<svg class="circle-inner" viewBox="0 0 34 34">
				<circle class="back" cx="17" cy="17" r="14"></circle>
				<circle class="front" cx="17" cy="17" r="14"></circle>
			</svg>
		</div>
	</div>
<?php
	include_once("rodape.php");
?>