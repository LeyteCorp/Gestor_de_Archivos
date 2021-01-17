
<?php 
session_start();
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();
$idUsuario = $_SESSION['idUsuario'];
$sql = "SELECT 
t_archivos.id_archivo AS idArchivo, 
t_usuarios.nombre AS nombreUsuario, 
t_categorias.nombre AS categoria, 
t_archivos.nombre AS nombreArchivo, 
t_archivos.tipo AS tipoArchivo, 
t_archivos.ruta AS rutaArchivo, 
t_archivos.fecha AS fechaArchivo
FROM 
t_archivos, 
t_usuarios, 
t_categorias 
where t_usuarios.id_usuario=t_archivos.id_usuario 
and t_categorias.id_categoria=t_archivos.id_categoria
and t_archivos.id_usuario='$idUsuario'";
$result = mysqli_query($conexion, $sql);

?>

<img src="" >

<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaGestorDataTable">
				<thead>
					<tr>
						<th align="center">Categoria</th>
						<th align="center">Nombre</th>
						<th align="center">Extensión de archivo</th>
						<th align="center">Descargar</th>
						<th align="center">Visualizar</th>
						<th align="center">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php 

						/*
							Arreglo de extensiones validas
						*/

							$extensionesValidas = array('png', 'jpg', 'pdf', 'mp3', 'mp4');

							while($mostrar = mysqli_fetch_array($result)) {

								$rutaDescarga = "../archivos/".$idUsuario."/".$mostrar['nombreArchivo'];
								$nombreArchivo = $mostrar['nombreArchivo'];
								$idArchivo = $mostrar['idArchivo'];
								?>
								<tr>
									<td align="center"><?php echo $mostrar['categoria'] ?></td>
									<td align="center"><?php echo $mostrar['nombreArchivo'] ?></td>
									<td align="center"><?php echo $mostrar['tipoArchivo'] ?></td>
									<td align="center">
										<a href="<?php echo $rutaDescarga; ?>" 
											download="<?php echo $nombreArchivo; ?>" class="btn btn-success btn-sm">
											<span class="fas fa-download"></span>
										</a>
									</td>
									<td align="center">
										<?php 
										for ($i=0; $i < count($extensionesValidas); $i++) {
											if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) {
										?>
										<span class="btn btn-primary btn-sm" 
												data-toggle="modal" 
												data-target="#visualizarArchivo" 
												onclick="obtenerArchivoPorId('<?php echo $idArchivo ?>')">
												<span class="fas fa-eye"></span>
											</span>
										<?php

										}
									}
									?>
								</td>
								<td align="center">
									<span class="btn btn-danger btn-sm" 
									onclick="eliminarArchivo('<?php echo $idArchivo?>')">
									<span class="fas fa-trash-alt"></span>
								</span>
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

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaGestorDataTable').DataTable();
	});
</script>
