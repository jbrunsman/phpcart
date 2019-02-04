<?php
require_once "../mysqli_connect.php";
include "top.php";
?>

<div class="row">

<?php

// Loop through all items in the database and display them

$query = "SELECT * FROM products";
$response = mysqli_query($dbc, $query);
while($r = mysqli_fetch_assoc($response)){ ?>
    <div class = "col-md-4 col-sm-6 mb-5">
        <h3><?php echo $r['name'];?></h3>
        <a href="info.php?itemid=<?php echo $r['id'];?>">
            <img src="img/<?php echo $r['imglink'];?>" alt="<?php echo $r['name'];?>" class="img-fluid">
        </a>
        <div>
            <p><?php echo $r['descript'];?></p>
            <i>$<?php echo $r['price'];?></i>
            <form action="update.php" method="post">
                <input type="hidden" name="item" value="<?php echo $r['id'];?>">
                <input type="hidden" name="quant" value="1">
                <input type="submit" value="Add to Cart" class="btn btn-outline-primary btn-sm">
            </form>
        </div>
    </div>
<?php } ?>

</div>

<?php
mysqli_close($dbc);
include "bottom.php";
?>