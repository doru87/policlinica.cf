<?php
define ('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','policlinica');

$conexiune = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if(!$conexiune){
    die (mysqli_error($conexiune));
}
?>