const input = document.getElementById("search");
const results = document.getElementById("results");

let timer = null;

if (input)
    input.addEventListener("input", callSearchTimed);

function callSearchTimed(params) {
    clearTimeout(timer);

    timer = setTimeout(search, 300);
}

function search() {
    let q = input.value;

    if (q.length < 2) {
        results.innerHTML = "";
        return;
    }

    fetch("index.php?page=proposition&action=search&q=" + encodeURIComponent(q)).then(response => response.json()).then(data => {
        results.innerHTML = "";
        data.forEach(item => {
            results.innerHTML += ` 
            <div class="suggestion" data-type="${item.type}" data-id="${item.id}">
                <img src="${item.image}" width="50">
                <strong>${item.titre}</strong><br>
                <em>${item.artiste}</em>
            </div>
            `;
        });
    });
}