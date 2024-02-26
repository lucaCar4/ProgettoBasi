<label for="new-gruppo">Aggiungi un nuovo gruppo</label>
<section id="new-gruppo">
    <form method="POST" class="row g-3 needs-validation" id="new-groppo">
        <div class="col-md-4">
            <label for="numero_componenti" class="form-label">Numero Componenti</label>
            <input type="number" class="form-control extra-validation" id="numero_componenti" name="numero_componenti"
                required>
        </div>
        <div class="col-md-4">
            <label for="nome" class="form-label">Nome Gruppo</label>
            <input type="text" class="form-control extra-validation" id="nome" name="nome" required>
        </div>
        <div id="members">

        </div>
        <div class="col-12">
            <button class="btn btn-primary col-md-auto col-12 text-center d-sm-grid d-md-inline"
                type="submit">Aggiungi</button>
        </div>
    </form>
</section>
<script src="js/new_gruppo.js"></script>