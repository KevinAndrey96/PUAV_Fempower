<?php
$ID=$_GET["ID"];
$Q7="SELECT * from oferentes_educacion where id=$ID";
$Row7=$db->query($Q7);
$Row7=$Row7->fetch();
?>

<div class="container-fluid">

	<div class="card" class="col-md-6">
		<div class="card-header">
			Educación
		</div>
		<div class="card-body">
			<form method="POST" action="controller/EditEdu.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" name="ID" value="<?=$ID?>">
						<div class="form-group">
							<h5>Capacitación trabajo</h5>
							<select class="form-control" name="CAPACITATION">
									<?php
									$Code=$Row7["capacitacionTrabajo"];
									$Q2="SELECT descripcion from codigos where id=$Code";
									$Row2=$db->query($Q2);
									$Row2=$Row2->fetch();
									?>
										<option value="<?=$Row7['capacitacionTrabajo']?>" selected><?=$Row2['descripcion']?></option>
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
									<?php
								$Code=$Row7["formal"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
									<option value="<?=$Row7['formal']?>" selected><?=$Row2['descripcion']?></option>
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
							<input type="text" class="form-control" value="<?=$Row7["titulo"]?>" placeholder="Título" name="TITLE">
						</div>
						<div class="form-group">
							<h5>Institución</h5>
							<input type="text" class="form-control" value="<?=$Row7["institucion"]?>" placeholder="Institución" name="INSTITUTION">
						</div>
						<div class="form-group">
							<h5>Modalidad</h5>
							<select class="form-control" name="MODALITY">
<?php
if($Row7["presencialVirtual"]=="P")
{
	$PV="Presencial";
}else
{
	$PV="Virtual";
}
?>
									<option value="<?=$Row7['presencialVirtual']?>" selected><?=$PV?></option>
								<option value="Presencial">Presencial</option>
								<option value="Virtual">Virtual</option>
							</select>
						</div>
						
						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<h5>Año finalización</h5>
							<input type="number" class="form-control" value="<?=$Row7["anoFinalizacion"]?>" placeholder="Año finalización" name="YEAR">
						</div>
						<div class="form-group">
							<h5>Mes Finalización</h5>
							<select class="form-control" name="MONTH">
								<option value="<?=$Row7['mesFinalizacion']?>" selected><?=$Row7['mesFinalizacion']?></option>
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
									
								<?php
								$Code=$Row7["termino"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
									<option value="<?=$Row7['termino']?>" selected><?=$Row2['descripcion']?></option>
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
							<input type="number" class="form-control"  value="<?=$Row7["mesesEstudio"]?>" placeholder="Meses estudio" name="MONTHS">
						</div>
						<div class="form-group">
							<h5>Archivo</h5>
							<input type="file" class="form-control" accept=".pdf" name="FILE">
						</div>
					</div>
				</div>
				<hr>
				<center><input type="submit" class="btn btn-primary" value="Actualizar información" name=""></center>
			</form>

		</div>
	</div>
</div>