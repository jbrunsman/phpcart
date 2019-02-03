<?php
require_once "../mysqli_connect.php";
include "top.php";

if (array_key_exists('cart', $_SESSION) && !empty($_SESSION['cart']) && $_POST['checkout_valid']) {

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
                <?php echo $quantity;?>
            </td>
            <td class="price">
                <?php echo money_format('%i', $info['price']);?>
            </td>
        </tr>
        <?php
        $sub_total += $info['price'] * $quantity;
    }
    session_unset();
    $total = $sub_total;
    ?>
        <tfoot>
            <tr>
                <td></td>
                <td>
                    Total
                </td>
                <td class="price">
                    <?php echo money_format('%i', $total);?>
                </td>
            </tr>
        </tfoot>
    </table>

<?php
} else {
    echo '<div class="alert alert-danger" role="alert">Checkout error, please try again</div>';
}
?>

<br><br>

<?php

/* for testing
echo "POST: ";
if ($_POST) { echo var_dump($_POST); }
echo "<br>";
echo "SESSION: ";
if (array_key_exists('cart', $_SESSION)) { echo var_dump($_SESSION['cart']); }
echo "<br>";

echo "<br>";
*/

mysqli_close($dbc);
include "bottom.php";

?>