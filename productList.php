<?php
    include_once 'sql.php';
    include_once 'Cart.php';
    session_start();

    $page = isset($_GET['page'])?$_GET['page']:1;
    $rpp = 8;   // row per page
    $start = ($page-1) * $rpp;

    // select * from product
    $sql = "select * from product limit {$start},{$rpp}";
    $result = $mysqli->query($sql);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function confirmDelete(pname){
        return confirm('Delete ' + pname + "?");
    }
</script>

<a href='cartList.php'>Go To Cart</a>
<hr />
<table border="1" width="100%">
    <tr>
        <th>id</th>
        <th>pname</th>
        <th>price</th>
        <th></th>
    </tr>
    <?php
        while ( $product = $result->fetch_object()){
            echo '<tr>';
            echo "<td>{$product->id}</td>";
            echo "<td><a href='showPImage.php?id={$product->id}'>{$product->pname}</a></td>";
            echo "<td>{$product->price}</td>";
            echo "<td>";
            echo "<input type='button' onclick='addToCart({$product->id})' value='Add'>";
            echo "</td>";
            echo '</tr>';
        }
    ?>

</table>
<br>
<br>

<script>

function addToCart(id) {
    $.ajax({
        type :"GET",
        url  : "doCart.php",
        data : {
            flag: 'add', 
            pid: id,
        },
        dataType: "text",
        success : function(msg) {
            alert(msg);
        }
    })
}


</script>
