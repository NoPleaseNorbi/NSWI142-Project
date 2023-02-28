<?php
include "../database_config/db_config.php";
$connection = mysqli_connect($db_config["server"], $db_config["login"], $db_config["password"], $db_config["database"]);

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$articleId = intval(time());

$query = "INSERT INTO articles VALUES ('$name', '', $articleId, 0, 0)";
$result = mysqli_query($connection, $query);

mysqli_close($connection);

echo json_encode(['id' => $articleId]);
?>