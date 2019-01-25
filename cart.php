<?php
require_once "../mysqli_connect.php";
include "top.php";

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
        echo '<div class="alert alert-danger" role="alert">Invalid Quantity</div>';
    }
}

if (array_key_exists('cart', $_SESSION) && !empty($_SESSION['cart'])) {

    ksort($_SESSION['cart']);
    $carted_items = '';
    $sub_total = 0;
    foreach($_SESSION['cart'] as $key => $value) {
        $carted_items .= $key . ", ";
        // list of carted item IDs for sql query
    }
    $carted_items = substr($carted_items, 0, -2);
    $query = "SELECT id, name, price FROM products where id in ($carted_items)";
    $response = mysqli_query($dbc, $query);

    ?>
    <table>
        <tr>
            <th>Item</th>
            <th>Amount</th>
            <th>Price</th>
        </tr>
    <?php

    while ($info = mysqli_fetch_assoc($response)) {
        $quantity = $_SESSION['cart'][$info['id']]; ?>
        <tr>
            <td class="itemname">
                <?php echo $info['name'];?>
            </td>
            <td>
                <form action="cart.php" method="post">
                    <input type="text" name="quant" value="<?php echo $quantity;?>" class="priceinput">
                    <input type="hidden" name="item" value="<?php echo $info['id'];?>">
                    <input type="hidden" name="replace" value="1">
                    <input type="submit" value="update" class="btn btn-outline-secondary btn-sm">
                </form>
            </td>
            <td class="price">
                <?php echo money_format('%i', $info['price']);?>
            </td>
        </tr>
        <?php
        $sub_total += $info['price'] * $quantity;
    }
    ?>
        <tfoot>
            <tr>
                <td></td>
                <td>
                    Subtotal
                </td>
                <td class="price">
                    <?php echo money_format('%i', $sub_total);?>
                </td>
            </tr>
        </tfoot>
    </table>

<?php
} else {
    echo '<div class="alert alert-info" role="alert">Your cart is empty</div>';
}
?>

<br><br>

<?php
echo "POST: ";
if ($_POST) { echo var_dump($_POST); }
echo "<br>";
echo "SESSION: ";
if (array_key_exists('cart', $_SESSION)) { echo var_dump($_SESSION['cart']); }
echo "<br>";

echo "<br>";
?>

<?php
mysqli_close($dbc);
include "bottom.php";

?>