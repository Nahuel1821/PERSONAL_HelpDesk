<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Font Awesome Icons</title>
	<link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.css">
	
</head>
<body>

<?php
$css = file_get_contents('public/css/lib/font-awesome/font-awesome.css'); // Reemplace "path/to/font-awesome.css" con la ruta real al archivo font-awesome.css en su proyecto

preg_match_all('/\.fa-(.*?):before/', $css, $matches);
$icons = $matches[1];

echo '<ul>';
foreach ($icons as $icon) {
  echo '<li>fa fa-' . $icon . ' <i class="fa fa-'. $icon .'""></i></li>';
}
echo '</ul>';


?>



</body>
</html>
