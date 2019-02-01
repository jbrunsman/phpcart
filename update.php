<?php

session_start();

if ($_POST) {
    if (is_numeric($_POST['quant']) && $_POST['quant'] < 20) {
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
}

header("Location: cart.php");

?>