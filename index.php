<?php
require "products.php";
$totalCost = 0;
$cart = json_decode($_COOKIE['cart'], true);

foreach ($cart as $value) { 
	$totalCost += $products[$value]['price'];
}

if (@$_GET['addToCart']) {
	if (!$_COOKIE['cart']) {
		$willBeAdded = [1 => $_GET['addToCart']];
		setcookie("cart", json_encode($willBeAdded));
	} else {
		$cart[count($cart) + 1] = $_GET['addToCart'];
		setcookie("cart", json_encode($cart));
	}
	header('Location:index.php');
}

if (@$_GET['removeFromCart']) {
	if (!empty($cart)) {
		unset($cart[$_GET['removeFromCart']]);
		setcookie("cart", json_encode($cart));
		header('Location:index.php');
	}
}

if (@$_GET['clearCart']) {
	if (isset($_SERVER['HTTP_COOKIE'])) {
	    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
	    foreach($cookies as $cookie) {
	        $parts = explode('=', $cookie);
	        $name = trim($parts[0]);
	        setcookie($name, '', time()-1000);
	        setcookie($name, '', time()-1000, '/');
	    }
	}
	header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>shopping cart</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>products</h1>
	<div class="listing">
		<?php foreach ($products as $key => $value): ?>
			<div class="item">
				<div class="texts">
					<span class="name"><?= $value['name'] ?></span>
					<span class="price">$<?= $value['price'] ?></span>
				</div>
				<a href="?addToCart=<?= $key ?>">Add to cart</a>
			</div>
		<?php endforeach ?>
	</div>

	<hr>

	<div class="heads">
		<h1>cart</h1>
		<h2 style="font-weight:400;">total cost: <b>$<?= $totalCost ?></b> <a href="?clearCart=true" onclick="return confirm('are you sure? if you click ok, we\'ll clear your cart.')">(clear cart)</a></h2>
	</div>
	<div class="listing">
		<?php foreach (json_decode($_COOKIE['cart']) as $key => $value):
			$thisProduct = $products[$value]?>
			<div class="item">
				<div class="texts">
					<span class="name"><?= $thisProduct['name'] ?></span>
					<span class="price">$<?= $thisProduct['price'] ?></span>
				</div>
				<a href="?removeFromCart=<?= $key ?>">x</a>
			</div>
		<?php endforeach ?>
	</div>
</body>
</html>
