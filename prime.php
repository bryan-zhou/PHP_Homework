<?php

function checkPrime ($num) {
    if ($num == 1) {
        return false;
    }

    for ($i = 2; $i <= $num / 2; $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }

    return true;
}

?>

<table width="100%" border="1" style="border-collapse: collapse">
    <?php
        $n = 10;
        $nVal = 1;
        for ($i = 0; $i < $n; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $n; $j++) {
                if (checkPrime($nVal)) {
                    echo "<td style='color:red'>";
                } else {
                    echo "<td>";
                }
                echo $nVal;
                $nVal++;
                echo "</td>";
            }
            echo "</tr>";
        }
    ?>
</table>