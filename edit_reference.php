<?php
$ID=$_GET["ID"];
$Q7="SELECT * from oferentes_referencias where id=$ID";
$Row7=$db->query($Q7);
$Row7=$Row7->fetch();
?>
<div class="container-fluid">

	<div class="card" class="col-md-6">
		<div class="card-header">
			Referencias
		</div>
		<div class="card-body">
			<form method="POST" action="controller/EditRef.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						
						<div class="form-group">
							<h5>Nombre</h5>
							<input type="text" class="form-control" placeholder="Nombre" value="<?=$Row7['nombre']?>" name="NAME">
						</div>
						<div class="form-group">
							<h5>Tipo de referencia</h5>
							<select name="TYPE" class="form-control">
							<?php
								$Code=$Row7["tipoReferencia"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
									<option value="<?=$Row7['tipoReferencia']?>" selected><?=$Row2['descripcion']?></option>
									<?php
									$Q="SELECT * from codigos where id_padre=2219";
									foreach ($db->query($Q) as $Row) {
										?>
										<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
										<?php
									}
									?>

								</select>
						</div>
						<div class="form-group">
							<h5>Teléfono</h5>
							<input type="number" class="form-control" placeholder="Teléfono" value="<?=$Row7['telefono']?>" name="PHONE">
						</div>
						<div class="form-group">
							<h5>Celular</h5>
							<input type="number" class="form-control" placeholder="Celular" value="<?=$Row7['celular']?>" name="CELL">
						</div>
						
					</div>
					<div class="col-md-6">

						<div class="form-group">
							<h5>Dirección</h5>
							<input type="text" class="form-control" placeholder="Dirección" value="<?=$Row7['direccion']?>" name="ADDRESS">
						</div>
						<div class="form-group">
							<h5>Ocupación</h5>
							<input type="text" class="form-control" placeholder="Ocupación" value="<?=$Row7['ocupacion']?>" name="OCUPATION">
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