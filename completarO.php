<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			Completar datos
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data" action="controller/CompleteO.php">
				<div class="row">
					<div class="col-md-6">
						<h5 class="card-title">Primer nombre</h5>
						<input type="text" class="form-control" name="FIRSTNAME" placeholder="Primer Nombre">
						<br>
						<h5 class="card-title">Segundo nombre</h5>
						<input type="text" class="form-control" name="SECONDNAME" placeholder="Segundo Nombre">
						<br>
						<h5 class="card-title">Primer apellido</h5>
						<input type="text" class="form-control" name="LASTNAME1" placeholder="Primer Apellido">
						<br>
						<h5 class="card-title">Segundo apellido</h5>
						<input type="text" class="form-control" name="LASTNAME2" placeholder="Segundo Apellido">
						<br>
						<h5 class="card-title">Fecha de nacimiento</h5>
						<input type="date" class="form-control" name="BIRTHDATE" placeholder="Fecha de nacimiento">
						<br>
						<h5 class="card-title">Teléfono 1</h5>
						<input type="number" class="form-control" name="PHONE1" placeholder="Teléfono 1">
						<br>
						<h5 class="card-title">Teléfono 2</h5>
						<input type="number" class="form-control" name="PHONE2" placeholder="Teléfono 2">
						<br>
						<h5 class="card-title">Municipio Nacimiento</h5>
						<select class="selectpicker form-control" name="TOWN" data-live-search="true">
							<option disabled selected>Municipio Nacimiento</option>
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
						<h5 class="card-title">Genero</h5>
						<select class="form-control" onchange="onoffmilitary()" id="GENDER" name="GENDER">
							<option disabled selected>Genero</option>
							<?php
							$Q="SELECT * from codigos where id_padre=18";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Dirección</h5>
						<input type="text" class="form-control" name="ADDRESS" placeholder="Dirección">
						<br>
						<h5 class="card-title">Municipio vivienda</h5>
						<select class="selectpicker form-control" name="TOWN2" data-live-search="true">
							<option disabled selected>Municipio vivienda</option>
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
						<h5 class="card-title">Estado civil</h5>
						<select class="form-control" name="MARITAL">
							<option disabled selected>Estado civil</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2260";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Extranjero</h5>
						<select class="form-control" id="FOREIGNER" onchange="onoffcountry()" name="FOREIGNER">
							<option disabled selected>Extranjero</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2199";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title" id="COUNTRY" style="display: none;">País</h5>
						<select class="form-control" id="COUNTRY2" style="display: none;" name="COUNTRY">
							<option disabled selected>País</option>
							<?php
							$Q="SELECT * from codigos where id_padre=4504";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>













					</div>
					<div class="col-md-6">

						<h5 class="card-title">Etnia</h5>
						<select class="form-control" name="ETHNICITY">
							<option disabled selected>Etnia</option>
							<?php
							$Q="SELECT * from codigos where id_padre=4751";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Personas a cargo</h5>
						<input type="number" class="form-control" name="PEOPLE" placeholder="Personas a cargo" >
						<br>
						<h5 class="card-title">Zona</h5>
						<select class="form-control" name="ZONE">
							<option disabled selected>Zona</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2231";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Estrato</h5>
						<select class="form-control" name="STRATUM">
							<option disabled selected>Estrato</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2252";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title">Tiempo buscando trabajo (Meses)</h5>
						<input type="number" class="form-control" name="TIME" placeholder="Tiempo buscando trabajo (Meses)">
						<br>
						<h5 class="card-title">Rango sueldo</h5>
						<select class="form-control" name="SALARY">
							<option disabled selected>Rango sueldo</option>
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
						<h5 class="card-title" style="display: none;">Orientación ocupacional</h5>
						<select class="form-control" style="display: none;" name="ORIENTATION">
							<option disabled selected>Orientación ocupacional</option>
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
						<h5 class="card-title">Victima conflicto</h5>
						<select class="form-control" name="VICTIM">
							<option disabled selected>Victima conflicto</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2199";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
						<h5 class="card-title" id="MILITARY" style="display: none;">¿Tiene libreta militar?</h5>
						<select class="form-control" id="MILITARY2"  style="display: none;" name="MILITARY">
							<option disabled selected>¿Libreta militar?</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2199";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>
							<h5 class="card-title">Archivo</h5>
							<input type="file" name="FILE" accept=".mp3,.mp4,.avi" class="form-control">
							<br>
							<h5 class="card-title" id="MILITARY" style="display: none;">¿Tiene libreta militar?</h5>
							<select class="form-control" id="MILITARY2"  style="display: none;" name="MILITARY">
								<?php
								$Code=$Row5["libretaMilitar"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['libretaMilitar']?>" selected><?=$Row2["descripcion"]?></option>
								<?php
								$Q="SELECT * from codigos where id_padre=2199";
								foreach ($db->query($Q) as $Row) {
									?>
									<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
									<?php
								}
								?>

							</select>
							<br>
						<h5 class="card-title">Discapacidad</h5>
						<select class="form-control" id="DISABILITY2" onchange="onoffdisability()" name="DISABILITY">
							<option disabled selected>¿Discapacidad?</option>
							<?php
							$Q="SELECT * from codigos where id_padre=2199";
							foreach ($db->query($Q) as $Row) {
								?>
								<option value="<?=$Row['id']?>"><?=$Row["descripcion"]?></option>
								<?php
							}
							?>

						</select>
						<br>

						<label style="display: none;" id="D11" class=""><input type="checkbox" class="" style="display: none;" id="D1" name="DISABILITYF" placeholder="Discapacidad física"> Discapacidad física</label>
						<br>
						<br>

						<label style="display: none;" id="D22" class=""><input type="checkbox" class="" style="display: none;" id="D2" name="DISABILITYV" placeholder="Discapacidad visual"> Discapacidad visual</label>
						<br>
						<br>

						<label style="display: none;" id="D33" class=""><input type="checkbox" class="" style="display: none;" id="D3" name="DISABILITYA" placeholder="Discapacidad audítiva"> Discapacidad audítiva</label>
						<br>
						<br>

						<label style="display: none;" id="D66" class=""><input type="checkbox" class="" id="D6" style="display: none;" name="DISABILITYVE" placeholder="Discapacidad verbal"> Discapacidad verbal</label>
						<br>
						<br>

						<label style="display: none;" id="D44" class=""><input type="checkbox" class="" style="display: none;" id="D4" name="DISABILITYI" placeholder="Discapacidad intelectual"> Discapacidad intelectual</label>
						<br>
						<br>

						<label style="display: none;" id="D55" class=""><input type="checkbox" class="" style="display: none;" id="D5" name="DISABILITYP" placeholder="Discapacidad psicosocial"> Discapacidad psicosocial</label>

						<br>
						<br>







					</div>
				</div>
				<br>
				<center><input type="submit" class="btn btn-primary" name="" value="Completar información" ></center>
			</form>
		</div>
	</div>
</div>