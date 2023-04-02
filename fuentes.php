<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Font Awesome Icons</title>
	<link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.css">
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
			//../../../fonts/fontawesome-webfont.svg
			//$icons = file_get_contents("public/fonts/fa-solid-900.svg"); // Cambia el nombre del archivo según la colección de iconos que quieras mostrar
			//$icons = file_get_contents("public/fonts/startui.svg"); // Cambia el nombre del archivo según la colección de iconos que quieras mostrar
			$icons = file_get_contents("public/fonts/Proxima_Nova_Bold.svg");
			//$icons = file_get_contents("public/fonts/fontawesome-webfont.svg");

			preg_match_all('/glyph-name="(.*?)"/', $icons, $matches);
			//preg_match_all('/glyph unicode="(.*?)"/', $icons, $matches);

			
			foreach ($matches[1] as $icon) {
				echo '<li><i class="fas fa-' . $icon . '"></i> ' . $icon . '</li>'; // Cambia "fas" por el prefijo correspondiente a la colección de iconos que quieras mostrar

			}
		?>
	</ul>
</body>
</html>
