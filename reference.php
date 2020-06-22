<div class="container-fluid">

	<div class="card" class="col-md-6">
		<div class="card-header">
			Referencias
		</div>
		<div class="card-body">
			<form method="POST" action="controller/Ref.php" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						
						<div class="form-group">
							<h5>Nombre</h5>
							<input type="text" class="form-control" placeholder="Nombre" name="NAME">
						</div>
						<div class="form-group">
							<h5>Tipo de referencia</h5>
							<select name="TYPE" class="form-control">
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
							<input type="number" class="form-control" placeholder="Teléfono" name="PHONE">
						</div>
						<div class="form-group">
							<h5>Celular</h5>
							<input type="number" class="form-control" placeholder="Celular" name="CELL">
						</div>
						
					</div>
					<div class="col-md-6">

						<div class="form-group">
							<h5>Dirección</h5>
							<input type="text" class="form-control" placeholder="Dirección" name="ADDRESS">
						</div>
						<div class="form-group">
							<h5>Ocupación</h5>
							<input type="text" class="form-control" placeholder="Ocupación" name="OCUPATION">
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