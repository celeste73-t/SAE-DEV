const input = document.getElementById("search"); 
const results = document.getElementById("results");

if (input)
    input.addEventListener("input", search);

function search(params) {
    let q = input.value; 
               
    if (q.length < 2) { 
        return; 
    } 
                
    fetch("index.php?page=proposition&action=search&q=" + encodeURIComponent(q)) .then(response => response.json()) .then(data => { 
        results.textContent = JSON.stringify(data, null, 2); 
    });
}