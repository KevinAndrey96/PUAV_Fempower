<div id="accordion">
	<div class="card">
		<div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        
	          Actualizar datos
	        
	      </h5>
	    </div>
		<div class="card-body">
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			<form method="POST" enctype="multipart/form-data" action="controller/EditO.php">
				<div class="row">
					<div class="col-md-6">
						<?php
						
						$Q5="SELECT * from oferentes_bi where id = $USERID";
						foreach ($db->query($Q5) as $Row5) {
							
							?>
							<h5 class="card-title">Primer nombre</h5>
							<input type="text" class="form-control" name="FIRSTNAME" value="<?=$Row5["nombre1"]?>" placeholder="Primer Nombre">
							<br>
							<h5 class="card-title">Segundo nombre</h5>
							<input type="text" class="form-control" name="SECONDNAME" value="<?=$Row5["nombre2"]?>" placeholder="Segundo Nombre">
							<br>
							<h5 class="card-title">Primer apellido</h5>
							<input type="text" class="form-control" name="LASTNAME1" value="<?=$Row5["apellido1"]?>" placeholder="Primer Apellido">
							<br>
							<h5 class="card-title">Segundo apellido</h5>
							<input type="text" class="form-control" name="LASTNAME2" value="<?=$Row5["apellido2"]?>" placeholder="Segundo Apellido">
							<br>
							<h5 class="card-title">Fecha de nacimiento</h5>
							<input type="date" class="form-control" name="BIRTHDATE" value="<?=$Row5["fechaNacimiento"]?>" placeholder="Fecha de nacimiento">
							<br>
							<h5 class="card-title">Teléfono 1</h5>
							<input type="number" class="form-control" name="PHONE1" value="<?=$Row5["telefono1"]?>" placeholder="Teléfono 1">
							<br>
							<h5 class="card-title">Teléfono 2</h5>
							<input type="number" class="form-control" name="PHONE2" value="<?=$Row5["telefono2"]?>" placeholder="Teléfono 2">
							<br>
							<h5 class="card-title">Municipio Nacimiento</h5>
							<select class="selectpicker form-control" name="TOWN" data-live-search="true">
								<?php
								$Code=$Row5["municipioNacimientoCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['municipioNacimientoCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
								<?php
								$Code=$Row5["generoCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['generoCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
							<input type="text" class="form-control" name="ADDRESS" value="<?=$Row5["direccion"]?>" placeholder="Dirección">
							<br>
							<h5 class="card-title">Municipio vivienda</h5>
							<select class="selectpicker form-control" name="TOWN2" data-live-search="true">
								<?php
								$Code=$Row5["municipioViviendaCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['municipioViviendaCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
								<?php
								$Code=$Row5["estadoCivilCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5["estadoCivilCodigo"]?>" selected><?=$Row2["descripcion"]?></option>
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
								<?php
								$Code=$Row5["extranjeroCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['extranjeroCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
								<?php
								$Code=$Row5["paisCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['paisCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
								<?php
								$Code=$Row5["etnia"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['etnia']?>" selected><?=$Row2["descripcion"]?></option>
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
							<input type="number" class="form-control" name="PEOPLE" value="<?=$Row5["personasCargo"]?>" placeholder="Personas a cargo" >
							<br>
							<h5 class="card-title">Zona</h5>
							<select class="form-control" name="ZONE">
								<?php
								$Code=$Row5["zonaCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['zonaCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
								<?php
								$Code=$Row5["estratoCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['estratoCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
							<input type="number" class="form-control" name="TIME" value="<?=$Row5["tiempoBuscandoTrabajo"]?>" placeholder="Tiempo buscando trabajo (Meses)">
							<br>
							<h5 class="card-title">Rango sueldo</h5>
							<select class="form-control" name="SALARY">
								<?php
								$Code=$Row5["rangoSueldoCodigo"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['rangoSueldoCodigo']?>" selected><?=$Row2["descripcion"]?></option>
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
								<?php
								$Code=$Row5["orientacionOcupacional"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['orientacionOcupacional']?>" selected>Orientación ocupacional</option>
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
								<?php
								$Code=$Row5["victimaConflicto"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['victimaConflicto']?>" selected><?=$Row2["descripcion"]?></option>
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
							<h5 class="card-title">Video o audio de presentación personal</h5>
							<input type="file" name="FILE" accept=".mp3,.mp4,.avi" class="form-control">
							<br>
							<?php
								if($Row5["idArchivo"]!="")
								{
									$idar=$Row5["idArchivo"];
									$Q01="SELECT * from archivos where id=$idar";
									$Row01=$db->query($Q01);
									$Row01=$Row01->fetch();
									$ruta=$Row01["nombre"];
									?>
									<a href="files/<?=$ruta?>" class="btn btn-info form-control">Ver Archivo </a>
									<?php
								}
								?>
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
								<?php
								$Code=$Row5["discapacidad"];
								$Q2="SELECT descripcion from codigos where id=$Code";
								$Row2=$db->query($Q2);
								$Row2=$Row2->fetch();
								?>
								<option value="<?=$Row5['discapacidad']?>" selected><?=$Row2["descripcion"]?></option>
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


							<?php
							if($Row5["discapacidadFisica"]==0)
							{
								?>
								<label style="display: none;" id="D11" class=""><input type="checkbox" class="" style="display: none;" id="D1" name="DISABILITYF" value="<?=$Row5["discapacidadFisica"]?>" placeholder="Discapacidad física"> Discapacidad física</label>
								<?php
							}else
							{
								?>
								<label style="display: none;" id="D11" class=""><input checked type="checkbox" class="" style="display: none;" id="D1" name="DISABILITYF" value="<?=$Row5["discapacidadFisica"]?>" placeholder="Discapacidad física"> Discapacidad física</label>
								<?php
							}
							?>

							<br>
							<br>
							<?php
							if($Row5["discapacidadVisual"]==0)
							{
								?>
								<label style="display: none;" id="D22" class=""><input type="checkbox" class="" style="display: none;" id="D2" name="DISABILITYV" value="<?=$Row5["discapacidadVisual"]?>" placeholder="Discapacidad visual"> Discapacidad visual</label>
								<?php
							}else
							{
								?>
								<label style="display: none;" id="D22" class=""><input type="checkbox" class="" style="display: none;" id="D2" checked name="DISABILITYV" value="<?=$Row5["discapacidadVisual"]?>" placeholder="Discapacidad visual"> Discapacidad visual</label>
								<?php
							}
							?>

							
							<br>
							<br>
							<?php
							if($Row5["discapacidadAuditiva"]==0)
							{
								?>
								<label style="display: none;" id="D33" class=""><input type="checkbox" class="" style="display: none;" id="D3" name="DISABILITYA" value="<?=$Row5["discapacidadAuditiva"]?>" placeholder="Discapacidad audítiva"> Discapacidad audítiva</label>
								<?php
							}else
							{
								?>
								<label style="display: none;" id="D33" class=""><input type="checkbox" class="" style="display: none;" id="D3" checked name="DISABILITYA" value="<?=$Row5["discapacidadAuditiva"]?>" placeholder="Discapacidad audítiva"> Discapacidad audítiva</label>
								<?php
							}
							?>
							
							<br>
							<br>
							<?php
							if($Row5["discapacidadVerbal"]==0)
							{
								?>
								<label style="display: none;" id="D66" class=""><input type="checkbox" class="" id="D6" style="display: none;" name="DISABILITYVE" value="<?=$Row5["discapacidadVerbal"]?>" placeholder="Discapacidad verbal"> Discapacidad verbal</label>
								<?php
							}else
							{
								?>
								<label style="display: none;" id="D66" class=""><input type="checkbox" class="" id="D6" style="display: none;" checked name="DISABILITYVE" value="<?=$Row5["discapacidadVerbal"]?>" placeholder="Discapacidad verbal"> Discapacidad verbal</label>
								<?php
							}
							?>
							
							<br>
							<br>
							<?php
							if($Row5["discapacidadIntelectual"]==0)
							{
								?>
								<label style="display: none;" id="D44" class=""><input type="checkbox" class="" style="display: none;" id="D4" name="DISABILITYI" value="<?=$Row5["discapacidadIntelectual"]?>" placeholder="Discapacidad intelectual"> Discapacidad intelectual</label>
								<?php
							}else
							{
								?>
								<label style="display: none;" id="D44" class=""><input type="checkbox" class="" style="display: none;" id="D4" checked name="DISABILITYI" value="<?=$Row5["discapacidadIntelectual"]?>" placeholder="Discapacidad intelectual"> Discapacidad intelectual</label>
								<?php
							}
							?>
							
							<br>
							<br>
							<?php
							if($Row5["discapacidadPsicosocial"]==0)
							{
								?>
								<label style="display: none;" id="D55" class=""><input type="checkbox" class="" style="display: none;" id="D5" name="DISABILITYP" value="<?=$Row5["discapacidadPsicosocial"]?>" placeholder="Discapacidad psicosocial"> Discapacidad psicosocial</label>
								<?php
							}else
							{
								?>
								<label style="display: none;" id="D55" class=""><input type="checkbox" class="" style="display: none;" id="D5" checked name="DISABILITYP" value="<?=$Row5["discapacidadPsicosocial"]?>" placeholder="Discapacidad psicosocial"> Discapacidad psicosocial</label>
								<?php
							}
							?>
							

							<br>
							<br>


							<?php
							break;
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

</div>