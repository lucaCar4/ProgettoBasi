
const cond = document.getElementById('condomini');

if (cond) {
    cond.addEventListener("input", function () {

        let id = this.value.split('¬')[1]
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/prenotazioni.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            console.log(this.responseText)
            $res = JSON.parse(this.responseText);
            let text = `<option selected disabled value="">Seleziona un condomio...</option>`
            $res['appartamenti'].forEach(element => {
                text +=
                    `
                <option value="${element['numero']}¬${element['id_appartamento']}">
                ${element['numero']}
                </option>
                `;
            });
            document.getElementById('appartamenti').innerHTML = text;
            data_inizio.disabled = true;
            data_fine.disabled = true;
        }
        xhr.send("action=get_appartamenti" + "&id_condominio=" + id);
    })
}

const appartamenti = document.getElementById('appartamenti')
if (appartamenti) {
    appartamenti.addEventListener('input', function () {
        if (data_inizio.value != "" && data_fine.value != "") {
            checkDates(data_inizio, data_fine)
        }
        document.getElementById('id-app').value = document.getElementById('appartamenti').value.split('¬')[1];
        document.getElementById('data_inizio').disabled = false;

    })
}

const data_inizio = document.getElementById('data_inizio');
if (data_inizio) {
    data_inizio.addEventListener("input", function () {
        let data_iniziale = data_inizio.value;

        let arr1 = data_iniziale.split('-');
        console.log(data_iniziale)
        let d1 = new Date(arr1[0], arr1[1], arr1[2]);
        let d2 = new Date();

        let r1 = d1.getTime();
        let r2 = d2.getTime();
        if (r1 >= r2) {
            data_fine.disabled = false;
            validate(data_inizio, true);
            if (data_fine.value !== "") {
                checkDates(data_inizio, data_fine);
            }
        } else {
            validate(data_inizio, false);
            document.querySelector('div#data-inizio-inv').innerHTML = 'Invalid date';
            data_fine.disabled = true;
            data_fine.value = "";
        }
    })

}

const data_fine = document.getElementById('data_fine');
if (data_fine) {
    data_fine.addEventListener("input", function () {
        checkDates(data_inizio, data_fine);
    })
}

const cliente = document.getElementById('cliente');
if (cliente) {
    cliente.addEventListener('input', function () {
        gruppo.disabled = true;
        gruppo.value = "";
        gruppo.required = false;
        if (cliente.value === "") {
            gruppo.disabled = false;
            cliente.removeAttribute('data-bs-title');
            removeDataBsTitle(cliente);
            gruppo.required = true;
        }
        auto(cliente.id, cliente.value)
    })
}

const gruppo = document.getElementById('gruppo')
if (gruppo) {
    gruppo.addEventListener('input', function () {
        cliente.disabled = true;
        cliente.value = "";
        cliente.required = false;
        if (gruppo.value === "") {
            console.log("cia")
            cliente.disabled = false;
            cliente.required = true;
            gruppo.removeAttribute('data-bs-title');
            removeDataBsTitle(gruppo)
            updateDateBs();
        }
        auto(gruppo.id, gruppo.value)
    })
}


const num = document.getElementById('numero_bici');
if (num) {
    console.log('trovato')
    num.addEventListener('input', function () {
        checkNBici();
    })
} else {
    console.log('non')
}
document.querySelector('button#prenota').addEventListener("click", async function () {
    let check_date = await checkDates(data_inizio, data_fine);
    let check_cliente = await checkGroupOrCliente();
    let check_bici = document.getElementById('numero_bici_disp').value >= num.value && num.value >= 0;
    if (check_date && check_cliente && check_bici) {
        prenote();
        console.log("ok")
    }
})
