<div id="accordion">
	<div class="card">
		<div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        
	          Experiencia
	        
	      </h5>
	    </div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>Empresa</th>
						<th>Teléfono</th>
						<th>Municipio</th>
						<th>Pasantia</th>
						<th>Fecha Ingreso</th>
						<th>Empleo Actual</th>
						<th>Fecha Salida</th>
						<th>Ocupación</th>
						<th>Cargo</th>
						<th>Logros</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$Q="SELECT * from oferentes_experiencia where idOferente=$USERID";
					foreach ($db->query($Q) as $Row) {
						?>
						<tr>
							<td><?=$Row["empresa"]?></td>
							<td><?=$Row["telefono"]?></td>
							<td>
								<?php
								$mun=$Row["municipio"];
								$Q1="SELECT * from codigos where id='$mun'";
								foreach ($db->query($Q1) as $Row1) {
									echo $Row1["descripcion"];
									break;
								}
								?>
							</td>
							<td>
								<?php
								if($Row["pasantia"]=="2200")
								{
									echo "SI";
								}else
								{
									echo "NO";
								}
								?>
							</td>
							<td><?=$Row["fechaIngreso"]?></td>
							<td>
								<?php
								if($Row["empleoActual"]=="2200")
								{
									echo "SI";
								}else
								{
									echo "NO";
								}
								?>
							</td>
							<td><?=$Row["fechaSalida"]?></td>
							<td>
								<?php
									$ocu=$Row["ocupacion"];
									$Q1="SELECT * from codigos where id=$ocu";
									foreach ($db->query($Q1) as $Row1) {
										echo $Row1["descripcion"];
										break;
									}
								?>
								
							</td>
							<td><?=$Row["cargo"]?></td>
							<td><?=substr($Row["logros"],0,10)?></td>
							
							<td>
								<form method="POST" action="controller/DeleteExp.php">
									<input type="hidden" name="ID" value="<?=$Row['id']?>">
									<input type="submit" class="btn btn-danger" value="Eliminar" name="">
								</form>
								<form method="GET" action="EditExp.php">
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