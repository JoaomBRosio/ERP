<?php
	include_once("cabec.php")
?>
<head>
	<style>
		.rick {
			display: none;
		}
	</style>
</head>
	<p>&nbsp;</p>

	<h2 align="center">Sobre o Sistema</h2>

	<p>&nbsp;</p>
	<p>&nbsp;</p>

	<h3 align="center">Sistema desenvolvido por João Ambrósio e João Sgobin</h3>

	<p>&nbsp;</p>

	<!-- <h3 align="center" href="mailto:jgadgaambrosio@gmail.com">Contate-me</h3> -->
	<center>	
		<a align="center" href="mailto:jgadgaambrosio@gmail.com">jgadgaambrosio@gmail.com | dev.ssgobin@gmail.com</a>
	</center>

	<button id="rick" onclick="sound()">?</button>

	<div style="text-align: center;" class="rick">
		<img src="rickroll.gif" alt="">
		</div>

		<script>
			function sound() {

				document.querySelector(".rick").style.display = "inline";
				document.getElementById("rick").style.display = "none";

				var audio = new Audio('rickroll.mp3');
				audio.volume = 1;
				audio.play();
			}

		</script>

<?php
	include_once("rodape.php");
?>