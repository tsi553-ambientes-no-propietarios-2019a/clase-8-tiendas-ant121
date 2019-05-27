<?php 
include('common/utils.php');
if($_GET) {
	if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $tienda = $_GET['tienda'];
	}
}
$productosOtraTienda = getProductosOtrasTiendas($conn,$id);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Otras Tiendas</title>
</head>
<body>
    <div><a href="home.php">Atras</a></div>
    <h1>Usuario: <?php echo $_SESSION['user']['username']; ?></h1>
    <h2>Tienda Actual: <?php echo $_SESSION['user']['store']; ?></h2>
    <FONT SIZE=4><p><b>Productos de la tienda:</b> <?php echo $tienda ?></p></font>
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
			<?php foreach ($productosOtraTienda as $p) { ?>
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


</body>
</html>