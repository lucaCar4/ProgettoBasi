<label for="new-cliente">Aggiungi un nuovo cliente</label>
<section id="new-cliente">
    <form method="POST" class="row g-3 needs-validation" id="new-cliente">
        <div class="col-md-4">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control extra-validation" id="nome" name="nome" required>
        </div>
        <div class="col-md-4">
            <label for="cognome" class="form-label">Cognome</label>
            <input type="text" class="form-control extra-validation" id="cognome" name="cognome" required>
        </div>
        <div class="col-md-4">
            <label for="codice_documento" class="form-label">Codice Documento</label>
            <input type="text" maxlength="16" class="form-control extra-validation" id="codice_documento" name="codice_documento"
                required>
        </div>
        <div class="col-md-4">
            <label for="data_rilascio" class="form-label">Data Rilascio</label>
            <input type="date" class="form-control" id="data_rilascio" name="data_rilascio" required>
            <div class="invalid-feedback" id="data-inizio-inv">
                Data obbligatoria.
            </div>
        </div>
        <div class="col-md-4">
            <label for="da_chi" class="form-label">Da chi è stato Rilasciato</label>
            <input type="text" class="form-control" id="da_chi" name="da_chi" required>
        </div>
        <div class="col-md-4">
            <label for="luogo_nascita" class="form-label">Luogo di nascita</label>
            <input type="text" class="form-control" id="luogo_nascita" name="luogo_nascita" required>
        </div>
        <div class="col-md-4">
            <label for="provincia" class="form-label">Provincia</label>
            <input type="text" maxlength="2" class="form-control" id="provincia" name="provincia" required>
        </div>
        <div class="col-md-4">
            <label for="data_nascita" class="form-label">Data di Nascita</label>
            <input type="date" class="form-control" id="data_nascita" name="data_nascita" required>
            <div class="invalid-feedback">
                Data obbligatoria.
            </div>
        </div>
        <div class="col-md-4">
            <label for="comune_residenza" class="form-label">Comune di residenza</label>
            <input type="text" class="form-control" id="comune_residenza" name="comune_residenza" required>
        </div>
        <div class="col-md-4">
            <label for="cap" class="form-label">CAP</label>
            <input type="number" max="5" class="form-control" id="cap" name="cap" required>
        </div>
        <div class="col-md-4">
            <label for="via" class="form-label">Via</label>
            <input type="text" class="form-control" id="via" name="via" required>
        </div>
        <div class="col-md-4">
            <label for="numero_civico" class="form-label">N°</label>
            <input type="text" class="form-control" id="numero_civico" name="numero_civico" required>
        </div>
        <div class="col-md-4">
            <label for="mail" class="form-label">Mail</label>
            <input type="mail" class="form-control" id="mail" name="mail" required>
        </div>
        <div class="col-md-4">
            <label for="numero" class="form-label">Telefono</label>
            <input type="tel" class="form-control extra-validation" id="numero" name="numero" required>
        </div>


        <div class="col-12">
            <button class="btn btn-primary col-md-auto col-12 text-center d-sm-grid d-md-inline"
                type="submit">Aggiungi</button>
        </div>

    </form>
</section>
<script src="js/prenotazione.js"></script>