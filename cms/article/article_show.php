<?php
include "./database_config/db_config.php";
$connection = mysqli_connect($db_config["server"], $db_config["login"], $db_config["password"], $db_config["database"]);

if (isset($_POST['back_to_index'])) {
  header("Location: ../articles");
}

$articleId = $_GET['id'];

if (isset($_POST['to_edit'])) {
  header("Location: ../article-edit/" . $articleId);
}


$query = "SELECT * FROM articles WHERE id = $articleId";
$result = mysqli_query($connection, $query);
$article = mysqli_fetch_assoc($result);

?>
<table>
  <tr>
    <td rowspan="2"><h3><?php echo $article['name'] ?></h3></td>
    <td><button onclick="likeclick()" id="likeclick">&#x21e7;</button></td>
    <td><button onclick="dislikeclick()" id="dislikeclick">&#x21e9;</button></td>
  </tr>
  <tr>
    <td><p id="l-counter"><?php echo $article['likes_number']?></p></td>
    <td><p id="d-counter"><?php echo $article['dislikes_number']?></p></td>
  </tr>
</table>
<p><?php echo $article['content'] ?></p>

<form method="post">
  <table id="buttons">
    <tr>
        <td><input type="submit" name="back_to_index" value="Back to articles"></td>
        <td><input type="submit" name="to_edit" value="Edit"></td>
    </tr>
  </table>
</form>

<script>
  function sendData(likes_number, dilikes_number) {
    var data = {
        likes: likes_number,
        dislikes: dilikes_number,
        id: <?php echo $articleId ?>
    };

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../article-manage/articles_update_likes.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
}
  var lClicks = parseInt(document.getElementById("l-counter").innerHTML);
  var dClicks = parseInt(document.getElementById("d-counter").innerHTML)
  function dislikeclick() {
    dClicks += 1;
    document.getElementById("d-counter").innerHTML = dClicks;
    document.getElementById("likeclick").disabled = true;
    document.getElementById("dislikeclick").disabled = true;
    sendData(lClicks, dClicks);
  }
  function likeclick() {
    
    lClicks += 1;
    document.getElementById("l-counter").innerHTML = lClicks;
    document.getElementById("likeclick").disabled = true;
    document.getElementById("dislikeclick").disabled = true;
    sendData(lClicks, dClicks);
  }
</script>
