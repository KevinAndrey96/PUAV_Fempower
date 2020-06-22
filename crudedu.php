<div id="accordion">
	<div class="card">
		<div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        
	          Educación
	        
	      </h5>
	    </div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>Capacitacion</th>
						<th>Formal</th>
						<th>Titulo</th>
						<th>Institucion</th>
						<th>Modalidad</th>
						<th>Año-Mes finalización</th>
						<th>¿Terminó?</th>
						<th>Meses Estudio</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$Q="SELECT * from oferentes_educacion where idOferente=$USERID";
					foreach ($db->query($Q) as $Row) {
						?>
						<tr>
							<td>
								<?php
								if($Row["capacitacionTrabajo"]=="2200")
								{
									echo "SI";
								}else
								{
									echo "NO";
								}
								?>
							</td>
							<td>
								<?php
								if($Row["formal"]=="2200")
								{
									echo "SI";
								}else
								{
									echo "NO";
								}
								?>
							</td>
							<td><?=$Row["titulo"]?></td>
							<td><?=$Row["institucion"]?></td>
							<td>
								<?php
								if($Row["presencialVirtual"]=="P")
								{
									echo "Presencial";
								}else
								{
									echo "Virtual";
								}
								?>
							</td>
							
							<td><?=$Row["anoFinalizacion"]."-".$Row["mesFinalizacion"]?></td>
							<td>
								<?php
								if($Row["termino"]=="2200")
								{
									echo "SI";
								}else
								{
									echo "NO";
								}
								?>
							</td>
							<td><?=$Row["mesesEstudio"]?></td>
							<td>
								<form method="POST" action="controller/DeleteEdu.php">
									<input type="hidden" name="ID" value="<?=$Row['id']?>">
									<input type="submit" class="btn btn-danger" value="Eliminar" name="">
								</form>
								<form method="GET" action="EditEdu.php">
									<input type="hidden" name="ID" value="<?=$Row['id']?>">
									<input type="submit" class="btn btn-warning" value="-Editar- " name="">
								</form>
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