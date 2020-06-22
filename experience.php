<div class="container-fluid">

	<div class="card" class="col-md-6">
		<div class="card-header">
			Experiencia
		</div>
		<div class="card-body">
			<form method="POST" action="controller/Exp.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						
						<div class="form-group">
							<h5>Empresa</h5>
							<input type="text" class="form-control" placeholder="Empresa" name="COMPANY">
						</div>
						<div class="form-group">
							<h5>Teléfono</h5>
							<input type="number" class="form-control" placeholder="Teléfono" name="PHONE">
						</div>
						<div class="form-group">
							<h5>Municipio</h5>
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


						</div>
						<div class="form-group">
							<h5>Pasantia</h5>
							<select class="form-control" id="" name="INTERNSHIP">
									<option disabled selected>¿Pasantia?</option>
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
							<h5>Fecha de ingreso</h5>
							<input type="date" class="form-control" placeholder="Fecha de ingreso" name="DATE1">
						</div>
						
						
					</div>
					<div class="col-md-6">

						<div class="form-group">
							<h5>Empleo Actual</h5>
							<select class="form-control" id=""  name="WORK">
									<option disabled selected>Empleo actual</option>
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
							<h5>Fecha de salida</h5>
							<input type="date" class="form-control" placeholder="Fecha de salida" name="DATE2">
						</div>
						<div class="form-group">
							<h5>Ocupación</h5>
							<select class="form-control" id="" placeholder="Ocupación"  name="OCUPATION">
									<option disabled selected>Ocupación</option>
									<?php
									$Q="SELECT * from codigos where id_padre=3087";
									foreach ($db->query($Q) as $Row) {
										?>
										<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
										<?php
									}
									?>

								</select>
						</div>
						<div class="form-group">
							<h5>Cargo</h5>
							<input type="text" class="form-control" placeholder="Cargo" name="POSITION">
						</div>
						<div class="form-group">
							<h5>Logros</h5>
							<textarea class="form-control" placeholder="Logros" name="AWARDS"></textarea>
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