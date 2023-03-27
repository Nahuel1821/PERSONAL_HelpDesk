<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<title>FFyB | Mantenimiento Usuario</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Mantenimiento Departamentos</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="http://localhost:90/PERSONAL_HelpDesk/view/Home/">Home</a></li>
								<li class="active">Mantenimiento Departamentos</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Departamento</button>
				<table id="depto_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 5%;">id</th>
							<th style="width: 75%;">nombre</th>
							<th class="text-center" style="width: 5%;"></th>
							<th class="text-center" style="width: 5%;" >estado</th>
							<th class="text-center" style="width: 5%;"></th>
							<th class="text-center" style="width: 5%;"></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("modaldepartamentos.php");?>
	<?php require_once("modaldeptoUser.php");?>

	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="mntdepto.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>