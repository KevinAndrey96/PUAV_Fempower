<?php
$ID=$_GET["ID"];
$Q7="SELECT * from demandantes_vacantes where id=$ID";
$Row7=$db->query($Q7);
$Row7=$Row7->fetch();
?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			Registrar Vacante
		</div>
		<div class="card-body">
			<form method="POST" action="controller/EditVacant.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" name="ID" value="<?=$ID?>">
						<h5 class="card-title">Nombre de cargo</h5>
						<input type="text" class="form-control" name="NAME" value="<?=$Row7["nombreCargo"]?>" placeholder="Nombre de cargo">
						<br>
						<h5 class="card-title">Descripción</h5>
						<textarea class="form-control" name="DESCRIPTION" placeholder="Descripción"><?=$Row7["descripcion"]?></textarea>
						<br>
						<h5 class="card-title">Salario</h5>
						<select class="form-control" name="SALARY">
							<?php
								$Code=$Row7["salario"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
									<option value="<?=$Row7['salario']?>" selected><?=$Row2['descripcion']?></option>
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
						<input type="text" class="form-control"  value="<?=$Row7["experienciaRequerida"]?>" name="EXPERIENCE" placeholder="Experiencia requerida">
						<br>
						<?php
						$Fecha=date("Y")."-".date("m")."-".date("d");
						?>
						<h5 class="card-title">Fecha de publicación</h5>
						<input type="date" class="form-control"  value="<?=$Row7["fechaPublicacion"]?>" min="<?=$Fecha?>" id="INIT" onchange="fec()" name="INIT">
						<br>
					</div>
					<div class="col-md-6">
						<h5 class="card-title">Tipo de contrato</h5>
						<select class="form-control" name="CONTRACT">
							<?php
								$Code=$Row7["tipoContratoCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
									<option value="<?=$Row7['tipoContratoCodigo']?>" selected><?=$Row2['descripcion']?></option>
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
						<textarea class="form-control" name="FUNCTIONS" placeholder="Funciones"><?=$Row7["funciones"]?></textarea>
						<br>
						<h5 class="card-title">Ubicación</h5>
						<select class="selectpicker form-control" name="LOCATION" data-live-search="true">
							<?php
								$Code=$Row7["mpioUbicacionCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
									<option value="<?=$Row7['mpioUbicacionCodigo']?>" selected><?=$Row2['descripcion']?></option>
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
						<input type="number" class="form-control"  value="<?=$Row7["numeroVacantes"]?>" name="VACANT" placeholder="Número de vacantes">
						<br>
						<h5 class="card-title">Fecha de cierre</h5>
						<input type="date"  value="<?=$Row7["fechaCierre"]?>" class="form-control" id="CLOSE" name="CLOSE">
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
				<center><input type="submit" class="btn btn-primary" name="" value="Actualizar Vacante" ></center>
			</form>
		</div>
	</div>
</div>