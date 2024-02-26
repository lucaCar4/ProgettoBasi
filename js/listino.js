async function checkYear(exist, elem) {
    return new Promise((resolve, reject) => {
        let data = new Date();
        if (elem.value.length === 4 && elem.value >= data.getFullYear()) {
            let id_app = document.getElementById('appartamenti-l').value.split('¬')[1];

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "utils/listino.php");
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log(xhr.responseText);
                    let res = JSON.parse(xhr.responseText);
                    if ((res && !exist) || (!res && exist)) {
                        elem.classList.remove("is-invalid");
                        elem.classList.add("is-valid");
                        if (elem.id === anno_p.id) {
                            data_inizio.disabled = res;
                        }
                        resolve(true);
                    } else {
                        elem.classList.remove("is-valid");
                        elem.classList.add("is-invalid");
                        reject(false);
                    }
                }
            };
            xhr.send("action=check_year" + "&anno=" + elem.value + "&app=" + id_app);
        } else {
            elem.classList.remove("is-valid");
            elem.classList.add("is-invalid");
            reject(false);
        }
    });
}

async function checkDate() {
    let arr1 = data_inizio.value.split('-');
    let arr2 = data_fine.value.split('-');
    let d1 = new Date(arr1[0], arr1[1], arr1[2]).getTime();
    let d2 = new Date(arr2[0], arr2[1], arr2[2]).getTime();
    let anno = anno_p.value;
    return new Promise((resolve, reject) => {
        if (arr1[0] === anno && arr2[0] === anno) {
            let date = document.getElementById('data_inizio').value;
            let date_f = document.getElementById('data_fine').value;
            let id_app = document.getElementById('id-app').value;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "utils/listino.php");
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                console.log(this.responseText)
                let res = JSON.parse(this.responseText);
                if (res) {
                    data_fine.disabled = false;
                    data_inizio.classList.remove("is-invalid");
                    data_inizio.classList.add("is-valid");
                    data_fine.classList.remove("is-invalid");
                    data_fine.classList.add("is-valid");
                    resolve(res);
                } else {
                    data_inizio.classList.remove("is-valid");
                    data_inizio.classList.add("is-invalid");
                    document.querySelector('div#data-inizio-inv').innerHTML = 'Invalid date';
                    data_fine.disabled = true;
                    data_fine.value = "";
                    reject(res);
                }
            }
            xhr.send("action=check_dates" + "&data_inizio=" + date + "&data_fine=" + date_f + "&anno=" + anno + "&app=" + id_app);
        } else {
            data_inizio.classList.remove("is-valid");
            data_inizio.classList.add("is-invalid");
            data_fine.classList.remove("is-valid");
            data_fine.classList.add("is-invalid");
            reject(false);
        }
    });

}

async function validateAddPeriod() {
    const [date, year] = await Promise.all([checkDate(), checkYear(true, anno_p)]);
    console.log("date " + date);
    console.log("year " + year)
    if (!date || !year) {
        console.log("blocco");
        return false;
    }
    return true;
}

function sendPeriod() {
    let date = document.getElementById('data_inizio').value;
    let date_f = document.getElementById('data_fine').value;
    let id_app = document.getElementById('id-app').value;
    let anno = anno_p.value;
    let prezzo = document.getElementById('prezzo').value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/listino.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        console.log(this.responseText)
    }
    xhr.send("action=new_period" + "&data_inizio=" + date + "&data_fine=" + date_f + "&anno=" + anno + "&app=" + id_app + "&prezzo=" + prezzo);
}

document.querySelector('form#periodo-f').onsubmit = async function (event) {
    event.preventDefault();  // Evita la presentazione del modulo di default

    let validationSuccessful = await validateAddPeriod();
    console.log(validationSuccessful)
    if (validationSuccessful && this.checkValidity()) {
        sendPeriod()
        //this.submit();  // Invia manualmente il modulo se la validazione è riuscita
    } else {
        console.log("nooo")
    }
};

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
            document.getElementById('appartamenti-l').innerHTML = text;
        }
        xhr.send("action=get_appartamenti" + "&id_condominio=" + id);
    })
}

const appartamenti = document.getElementById('appartamenti-l')
if (appartamenti) {
    appartamenti.addEventListener('input', function () {
        document.getElementById('id-app').value = document.getElementById('appartamenti-l').value.split('¬')[1];
        document.getElementById('anno').disabled = false;
        document.getElementById('anno-p').disabled = false;
    })
}
const anno = document.getElementById('anno');
if (anno) {
    anno.addEventListener('input', function () {
        checkYear(false, anno);
    });
}
const anno_p = document.getElementById('anno-p');
if (anno_p) {
    anno_p.addEventListener('input', function () {
        data_inizio.disabled = checkYear(true, anno_p);
    });
}


const data_inizio = document.getElementById('data_inizio');
if (data_inizio) {
    data_inizio.addEventListener("input", function () {
        let data_iniziale = data_inizio.value;
        let arr1 = data_iniziale.split('-');
        let d1 = new Date(arr1[0], arr1[1], arr1[2]);
        let d2 = new Date();
        let r1 = d1.getTime();
        let r2 = d2.getTime();
        if (r1 >= r2 && anno_p.value === arr1[0]) {
            data_fine.disabled = false;
            data_inizio.classList.remove("is-invalid");
            data_inizio.classList.add("is-valid");
        } else {
            data_inizio.classList.remove("is-valid");
            data_inizio.classList.add("is-invalid");
            data_fine.disabled = true;
            data_fine.value = "";
        }
    })
}

const data_fine = document.getElementById('data_fine');
if (data_fine) {
    data_fine.addEventListener("input", function () {
        checkDate()
    })
}