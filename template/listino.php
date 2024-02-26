<label for="listino-form">Seleziona un Appartamneto</label>
<section id="listino-form">
    <form action="listiono.php?action=2" method="POST" class="row g-3 needs-validation">
        <div class="col-md-4">
            <label for="condomini" class="form-label">Condomini</label>
            <select class="form-select" id="condomini" name="condomini" required>
                <option selected disabled value="">Scegli...</option>
                <?php foreach ($templateParams['condomini'] as $option): ?>
                    <option <?php echo $selected ?>
                        value="<?php echo $option['Nome'] ?>¬<?php echo $option['id_condominio'] ?>">
                        <?php echo $option['Nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="appartamenti-l" class="form-label">Appartamenti</label>
            <select class="form-select" id="appartamenti-l" name="appartamenti" required>
                <option selected disabled value="">Seleziona un condomio...</option>
            </select>
            <input type="text" value="" id="id-app" name="id-app" hidden>
        </div>
    </form>
</section>

<label for="listino-form">Nuovo Listino</label>
<section id="listino-form">
    <form method="POST" class="row g-3 needs-validation">
        <div class="col-md-4">
            <input type="number" class="form-control extra-validation" id="anno" name="anno" placeholder="Anno" disabled
                required>
        </div>

        <div class="col-4">
            <button class="btn btn-primary" id="crea" type="submit">Aggiungi</button>
        </div>
    </form>
</section>
<label for="periodo-form">Aggiungi un periodo</label>
<section id="periodo-form">
    <form method="POST" class="row g-3 needs-validation" id="periodo-f">
        <div class="col-md-3">
        <label for="anno-p" class="form-label">Anno</label>
            <input type="number" class="form-control extra-validation" id="anno-p" name="anno-p" placeholder="Anno"
                disabled required>
        </div>
        <div class="col-md-3">
            <label for="data_inizio" class="form-label">Data di Inizio</label>
            <input type="date" class="form-control  extra-validation" id="data_inizio" name="data_inizio" disabled
                required>
            <div class="invalid-feedback" id="data-inizio-inv">
                Data obbligatoria.
            </div>
        </div>
        <div class="col-md-3">
            <label for="data_fine" class="form-label">Data di Fine</label>
            <input type="date" class="form-control  extra-validation" id="data_fine" name="data_fine" disabled required>
            <div class="invalid-feedback">
                Data obbligatoria.
            </div>
        </div>
        <div class="col-md-3">
            <label for="prezzo" class="form-label">Prezzo</label>
            <input type="number" class="form-control" id="prezzo" name="prezzo" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary col-md-auto col-12 text-center d-sm-grid d-md-inline"
                type="submit">Aggiungi</button>
        </div>
    </form>
</section>

<script src="js/listino.js"></script>