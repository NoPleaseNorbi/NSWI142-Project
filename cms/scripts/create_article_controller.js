const createArticleButton = document.getElementById('create-article-button');
const createArticleDialog = document.getElementById('create-article-dialog');

createArticleButton.addEventListener('click', () => {
  createArticleDialog.style.display = 'block';
});

const createArticleCancel = document.getElementById('create-article-cancel');

createArticleCancel.addEventListener('click', () => {
  createArticleDialog.style.display = 'none';
});

const articleName = document.getElementById('article-name');
const createArticleSubmit = document.getElementById('create-article-submit');

articleName.addEventListener('input', () => {   
  if (articleName.value != '') {
    createArticleSubmit.disabled = false;
  } else {
    createArticleSubmit.disabled = true;
  }
});

const createArticleForm = document.getElementById('create-article-form');

createArticleForm.addEventListener('submit', event => {
  event.preventDefault();

  const name = articleName.value;

  fetch('https://webik.ms.mff.cuni.cz/~14569027/cms/article-manage/articles_create.php', {
    method: 'POST',
    body: JSON.stringify({ name })
  }).then(response => response.json()).then(data => {
    createArticleDialog.style.display = 'none';
    window.location.href = `./article-edit/${data.id}`;
  });
});