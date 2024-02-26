function check(from, to) {
    let data = new Date();
    let check = from.value.split('-')[0] <= data.getFullYear();
    let check2 = to.value.split('-')[0] <= data.getFullYear();
    let arr1 = from.value.split('-');
    let arr2 = to.value.split('-');
    let d1 = new Date(arr1[0], arr1[1], arr1[2]);
    let d2 = new Date(arr2[0], arr2[1], arr2[2]);
    let r1 = d1.getTime();
    let r2 = d2.getTime();
    let check3 = r2 >= r1;
    if (check && check2 && check3) {
        createTable();
    }
}

function createTable() {
    section = document.getElementById('disp-table').innerHTML;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/availability.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        console.log("risultato= " + this.responseText)
        res = JSON.parse(this.responseText);
        console.log(res)
        if (res === true) {
            document.getElementById('true-d').hidden = false;
            document.getElementById('error-d').hidden = true;
        } else {
            document.getElementById('error-d').hidden = false;
            document.getElementById('true-d').hidden = true;
        }
    }
    if (appartamenti_d.value == 'Tutti') {
        xhr.send("action=get_all" + "&from=" + data_inizio_d.value + "&to=" + data_fine_d.value);
    } else {
        let id = document.getElementById('id-app-d').value;
        console.log("invio = " + id)
        xhr.send("action=check_disp" + "&from=" + data_inizio_d.value + "&to=" + data_fine_d.value + "&id-app=" + id);
    }
}
const condominio = document.getElementById('condomini-d');
if (condominio) {
    condominio.addEventListener("input", function () {
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
            document.getElementById('appartamenti-d').innerHTML = text;
            data_inizio_d.disabled = true;
            data_fine_d.disabled = true;
        }
        xhr.send("action=get_appartamenti" + "&id_condominio=" + id);
    })
}

const appartamenti_d = document.getElementById('appartamenti-d')
if (appartamenti_d) {
    appartamenti_d.addEventListener('input', function () {
        if (data_inizio_d.value != "" && data_fine_d.value != "") {
            checkDates(data_inizio_d, data_fine_d)
        }
        document.getElementById('id-app-d').value = document.getElementById('appartamenti-d').value.split('¬')[1];
        document.getElementById('data_inizio-d').disabled = false;
    })
}

const data_inizio_d = document.getElementById('data_inizio-d');
if (data_inizio_d) {
    data_inizio_d.addEventListener("input", function () {
        let data_iniziale = data_inizio_d.value;

        let arr1 = data_iniziale.split('-');
        console.log(data_iniziale)
        let d1 = new Date(arr1[0], arr1[1], arr1[2]);
        let d2 = new Date();

        let r1 = d1.getTime();
        let r2 = d2.getTime();
        if (r1 >= r2) {
            data_fine_d.disabled = false;
            validate(data_inizio_d, true);
            if (data_fine_d.value !== "") {
                check(data_inizio_d, data_fine_d);
            }
        } else {
            validate(data_inizio_d, false);
            document.querySelector('div#data-inizio-inv').innerHTML = 'Invalid date';
            data_fine_d.disabled = true;
            data_fine_d.value = "";
        }
    })

}

const data_fine_d = document.getElementById('data_fine-d');
if (data_fine_d) {
    data_fine_d.addEventListener("input", function () {
        check(data_inizio_d, data_fine_d);
    })
}



