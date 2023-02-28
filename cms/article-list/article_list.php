<table id="top_table">
  <tr id="article_header">
    <td><h4 id="article_head">Article list</h4></td>
    <td><h4 id="counter"></h4></td>
  </tr>
</table>

<table id="mytable">

</table>

<table id="buttons">
  <tr>
    <td><button id="prev-button">Previous</button></td>
    <td><button id="next-button">Next</button></td>
    <td><button id="create-article-button">Create article</button></td>
  </tr>
</table>


<dialog id="create-article-dialog" style="display: none;">
  <form id="create-article-form">
      <table id="article-table">
        <tr>
          <td><label for="article-name">Name: </label></td>
          <td><input type="text" id="article-name" maxlength="32" placeholder="Article name"required/></td>
        </tr>
        <tr>
          <td><button type="button" id="create-article-cancel">Cancel</button></td>
          <td><button type="submit" id="create-article-submit" disabled>Create</button></td>
        </tr>
      </table>
  </form>
</dialog>

<?php
$content = file_get_contents('https://webik.ms.mff.cuni.cz/~14569027/cms/article-manage/articles_get.php');
?>

<script>
  var obj = JSON.parse('<?= $content ?>'.replace(/[\r\n]/g, ''));
</script>
<script type="text/javascript" src="scripts/table_control.js"></script>

<script type="text/javascript" src="scripts/create_article_controller.js"></script>
