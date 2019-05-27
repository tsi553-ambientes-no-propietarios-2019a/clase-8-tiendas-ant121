<?php 
include('common/utils.php');
//print_r($_SESSION['user']);

$products = getProducts($conn);
$tiendas = getTiendas($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
</head>
<body>
	<div><a href="php/logout.php">Cerrar sesión</a></div>

	<h1>Bienvenido <?php echo $_SESSION['user']['username']; ?></h1>
	<h2>Tienda: <?php echo $_SESSION['user']['store']; ?></h2>

	<a href="new_product.php">Añadir producto</a>

	<table>
		<thead>
			<tr>
				<th>Código</th>
				<th>Nombre</th>
				<th>Tipo</th>
				<th>Stock</th>
				<th>Precio</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($products as $p) { ?>
				<tr>
					<td><?php echo $p['code'] ?></td>
					<td><?php echo $p['name'] ?></td>
					<td><?php echo $p['type'] ?></td>
					<td><?php echo $p['stock'] ?></td>
					<td><?php echo $p['price'] ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<h2>Otras tiendas</h2>
	<table>
		<thead>
			<tr>
				<th>Tienda</th>
				<th>Accion</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tiendas as $p) { ?>
				<tr>
					<td><?php echo $p['store'] ?></td>
					<td><a href="articulos.php?id=<?php echo $p['id']?>&tienda=<?php echo $p['store']?>">Articulos</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>