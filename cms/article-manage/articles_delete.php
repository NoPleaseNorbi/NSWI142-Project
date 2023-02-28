<?php
include "../database_config/db_config.php";
$connection = mysqli_connect($db_config["server"], $db_config["login"], $db_config["password"], $db_config["database"]);

$articleId = $_GET['id'];

$query = "DELETE FROM articles WHERE id = $articleId";
$result = mysqli_query($connection, $query);

mysqli_close($connection);
?>