<?php
include "../database_config/db_config.php";
$connection = mysqli_connect($db_config["server"], $db_config["login"], $db_config["password"], $db_config["database"]);

$data = json_decode(file_get_contents("php://input"), true);

$articleId = $data['id'];
$likes = $data['likes'];
$dislikes = $data['dislikes'];
$query = "UPDATE articles SET likes_number = $likes, dislikes_number = $dislikes WHERE id = $articleId;";
$result = mysqli_query($connection, $query);  

mysqli_close($connection);