<?php
$poker = range(0,51);

for ($i = count($poker)-1; $i > 0; $i--){
    $rand = rand(0, $i+1);
    $temp = $poker[$rand];
    $poker[$rand] = $poker[$i];
    $poker[$i] = $temp;
}


$players = [[],[],[],[]];
foreach($poker as $i => $card){
    $players[$i%4][(int)($i/4)] = $card;
}

// echo "<xmp>" . print_r($poker, true) . "</xmp>";
?>

<table border="1" width="100%">
    <?php
        $suits = array("&spades;","<font color='red'>&hearts;</font>",
            "<font color='red'>&diams;</font>","&clubs;");
        $values = array('A',2,3,4,5,6,7,8,9,10,'J','Q','K');
        foreach($players as $player){
            sort($player);
            echo '<tr>';
            foreach($player as $card){
                echo "<td>";
                echo "{$suits[(int)($card/13)]}{$values[$card%13]}";
                echo "</td>";
            }
            echo '</tr>';
        }
    ?>
</table>