<div class="container-fluid">

	<div class="card" class="col-md-6">
		<div class="card-header">
			Educación
		</div>
		<div class="card-body">
			<form method="POST" action="controller/Edu.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<h5>Capacitación trabajo</h5>
							<select class="form-control" name="CAPACITATION">
									<option disabled selected>Capacitación trabajo</option>
									<?php
									$Q="SELECT * from codigos where id_padre=2199";
									foreach ($db->query($Q) as $Row) {
										?>
										<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
										<?php
									}
									?>

								</select>
						</div>
						<div class="form-group">
							<h5>Formal</h5>
							<select class="form-control" id=""  name="FORMAL">
									<option disabled selected>¿Formal?</option>
									<?php
									$Q="SELECT * from codigos where id_padre=2199";
									foreach ($db->query($Q) as $Row) {
										?>
										<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
										<?php
									}
									?>

								</select>
						</div>
						<div class="form-group">
							<h5>Título</h5>
							<input type="text" class="form-control" placeholder="Título" name="TITLE">
						</div>
						<div class="form-group">
							<h5>Institución</h5>
							<input type="text" class="form-control" placeholder="Institución" name="INSTITUTION">
						</div>
						<div class="form-group">
							<h5>Modalidad</h5>
							<select class="form-control" name="MODALITY">
								<option value="Modalidad" selected disabled>Modalidad</option>
								<option value="Presencial">Presencial</option>
								<option value="Virtual">Virtual</option>
							</select>
						</div>
						
						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<h5>Año finalización</h5>
							<input type="number" class="form-control" placeholder="Año finalización" name="YEAR">
						</div>
						<div class="form-group">
							<h5>Mes Finalización</h5>
							<select class="form-control" name="MONTH">
								<option value="Mes finalización" selected disabled>Mes finalización</option>
								<option value="1">Enero</option>
								<option value="2">Febrero</option>
								<option value="3">Marzo</option>
								<option value="4">Abril</option>
								<option value="5">Mayo</option>
								<option value="6">Junio</option>
								<option value="7">Julio</option>
								<option value="8">Agosto</option>
								<option value="9">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
								
							</select>
						</div>
						<div class="form-group">
							<h5>¿Terminó?</h5>
							<select class="form-control" id=""  name="FINISHED">
									<option disabled selected>¿Terminó?</option>
									<?php
									$Q="SELECT * from codigos where id_padre=2199";
									foreach ($db->query($Q) as $Row) {
										?>
										<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
										<?php
									}
									?>

								</select>
						</div>
						<div class="form-group">
							<h5>Meses estudio</h5>
							<input type="number" class="form-control" placeholder="Meses estudio" name="MONTHS">
						</div>
						<div class="form-group">
							<h5>Archivo</h5>
							<input type="file" class="form-control" accept=".pdf" name="FILE">
						</div>
					</div>
				</div>
				<hr>
				<center><input type="submit" class="btn btn-primary" value="Registrar información" name=""></center>
			</form>

		</div>
	</div>
</div>