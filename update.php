<?php

session_start();

$maxItems = 20;

if (array_key_exists('replace', $_POST)) {
    $newQuant = $_POST['quant'];
} else {
    $newQuant = $_POST['quant'] + $_SESSION['cart'][$_POST['item']];
}

if (is_numeric($_POST['quant']) && $newQuant <= $maxItems) {
    $posted_quant = floor($_POST['quant']);
    if (array_key_exists('replace', $_POST)) {
        $_SESSION['cart'][$_POST['item']] = $posted_quant;
    } else {
        $_SESSION['cart'][$_POST['item']] += $posted_quant;
    }
    if ($_SESSION['cart'][$_POST['item']] <= 0) {
        unset($_SESSION['cart'][$_POST['item']]);
    }
} else {
    $_SESSION['baditem'] = true;
}

header("Location: cart.php");

?>