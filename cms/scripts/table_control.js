let curr_page = 0;
let number_of_elements = obj.length;

const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');

const counterHolder = document.getElementById('counter');
function displayPage(page) {
    const table = document.getElementById('mytable');
    table.replaceChildren();

    if (number_of_elements % 10 == 0) {
        counterHolder.innerHTML = (Math.floor(number_of_elements / 10));
    }
    else {
        counterHolder.innerHTML = (Math.floor(number_of_elements / 10) + 1);
    }
    let counter_helper = 10 * page;
    let limit = counter_helper + 10;
    if (limit > number_of_elements) {
        limit = number_of_elements;
    }
    if (page == 0) {
        prevButton.style.visibility = "hidden";
    } else {
        prevButton.style.visibility = "visible";
    }
    if (page == number_of_elements / 10 - 1 || page == Math.floor(number_of_elements / 10)) {
        nextButton.style.visibility = "hidden";
    } else {
        nextButton.style.visibility = "visible";
    }

    counterHolder.innerHTML = curr_page + 1 + "/" + counterHolder.innerHTML;
    
    for (let i = counter_helper; i < limit; i++) {
        const tr = document.createElement('tr');
        const tdName = document.createElement('td');
        tdName.textContent = obj[i].name;
        tdName.setAttribute('id', 'names');
        tr.appendChild(tdName);

        const tdLikedness = document.createElement('td');
        const LikednessParagraph = document.createElement('p');
        console.log(obj[i].likes_number);
        LikednessParagraph.textContent = + parseInt(obj[i].likes_number) - parseInt(obj[i].dislikes_number);
        LikednessParagraph.setAttribute('id', 'edit');
        tdLikedness.appendChild(LikednessParagraph);
        tr.appendChild(tdLikedness);

        const tdShow = document.createElement('td');
        const showLink = document.createElement('a');
        showLink.textContent = "Show";
        showLink.href = './article/' + obj[i].id;
        showLink.setAttribute('id', 'show');
        tdShow.appendChild(showLink);
        tr.appendChild(tdShow);


        const tdEdit = document.createElement('td');
        const editLink = document.createElement('a');
        editLink.textContent = "Edit";
        editLink.href = './article-edit/' + obj[i].id;
        editLink.setAttribute('id', 'edit');
        tdEdit.appendChild(editLink);
        tr.appendChild(tdEdit);

        const tdDelete = document.createElement('td');
        const deleteButton = document.createElement('a');
        deleteButton.textContent = "Delete";
        deleteButton.setAttribute('id', 'delete');
        deleteButton.href = `https://webik.ms.mff.cuni.cz/~14569027/cms/article-manage/articles_delete.php?id=${obj[i].id}`;
        deleteButton.addEventListener('click', (event) => {
            event.preventDefault();
            fetch(deleteButton.href, {
                method: 'DELETE'
            }).then(response => {
                if (response.ok) {
                    fetch('https://webik.ms.mff.cuni.cz/~14569027/cms/article-manage/articles_get.php').then(response => response.json()).then(data => {
                        obj = data;
                        number_of_elements = obj.length;
                        displayPage(curr_page);
                    });
                }
            });
        });
        tdDelete.appendChild(deleteButton);
        tr.appendChild(tdDelete);

        table.appendChild(tr);
    }
}

prevButton.addEventListener('click', () => {
if (curr_page > 0 ) {
    curr_page--;
}
displayPage(curr_page);
});

nextButton.addEventListener('click', () => {
if (curr_page < Math.floor(number_of_elements / 10)) {
    curr_page++;
}
displayPage(curr_page);
});

displayPage(curr_page);