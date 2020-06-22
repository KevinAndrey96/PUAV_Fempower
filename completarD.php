<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			Completar datos
		</div>
		<div class="card-body">
			<form method="POST" action="controller/CompleteD.php">
				<div class="row">
					<div class="col-md-6">
						<h5 class="card-title">Razón Social</h5>
						<input type="text" class="form-control" name="NAME" placeholder="Razón Social">
						<br>
						<h5 class="card-title">Representante legal</h5>
						<input type="text" class="form-control" name="LEGAL" placeholder="Representante legal">
						<br>
						<h5 class="card-title">Dirección</h5>
						<input type="text" class="form-control" name="ADDRESS" placeholder="Dirección">
						<br>
						<h5 class="card-title">Nit</h5>
						<input type="number" class="form-control" name="NIT" placeholder="Dirección">
						<br>
						<h5 class="card-title">Municipio</h5>
						<select class="selectpicker form-control" name="TOWN" data-live-search="true">
							<option disabled selected>Municipio</option>
							<?php
							$Q="SELECT   t3.id AS id, concat(t2.descripcion, ', ', t3.descripcion) AS descripcion FROM     codigos AS t1 LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id WHERE    t1.descripcion = 'DEPARTAMENTO' AND concat(t2.descripcion, ', ', t3.descripcion) LIKE '%%' ORDER BY 2 ASC";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<br>

					</div>
					<div class="col-md-6">
						<h5 class="card-title">CIIU</h5>
						<select class="form-control" name="CIIU">
							<option disabled selected>CIIU</option>
							<?php
							$Q="SELECT * from codigos where id_padre=3884";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Teléfono</h5>
						<input type="number" class="form-control" name="PHONE" placeholder="Teléfono">
						<br>
						<h5 class="card-title">Celular</h5>
						<input type="number" class="form-control" name="CELL" placeholder="Celular">
						<br>
						<h5 class="card-title">URL Web</h5>
						<input type="url" class="form-control" name="WEB" placeholder="Url Web">
						<br>
					</div>
				</div>
				<br>
				<center><input type="submit" class="btn btn-primary" name="" value="Completar información" ></center>
			</form>
		</div>
	</div>
</div>