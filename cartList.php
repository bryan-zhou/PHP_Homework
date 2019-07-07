<?php
    include_once 'sql.php';
    include_once 'Cart.php';
    session_start();

    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    } else {
        $cart = new Cart;
    }

    if (count($cart->getList()) > 0) {
        // select * from product
        $items = $cart->getList();
        $itemsId = array_keys($items);
        $itemsString = implode(",",$itemsId);

        $sql = "select * from product where id in ({$itemsString})";
        $result = $mysqli->query($sql);
    } else {
        echo 'Cart is empty<br>';
        echo "<a href='productList.php'>Go To Product</a>";
        return 0;
    }

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<style>
td {
    text-align: center;
}
</style>

<a href='productList.php'>Go To Product</a>
<hr />

<table border="1" width="100%">
    <tr>
        <th>id</th>
        <th>pname</th>
        <th>price</th>
        <th>Qty</th>
        <th>Sum</th>
    </tr>
    <?php
        while ( $product = $result->fetch_object()){
            $sum = $product->price * $items[$product->id];
            echo "<tr id='item{$product->id}'>";
            echo "<td>{$product->id}</td>";
            echo "<td><a href='showPImage.php?id={$product->id}'>{$product->pname}</a></td>";
            echo "<td id='price{$product->id}'>{$product->price}</td>";
            echo "<td>";
            echo "<input type='number' id='qty{$product->id}' onchange='changeQty({$product->id});' min='1' value='{$items[$product->id]}'>";
            echo "</td>";
            echo "<td id='sum{$product->id}'>{$sum}</td>";
            echo "<td style='text-align: left;'>";
            echo "<input type='button' onclick='removeItem({$product->id});' value='Delete'>";
            echo "</td>";
            echo '</tr>';
        }
    ?>

</table>

<script>

function changeQty(id) {
    $.ajax({
        type :"GET",
        url  : "doCart.php",
        data : {
            flag: 'change', 
            pid: id,
            qty: $('#qty' + id).val(),
        },
        dataType: "text",
        success : function(msg) {
            let data = JSON.parse(msg);
            let price = parseInt($('#price' + data.id).text());
            let qty = parseInt(data.qty);
            
            $('#sum' + data.id).text(price*qty);
            
        }
    })
}

function removeItem(id) {
    $.ajax({
        type :"GET",
        url  : "doCart.php",
        data : {
            flag: 'delete', 
            pid: id,
        },
        dataType: "text",
        success : function(msg) {
            let data = JSON.parse(msg);
            $('#item' + data.id).remove();
            
        }
    })
}


</script>