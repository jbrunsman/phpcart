<?php
require_once "../mysqli_connect.php";
include "top.php";

$i = $_GET['itemid'];
$query = "SELECT * FROM products WHERE id=$i";
$response = mysqli_query($dbc, $query);
$item = mysqli_fetch_assoc($response);
?>

<div class="row">

<?php
if($item) {

    ?>
    <div class="col-md-12">
        <h2><?php echo $item['name'];?></h2>
    </div>
    <div class="col-md-6 col-sm-12">
        <img src="img/<?php echo $item['imglink'];?>" alt="<?php echo $item['name'];?>" class="img-fluid">
    </div>
    <div class="col-md-6 col-sm-12">
        <p><?php echo $item['descript'];?></p>
        <i><?php echo $item['price'];?>

        <form action="update.php" method="post">
            <input type="hidden" name="item" value="<?php echo $item['id'];?>">
            <select name="quant">
                <?php for ($i=1; $i<11; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                } ?>
            </select>
            <input type="submit" value="Add to Cart" class="btn btn-primary">
        </form>

    </div>
    <?php

} else {

    ?>
    <div class="col-md-12">
        <div class="alert alert-danger" role="alert">Item not found</div>
    <?php

}
?>

</div>

<?php
mysqli_close($dbc);
include "bottom.php";
?>