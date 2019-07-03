<table border='1' width='100%'>
    <?php
    define("ROWS", 4);
    define("FROM", 2);
    define("TO", 4);
    
    for ($k = 0; $k < ROWS; $k++){
        echo '<tr>';
        for ($j = FROM; $j < FROM+TO; $j++){
            
            $newj = $j + $k*TO;

            $isPink = 0;
            if ( TO % 2 == 0){
                $isPink = ($newj + $k ) % 2 == 0;
            } else {
                $isPink = ($newj) % 2 == 0;
            }

            echo "<td bgcolor='" . ($isPink ? 'pink' : 'yellow') . "'>";


            for ($i = 1; $i<=9; $i++ ){
                $r = $newj * $i;
                echo "{$newj} x {$i} = {$r}<br>";
            }
            echo '</td>';
        }
        echo '</tr>';
    }
    ?>
</table>