console.log('caricato')
function addMembers(num) {
    let group_num = document.querySelectorAll('div.member').length;
    console.log( num !== "")
    if (num >= group_num) {
        console.log('uu')
        for (let i = group_num; i < num; i++) {
            document.getElementById('members').innerHTML +=
                `
            <div class='row member'>
                <div class="col-md-4">
                    <label for="cliente${i}" class="form-label">Cliente ${i}</label>
                    <input type="text" class="form-control memb" id="cliente${i}" name="cliente${i}" data-bs-toggle="tooltip" data-bs-title="" required>
                </div>
                <div class="col-md-4">
                    <label for="ruolo${i}" class="form-label">Ruolo ${i}</label>
                    <input type="text" class="form-control" id="ruolo${i}" name="ruolo${i}" data-bs-toggle="tooltip" data-bs-title="" required>
                </div>
            </div>
            `;
        }
        document.querySelectorAll('input.memb').forEach(elem => {
            const clonedElement = elem.cloneNode(true);
            // Sostituisci l'elemento originale con la sua copia
            elem.replaceWith(clonedElement);
            clonedElement.addEventListener("input", function () {
                auto(clonedElement.id, clonedElement.value)
            })
        })
    } else if(num < group_num && num !== "") {
        for (let i = group_num - 1; i >= num; i--) {
            let elements = document.querySelectorAll('div.member');
            if (elements[i]) {
                elements[i].remove();
                console.log('remove');
            }
        }
    }
}

const num = document.getElementById('numero_componenti');
if (num) {
    console.log('trovato')
    num.addEventListener('input', function () {
        addMembers(num.value);
    })
} else {
    console.log('non')
}
updateDateBs()