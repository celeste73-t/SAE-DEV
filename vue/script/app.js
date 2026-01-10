const input = document.getElementById("search");
const results = document.getElementById("results");

let timer = null;

if (input)
    input.addEventListener("input", callSearchTimed);

if (results) 
    results.addEventListener("click", openValidation);


function callSearchTimed() {

    let q = input.value;

    if (q.length < 2) {
        results.innerHTML = "";
        return;
    }
    clearTimeout(timer);

    timer = setTimeout(() => search(q), 300);
}

document.addEventListener("click", voteRedirection);


function search(q) {
    fetch("index.php?page=proposition&action=search&q=" + encodeURIComponent(q)).then(response => response.json()).then(data => {
        results.innerHTML = "";
        data.forEach(item => {
            results.innerHTML += ` 
            <div class="suggestion" 
                data-id="${item.id}"
                data-titre="${item.titre}"
                data-artiste="${item.artiste}"
                data-image="${item.image}">

                <img src="${item.image}" width="50">
                <strong>${item.titre}</strong><br>
                <em>${item.artiste}</em>
            </div>
            `;
        });
    });
}

function openValidation(e) { 
    console.log("test");
    
    const item = e.target.closest(".suggestion"); 
    if (!item) return; 
    
    const data = { 
        id: item.dataset.id, 
        titre: item.dataset.titre, 
        artiste: item.dataset.artiste, 
        image: item.dataset.image 
    };
    
    fetch("index.php?page=proposition&action=select", { 
        method: "POST", 
        headers: { "Content-Type": "application/json" }, 
        body: JSON.stringify(data) 
    }).then(() => { 
        window.location.href = "index.php?page=validation"; 
    }); 
};

function voteRedirection(e) {
    const card = e.target.closest(".carte-proposition");
    if (!card) return;

    const data = {
        id: card.dataset.id,
        categorie: card.dataset.categorie
    };

    fetch("index.php?page=vote&action=select", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    }).then(() => {
        window.location.href = "index.php?page=validation";
    });
}