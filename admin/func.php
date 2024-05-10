

<?php

require "../connection.php"

$type = $con->query("SELECT * FROM products")->num_rows;
                    echo number_format($type);
?>