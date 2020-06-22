<div id="accordion">
	<div class="card">
		<div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        
	          Vacantes publicadas
	        
	      </h5>
	    </div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Salario</th>
						<th>Tipo Contrato</th>
						<th>Municipio</th>
						<th># Vacantes</th>
						<th>Funciones</th>
						<th>Exp Requerida</th>
						<th>Fecha Publicación</th>
						<th>Fecha Cierre</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$Q="SELECT * from demandantes_vacantes where idDemandante=$USERID";
					foreach ($db->query($Q) as $Row) {
						?>
						<tr>
							<td><?=$Row["nombreCargo"]?></td>
							<td><?=$Row["descripcion"]?></td>
							<td><?=$Row["salario"]?></td>
							
							<td>
								<?php
									$cod=$Row["tipoContratoCodigo"];
									$Q1="SELECT * from codigos where id=$cod";
									foreach ($db->query($Q1) as $Row1) {
										echo $Row1["descripcion"];
										break;
									}
								?>
								
							</td>
							<td>
								<?php
									$cod=$Row["mpioUbicacionCodigo"];
									$Q1="SELECT * from codigos where id=$cod";
									foreach ($db->query($Q1) as $Row1) {
										echo $Row1["descripcion"];
										break;
									}
								?>
								
							</td>
							<td><?=$Row["numeroVacantes"]?></td>
							
							<td><?=$Row["funciones"]?></td>
							
							<td><?=$Row["experienciaRequerida"]?></td>
							<td><?=$Row["fechaPublicacion"]?></td>
							<td><?=$Row["fechaCierre"]?></td>
							<td>
								<form method="POST" action="controller/DeleteVac.php">
									<input type="hidden" name="ID" value="<?=$Row['id']?>">
									<input type="submit" class="btn btn-danger" value="Eliminar" name="">
								</form>
								<form method="GET" action="EditVac.php">
									<input type="hidden" name="ID" value="<?=$Row['id']?>">
									<input type="submit" class="btn btn-warning" value="-Editar- " name="">
								</form>
								<?php
								if($Row["idArchivo"]!="")
								{
									$idar=$Row["idArchivo"];
									$Q01="SELECT * from archivos where id=$idar";
									$Row01=$db->query($Q01);
									$Row01=$Row01->fetch();
									$ruta=$Row01["nombre"];
									?>
									<a href="files/<?=$ruta?>" target="_BLANK" class="btn btn-info">Archivo </a>
									<?php
								}
								?>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>

	</div>

</div>