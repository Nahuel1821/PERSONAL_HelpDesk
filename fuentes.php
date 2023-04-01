<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Font Awesome Icons</title>
	<link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.min.css">
	<style>
		ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		li {
			display: inline-block;
			margin: 10px;
			font-size: 30px;
		}
	</style>
</head>
<body>
	<ul>
		<?php
			//$icons = file_get_contents("public/fonts/fa-solid-900.svg"); // Cambia el nombre del archivo según la colección de iconos que quieras mostrar
			$icons = file_get_contents("public/fonts/fontawesome-webfont.eot"); // Cambia el nombre del archivo según la colección de iconos que quieras mostrar
			preg_match_all('/glyph-name="(.*?)"/', $icons, $matches);
			foreach ($matches[1] as $icon) {
				echo '<li><i class="fas fa-' . $icon . '"></i> ' . $icon . '</li>'; // Cambia "fas" por el prefijo correspondiente a la colección de iconos que quieras mostrar
			}
		?>
	</ul>
</body>
</html>
