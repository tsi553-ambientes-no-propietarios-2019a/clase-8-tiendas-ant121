<?php 
session_start();


$conn = new mysqli('localhost', 'root', '', 'tiendas');

if($conn->connect_error) {
	echo 'Existió un error en la conexión ' . $conn->connect_error;
	exit;
}

function redirect($url) {
	header('Location: ' . $url);
	exit;
}

function getProducts($conn) {
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT *
		FROM product
		WHERE user='$user_id'";

		$res = $conn->query($sql);

		if ($conn->error) {
			header('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$products = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$products[] = $row;
			}
		}

		return $products;
}
function getTiendas($conn) {
	$user_id = $_SESSION['user']['id'];

	$sql = "SELECT * FROM user WHERE id !='$user_id'";

		$res = $conn->query($sql);

		if ($conn->error) {
			header('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$tiendas = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$tiendas[] = $row;
			}
		}

		return $tiendas;
}

function getProductosOtrasTiendas($conn,$idOtraTienda) {

	$sql = "SELECT * FROM product WHERE user ='$idOtraTienda'";

		$res = $conn->query($sql);

		if ($conn->error) {
			header('../home.php?error_message=Ocurrió un error: ' . $conn->error);
		}

		$products2 = [];
		if($res->num_rows > 0) {
			while ($row = $res->fetch_assoc()) {
				$products2[] = $row;
			}
		}

		return $products2;
}

$public_pages = [
	'/tiendas/index.php', 
	'/tiendas/php/process_login.php',
	'/tiendas/registration.php',
	'/tiendas/php/process_registration.php'
];

if ( !isset($_SESSION['user']) && !in_array( $_SERVER['SCRIPT_NAME'], $public_pages)) {
	header($_SERVER["HTTP_HOST"] . '/tiendas/index.php');
} elseif( 
	isset($_SESSION['user']) && (
	$_SERVER['SCRIPT_NAME'] == '/tiendas/index.php' || 
	$_SERVER['SCRIPT_NAME'] == '/tiendas/registration.php')) {
	header($_SERVER["HTTP_HOST"] . '/tiendas/home.php');
}

