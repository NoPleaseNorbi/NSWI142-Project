<?php
include "database_config/db_config.php";
$connection = mysqli_connect($db_config["server"], $db_config["login"], $db_config["password"], $db_config["database"]);

$articleId = $_GET['id'];

if (isset($_POST['save'])) {
  $article_name = $_POST['article-name'];
  $article_content = $_POST['article-content'];
  $query = "UPDATE articles SET name = '$article_name', content = '$article_content' WHERE id = $articleId;";
  $result = mysqli_query($connection, $query);  
  header("Location: ../articles");
}


$query = "SELECT * FROM articles WHERE id = $articleId";
$result = mysqli_query($connection, $query);
$article = mysqli_fetch_assoc($result);

mysqli_close($connection);
?>

<form method="POST" id="edit-form">
  <table>
    <tr>
      <td><label for="article-name">Name</label></td>
    </tr>
    <tr>
      <td><input type="text" name="article-name" id="article-name" required maxlength="32" value="<?php echo $article['name']; ?>"> </td>
    </tr>
    <tr>
      <td><label for="article-body">Content</label></td>
    </tr>
    <tr>
      <td><textarea id="article-body" name="article-content" required maxlength="1024" rows="20" cols="69"><?php echo $article['content']; ?></textarea></td>
    </tr>
  </table>
  <table id="mytable">
    <tr>
      <td><input type="submit" name="save" value="Save"></td>
      <td><button type="button" id="back_to_index">Back to articles</button></td>
    </tr>
  </table>
</form>

<script>
const backToIndex = document.getElementById('back_to_index');
backToIndex.addEventListener('click', () => {
  window.location.href="../articles"
});
</script>