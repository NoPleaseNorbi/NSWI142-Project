<?php
header("Content-Type: application/json");
include "../database_config/db_config.php";
$connection = mysqli_connect($db_config["server"], $db_config["login"], $db_config["password"], $db_config["database"]);
$query = "SELECT * FROM articles ORDER BY likes_number - dislikes_number DESC";
$result = mysqli_query($connection, $query);
$all_page = mysqli_fetch_all($result, MYSQLI_ASSOC);  
$to_js = json_encode($all_page);
mysqli_close($connection);
print($to_js);