<!doctype html>
<?php

if (!isset($_COOKIE['idioma'])) {
	$_COOKIE['idioma'] = 'pt_BR';
}

if (file_exists(strtolower('./idioma/' . $_COOKIE['idioma']) . '.lang')) {
	$lng = parse_ini_file('./idioma/' . strtolower($_COOKIE['idioma']) . '.lang');
} else {
	$lng = parse_ini_file('./idioma/pt_BR.lang');
}
?>

<html lang="pt-br">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Language" content="pt-br">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

	<title>Jaos - ERP</title>

	<link rel="shortcut icon" type="imagex/png" href="./icones/jaos_main.png">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>

	<style>
		* {
			font-family: "Montserrat", sans-serif;
		}
		.cor_fundo {
			background-color: #EFEBE3;
		}

		.cor_texto {
			color: #000;
		}

		.cor_texto:link {
			color: #000;
		}

		.cor_texto:hover {
			color: #000;
		}

		.cor_texto:visited {
			color: #000;
		}

		.col-12 {
			display: none;
		}



		.cor_barra {
			background-color: #2536A3;
			color: #FFF;
		}

		.cor_barra_nav:link {
			background-color: #0B1557;
			color: #FFF;
		}

		.cor_barra_nav:hover {
			background-color: #0B1557;
			color: #FFF;
		}

		.cor_barra_nav:visited {
			background-color: #0B1557;
			color: #FFF;
		}



		.cor_texto_barra {
			color: #FFF;
		}

		.cor_texto_barra:link {
			color: #FFF;
		}

		.cor_texto_barra:visited {
			color: #FFF;
		}

		.cor_texto_barra:hover {
			color: #FFF;
		}

		.form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
	</style>

	<?php
	// Force HTTPS for security
	/*
			if($_SERVER["HTTPS"] != "on") 
			{
				$pageURL = "Location: https://";
				if ($_SERVER["SERVER_PORT"] != "80") 
				{
					$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
				} 
				else 
				{
					$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
				}
				header($pageURL);
			}
			*/
	?>
</head>

<body class="cor_fundo">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark cor_barra">
			<div class="container-fluid">
				<img src="./icones/jaos_main.png" alt="Jaos Logo" width="50px" height="50px">
				<a class="navbar-brand" href="./" style="margin-left: 10px;">Jaos - ERP</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarDropdown">
					<ul class="navbar-nav">
						<li class="nav-item"><a class="nav-link active" href="./">Home</a></li>

						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle active" href="#" id="navbarMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo $lng['cadastro']; ?>
							</a>

							<?php
								//if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'adm') {
							?>
								<ul class="dropdown-menu" aria-labelledby="navbarMenuLink">
									<li><a class="dropdown-item" href="cadastro.php"><?php echo $lng['pessoa']; ?></a></li>
									<li><a class="dropdown-item" href="produto.php"><?php echo $lng['produto']; ?></a></li>
									<li><a class="dropdown-item" href="listaprodutos.php"><?php echo 'Lista produtos'; ?></a></li>
								</ul>
							<?php
								//}
							?>
						</li>


						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle active" href="#" id="navbarMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo $lng['financeiro']; ?>
							</a>

							<ul class="dropdown-menu" aria-labelledby="navbarMenuLink">
								<li><a class="dropdown-item" href="abrir_caixa.php"><?php echo $lng['aberturaCaixa']; ?></a></li>
								<li><a class="dropdown-item" href="fechamento_caixa.php"><?php echo $lng['fechamentoCaixa']; ?></a></li>
								<li><a class="dropdown-item" href="caixas.php"><?php echo "Ver caixas"; ?></a></li>
							</ul>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle active" href="#" id="navbarMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo $lng['comercial']; ?>
							</a>

							<ul class="dropdown-menu" aria-labelledby="navbarMenuLink">
								<li><a class="dropdown-item" href="vendas.php"><?php echo $lng['vendas']; ?></a></li>
								<li><a class="dropdown-item" href="balcao.php"><?php echo $lng['balcao']; ?></a></li>
							</ul>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle active" href="#" id="navbarMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo $lng['sistema']; ?>
							</a>

							<ul class="dropdown-menu" aria-labelledby="navbarMenuLink">
								<li><a class="dropdown-item" href="sobre.php"><?php echo $lng['sobreSistema']; ?></a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="desconectar.php"><?php echo $lng['sair']; ?></a></li>
							</ul>
						</li>

						<?php
						if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
						} else {
						?>
							<li class="nav-item">
								<a class="nav-link active" href="login.php">Login</a>
							</li>
						<?php
						}
						?>

					</ul>
				</div>
			</div>

			<div>
				<a href="idioma.php"><img src="./icones/<?php echo $_COOKIE['idioma']; ?>.png" width="40px"></a>
			</div>

			<form action="desconectar.php" class="form-inline mr-2 col-lg-2">
				<span class="cor_texto_barra">
					<?php
					if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
						echo '&nbsp;&nbsp;' . $lng['usuario'] . ': ' . $_SESSION['usuNome'];
					?>
						<button class="btn btn-outline-light" type="submit"><?php echo $lng['sair']; ?></button>
					<?php
					} else {
						echo "&nbsp;&nbsp;" . $lng['desconectado'] . "&nbsp;&nbsp;";
					}
					?>
				</span>
			</form>
		</nav>
	</header>