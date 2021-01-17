<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/registro.css">
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.theme.css">
	<link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.12.1/jquery-ui.css">
</head>
<body>
        <form id="frmRegistro" class="box" method="POST" onsubmit="return agregarUsuarioNuevo()" autocomplete="off">
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Name" required="">
        <input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control" placeholder="Fecha de Nacimeinto" required="" readonly="">
        <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" required="">
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Nombre de usuario" required="">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
        <button class="btn btn-primary">Registrar</button>
        <span class="text-footer" style="color:#000">¿Ya tienes una cuenta? 
        <a href="index.php"style="color:#3498db">Login</a></span>
				
        </form>

	<script src="librerias/js/jquery-3.5.1.min.js"></script>
	<script src="librerias/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script src="librerias/sweetalert.min.js"></script>

	<script type="text/javascript">


		$(function(){
			var fechaA = new Date();
			var yyyy = fechaA.getFullYear();

			$("#fechaNacimiento").datepicker({

				changeMonth: true,
				changeYear: true,
				yearRange: '1990:' + yyyy,
				dateFormat: "dd-mm-yy"
			});
		});
		

		function agregarUsuarioNuevo() {
			$.ajax({
				method: "POST",
				data: $('#frmRegistro').serialize(),
				url: "procesos/usuario/registro/agregarUsuario.php",
				success:function(respuesta){
					console.log(respuesta);
					respuesta = respuesta.trim();
					if (respuesta == 1) {
						swal(":(", "FALLO AL AGREGAR", "error");
					}else if (respuesta == 2) {
						swal("NOMBRE DE USUARIO YA EXISTE, POR FAVOR, ESCRIBE OTRO!!!");
					}else {
						$('#frmRegistro')[0].reset();
						swal(":D", "Agregado con exito", "success");
					}
				}
			});

			return false;
		}
	</script>
</body>
</html>
