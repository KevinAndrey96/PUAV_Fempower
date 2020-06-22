<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			Registrar Vacante
		</div>
		<div class="card-body">
			<form method="POST" action="controller/Vacant.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<h5 class="card-title">Nombre de cargo</h5>
						<input type="text" class="form-control" name="NAME" placeholder="Nombre de cargo">
						<br>
						<h5 class="card-title">Descripción</h5>
						<textarea class="form-control" name="DESCRIPTION" placeholder="Descripción"></textarea>
						<br>
						<h5 class="card-title">Salario</h5>
						<select class="form-control" name="SALARY">
							<option disabled selected>Salario</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2234";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Experiencia requerida (Meses)</h5>
						<input type="text" class="form-control" name="EXPERIENCE" placeholder="Experiencia requerida">
						<br>
						<?php
						$Fecha=date("Y")."-".date("m")."-".date("d");
						?>
						<h5 class="card-title">Fecha de publicación</h5>
						<input type="date" class="form-control" min="<?=$Fecha?>" id="INIT" onchange="fec()" name="INIT">
						<br>
					</div>
					<div class="col-md-6">
						<h5 class="card-title">Tipo de contrato</h5>
						<select class="form-control" name="CONTRACT">
							<option disabled selected>Tipo de contrato</option>
							<?php
							$Q="SELECT * from codigos where id_padre=4788";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Funciones</h5>
						<textarea class="form-control" name="FUNCTIONS" placeholder="Funciones"></textarea>
						<br>
						<h5 class="card-title">Ubicación</h5>
						<select class="selectpicker form-control" name="LOCATION" data-live-search="true">
							<option disabled selected>Ubicación</option>
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
						<h5 class="card-title">Número de vacantes</h5>
						<input type="number" class="form-control" name="VACANT" placeholder="Número de vacantes">
						<br>
						<h5 class="card-title">Fecha de cierre</h5>
						<input type="date" class="form-control" disabled id="CLOSE" name="CLOSE">
						<br>
						<h5 class="card-title">Archivo</h5>
						<input type="file" class="form-control" accept=".pdf" name="FILE">
						<br>
						
						<script>
							function fec() {
							  document.getElementById("CLOSE").disabled=false;
							  var x=document.getElementById("INIT").value;
							  document.getElementById("CLOSE").min = x;
							}
						</script>
						
					</div>
				</div>
				<br>
				<center><input type="submit" class="btn btn-primary" name="" value="Registrar Vacante" ></center>
			</form>
		</div>
	</div>
</div>