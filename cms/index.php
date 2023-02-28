<?php
$error_encountered = false;
$page_to_show = "";
$page_with_id = false;

include "database_config/db_config.php";
$connection = mysqli_connect($db_config["server"], $db_config["login"], $db_config["password"], $db_config["database"]);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == "article") {
        if (!isset($_GET['id'])) {
            $error_encountered = true;
            http_response_code(404);
            exit;
        }
        else {
            $page_with_id = true;
            $id = $_GET['id'];
            $page_to_show = "article/article_show.php";
        }
    }
    else if ($page == "article-edit") {
        if (!isset($_GET['id'])) {
            $error_encountered = true;
            http_response_code(404);
            exit;
        }
        else {
            $page_with_id = true;
            $id = $_GET['id'];
            $page_to_show = "article-edit/article_edit.php";
        }
    }
    else if ($page == "articles") {
        $page_to_show = "article-list/article_list.php";
    }
    else {
        $error_encountered = true;
        http_response_code(404);
        exit;
    }
}
else {
    $error_encountered = true;
    http_response_code(404);
    exit;
}

if ($page_with_id) {
    $query = "SELECT * FROM articles WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $article = mysqli_fetch_assoc($result);

    if (!$article) {
        http_response_code(404);
        exit;
    }
}

mysqli_close($connection);

if (!$error_encountered) {
    include "templates/header.php";
    include $page_to_show;
    include "templates/footer.php";
}

?>