<?php
require_once "../mysqli_connect.php";
include "top.php";

if (array_key_exists('cart', $_SESSION) && !empty($_SESSION['cart'])) {

    ksort($_SESSION['cart']);
    $carted_items = '';
    $total = 0;
    foreach($_SESSION['cart'] as $key => $value) {
        $carted_items .= $key . ", ";
        // list of carted item IDs for sql query
    }
    $carted_items = substr($carted_items, 0, -2);
    $query = "SELECT id, name, price FROM products where id in ($carted_items)";
    $response = mysqli_query($dbc, $query);

    echo '<table>';
    while ($info = mysqli_fetch_assoc($response)) {
        $quantity = $_SESSION['cart'][$info['id']]; ?>
        <tr>
            <td>
                <?php echo $info['name'];?>
            </td>
            <td>
                <?php echo $quantity;?>
            </td>
            <td>
                <?php echo $info['price'];?>
            </td>
        </tr>
        <?php
        $total += $info['price'] * $quantity;
    }
    ?>
    <tr>
        <td>
            Total
        </td>
        <td></td>
        <td>
            <?php echo $total;?>
        </td>
    <?php
    echo '</table>';
} else {
    echo '<div class="alert alert-danger" role="alert">Checkout Error - no products in cart!</div>';
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