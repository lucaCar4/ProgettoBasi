<div class="accordion" id="accordionPanelsStayOpenExample">
	<div class="accordion-item">
		<h2 class="accordion-header">
			<button class="accordion-button" type="button" data-bs-toggle="collapse"
				data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
				aria-controls="panelsStayOpen-collapseOne">
				Effettua una Prenotazione
			</button>
		</h2>
		<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
			<div class="accordion-body">
				<form method="POST" class="row g-3 needs-validation :-<?php echo $_GET['action'] ?>"
					id="new-prenotazione">
					<p id="error" class="error" hidden>Attenzione alcuni giorni non sono dentro il listino!</p>
					<div class="col-md-5">
						<label for="condomini" class="form-label">Condomini</label>
						<select class="form-select" id="condomini" name="condomini" required>
							<option selected disabled value="">Scegli...</option>
							<?php foreach ($templateParams['condomini'] as $option): ?>
								<option <?php echo $selected ?>
									value="<?php echo $option['Nome'] ?>:-<?php echo $option['id_condominio'] ?>">
									<?php echo $option['Nome'] ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-5">
						<label for="appartamenti" class="form-label">Appartamenti</label>
						<select class="form-select" id="appartamenti" name="appartamenti" required>
							<option selected disabled value="">Seleziona un condomio...</option>
						</select>
						<input type="text" value="" id="id-app" name="id-app" hidden>
					</div>

					<div class="col-md-4">
						<label for="data_inizio" class="form-label">Data di Inizio</label>
						<input type="date" class="form-control  datepicker" id="data_inizio" name="data_inizio" disabled
							required>
						<div class="invalid-feedback" id="data-inizio-inv">
							Data obbligatoria.
						</div>
					</div>
					<div class="col-md-4">
						<label for="data_fine" class="form-label">Data di Fine</label>
						<input type="date" class="form-control  extra-validation" id="data_fine" name="data_fine"
							disabled required>
						<div class="invalid-feedback">
							Data obbligatoria.
						</div>
					</div>
					<div class="col-md-4">
						<label for="cliente" class="form-label">Cliente</label>
						<input type="text" class="form-control extra-validation" id="cliente" name="cliente"
							data-bs-toggle="tooltip" data-bs-title="" autocomplete="off" required>
						<div class="invalid-feedback" id="mailCustomValid">
							L'email deve avere la @ e al massimo 40 caratteri
						</div>
					</div>
					<div class="col-md-4">
						<label for="gruppo" class="form-label">Gruppo</label>
						<input type="text" class="form-control extra-validation" id="gruppo" name="gruppo"
							data-bs-toggle="tooltip" data-bs-title="" autocomplete="off" required>
					</div>
					<div class="col-md-3">
						<label for="numero_bici_disp" class="form-label">Numero Bici Disponibili</label>
						<input type="number" class="form-control extra-validation" id="numero_bici_disp"
							name="numero_bici_disp" disabled>
					</div>
					<div class="col-md-3">
						<label for="numero_bici" class="form-label">Numero Bici</label>
						<input type="number" class="form-control extra-validation" id="numero_bici" name="numero_bici"
							disabled required>
					</div>

					<div class="col-md-3">
						<label for="preventivo" class="form-label">Preventivo</label>
						<input type="number" class="form-control extra-validation" id="preventivo" name="preventivo"
							disabled>
					</div>

					<div class="col-12">
						<button id="prenota"
							class="btn btn-primary col-md-auto col-12 text-center d-sm-grid d-md-inline"
							type="button">Prenota</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<div class="accordion-item">
		<h2 class="accordion-header">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
				data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
				aria-controls="panelsStayOpen-collapseTwo">
				Guarda la disponibilità
			</button>
		</h2>
		<div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
			<div class="accordion-body">
				<form method="POST" class="row g-3 needs-validation :-<?php echo $_GET['action'] ?>"
					id="new-prenotazione">
					<p id="error-d" class="error" hidden>Date già occupate!</p>
					<p id="true-d" class="true" hidden>Appartamento disponibile!</p>
					<div class="col-md-5">
						<label for="condomini" class="form-label">Condomini</label>
						<select class="form-select" id="condomini-d" name="condomini" required>
							<option selected disabled value="">Scegli...</option>
							<?php foreach ($templateParams['condomini'] as $option): ?>
								<option <?php echo $selected ?>
									value="<?php echo $option['Nome'] ?>:-<?php echo $option['id_condominio'] ?>">
									<?php echo $option['Nome'] ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-5">
						<label for="appartamenti-d" class="form-label">Appartamenti</label>
						<select class="form-select" id="appartamenti-d" name="appartamenti-d" required>
							<option selected disabled value="">Seleziona un condomio...</option>
						</select>
						<input type="text" value="" id="id-app-d" name="id-app-d" hidden>
					</div>

					<div class="col-md-4">
						<label for="data_inizio-d" class="form-label">Data di Inizio</label>
						<input type="date" class="form-control" id="data_inizio-d" name="data_inizio-d" disabled
							required>
						<div class="invalid-feedback" id="data-inizio-inv">
							Data obbligatoria.
						</div>
					</div>
					<div class="col-md-4">
						<label for="data_fine-d" class="form-label">Data di Fine</label>
						<input type="date" class="form-control" id="data_fine-d" name="data_fine-d"
							disabled required>
						<div class="invalid-feedback">
							Data obbligatoria.
						</div>
					</div>
				</form>
				<section id="disp-table"></section>
			</div>
		</div>
	</div>

</div>

<script src="js/prenotazione_func.js"></script>
<script src="js/prenotazione.js"></script>
<script src="js/find_freeDays.js"></script>