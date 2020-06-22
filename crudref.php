<div id="accordion">
	<div class="card">
		<div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        
	          Referencias
	        
	      </h5>
	    </div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Tipo de referencia</th>
						<th>Teléfono</th>
						<th>Celular</th>
						<th>Dirección</th>
						<th>Ocupación</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$Q="SELECT * from oferentes_referencias where idOferente=$USERID";
					foreach ($db->query($Q) as $Row) {
						?>
						<tr>
							<td><?=$Row["nombre"]?></td>
							<td>
								<?php
								$c=$Row["tipoReferencia"];
								$Q="SELECT * from codigos where id=$c";
								$Row2=$db->query($Q);
								$Row2=$Row2->fetch();
								echo $Row2["descripcion"];
								?>
							</td>							
							<td><?=$Row["telefono"]?></td>
							<td><?=$Row["celular"]?></td>
							<td><?=$Row["direccion"]?></td>
							<td><?=$Row["ocupacion"]?></td>
							<td>
								<form method="POST" action="controller/DeleteRef.php">
									<input type="hidden" name="ID" value="<?=$Row['id']?>">
									<input type="submit" class="btn btn-danger" value="Eliminar" name="">
								</form>
								<form method="GET" action="EditRef.php">
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
									<a href="files/<?=$ruta?>"  target="_BLANK" class="btn btn-info">Archivo </a>
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