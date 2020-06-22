<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			Actualizar datos
		</div>
		<div class="card-body">
			<form method="POST" action="controller/EditD.php">
				<div class="row">
					<div class="col-md-6">
						<?php

						$Q5="SELECT * from demandantes_bi where id = $USERID";
						foreach ($db->query($Q5) as $Row5) {

						?>
						<h5 class="card-title">Razón Social</h5>
						<input type="text" class="form-control" name="NAME" value="<?=$Row5['razon_social']?>" placeholder="Razón Social">
						<br>
						<h5 class="card-title">Representante legal</h5>
						<input type="text" class="form-control" value="<?=$Row5['representante_legal']?>" name="LEGAL" placeholder="Representante legal">
						<br>
						<h5 class="card-title">Dirección</h5>
						<input type="text" class="form-control" value="<?=$Row5['direccion']?>" name="ADDRESS" placeholder="Dirección">
						<br>
						<h5 class="card-title">Nit</h5>
						<input type="number" value="<?=$Row5['nit']?>" class="form-control" name="NIT" placeholder="Dirección">
						<br>
						<h5 class="card-title">Municipio</h5>
						<select class="selectpicker form-control" name="TOWN" data-live-search="true">
							<?php
							$Code=$Row5["municipioCodigo"];
							$Q2="SELECT descripcion from codigos where id=$Code";
							$Row2=$db->query($Q2);
							$Row2=$Row2->fetch();
							?>
							<option value="<?=$Row5['municipioCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
							<?php
							$Code=$Row5["ciiu"];
							$Q2="SELECT descripcion from codigos where id=$Code";
							$Row2=$db->query($Q2);
							$Row2=$Row2->fetch();
							?>
							<option value="<?=$Row5['ciiu']?>" selected><?=$Row2["descripcion"]?></option>
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
						<input type="number" value="<?=$Row5['telefono']?>" class="form-control" name="PHONE" placeholder="Teléfono">
						<br>
						<h5 class="card-title">Celular</h5>
						<input type="number" value="<?=$Row5['celular']?>" class="form-control" name="CELL" placeholder="Celular">
						<br>
						<h5 class="card-title">URL Web</h5>
						<input type="url" value="<?=$Row5['url_web']?>" class="form-control" name="WEB" placeholder="Url Web">
						<br>
						<?php
}
						?>
					</div>
				</div>
				<br>
				<center><input type="submit" class="btn btn-primary" name="" value="Actualizar información" ></center>
			</form>
		</div>
	</div>
</div>