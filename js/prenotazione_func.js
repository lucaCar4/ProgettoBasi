function checkNBici() {
    console.log(document.getElementById('numero_bici_disp').value + " " + num.value)
    if (document.getElementById('numero_bici_disp').value >= num.value && num.value >= 0) {
        validate(num, true);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/prenotazioni.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            console.log(this.responseText)
            res = JSON.parse(this.responseText);
            document.getElementById('preventivo').value = res.amount;
            if (res.error) {
                document.getElementById("error").hidden = false;
            } else {
                document.getElementById("error").hidden = true;
            }
        }
        xhr.send("action=amount" + "&data_inizio=" + data_inizio_d.value + "&data_fine=" + data_fine_d.value + "&anno=" + data_inizio_d.value.split('-')[0] + "&app=" + document.getElementById('id-app').value);
    } else {
        validate(num, false);
    }
}

function resetBici() {
    num.value = "";
    num.disabled = true;
}

async function checkDates(from, to) {
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
    return new Promise((resolve) => {
        if (!check || !check2 || !check3) {
            if (!check) {
                from.value = "";
            } else if (!check2) {
                to = "";
            }
            resetBici()
            validate(to, false)
            resolve(false)
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "utils/prenotazioni.php");
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                console.log("risultato= " + this.responseText)
                res = JSON.parse(this.responseText);
                if (res.check) {
                    validate(to, true);
                    document.getElementById('numero_bici_disp').value = res.bici;
                    document.getElementById('numero_bici').disabled = false;
                    resolve(true)
                } else {
                    validate(to, false);
                    document.getElementById('numero_bici').disabled = false;
                    resolve(false)
                }
            }
            xhr.send("action=check" + "&data_inizio=" + from.value + "&data_fine=" + to.value + "&id_appartamenti=" + document.getElementById('id-app').value);
        }
    })
}

function validate(element, valid) {
    if (!valid) {
        element.classList.remove("is-valid")
        element.classList.add("is-invalid");
    } else {
        element.classList.remove("is-invalid")
        element.classList.add("is-valid");
    }
}

function removeDataBsTitle(element) {
    var tooltipInstance = bootstrap.Tooltip.getInstance(element);
    if (tooltipInstance) {
        tooltipInstance.dispose();
    }
    new bootstrap.Tooltip(element);
}

async function checkGroupOrCliente() {
    return new Promise((resolve) => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/prenotazioni.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            console.log(this.responseText)
            let res = JSON.parse(this.responseText);
            if (res) {
                resolve(true);
            } else {
                resolve(false);
            }
        }
        if (gruppo.value === "" && cliente.value !== "") {
            xhr.send("action=check_cliente" + "&id=" + cliente.value);
        } else if (cliente.value === "" && gruppo.value !== "") {
            xhr.send("action=check_group" + "&id=" + gruppo.value);
        } else {
            resolve(false);
        }

    })
}

function prenote() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/prenotazioni.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        console.log(this.responseText)
    }
    xhr.send("action=prenote" + "&cliente=" + cliente.value + "&gruppo=" + gruppo.value + "&bici=" + num.value + "&data_inizio=" + data_inizio_d.value + "&data_fine=" + data_fine_d.value + "&app=" + document.getElementById('id-app').value + "&importo=" + document.getElementById('preventivo').value);
}

function findAppartamenti() {
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
        data_inizio_d.disabled = true;
        data_fine_d.disabled = true;
    }
    xhr.send("action=get_appartamenti" + "&id_condominio=" + id);
}