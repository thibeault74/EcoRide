<?php
	


	# clean the var from JS and SQL code #
	function limpiar_cadena($cadena){
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
	}

	/*function registrarVisita($conexion) {
		$ip = $_SERVER['REMOTE_ADDR']; // IP del usuario
		$pagina = $_SERVER['REQUEST_URI']; // Página que visitó
		$url = "http://ip-api.com/json/$ip?fields=country"; // API para obtener el país
		$respuesta = file_get_contents($url);
		$datos = json_decode($respuesta, true);
		$pais = $datos['country'] ?? 'Desconocido';
	
		
		// Guardar en la base de datos
		$stmt = $conexion->prepare("INSERT INTO visitas (ip, pais, pagina) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $ip, $pais, $pagina);
		$stmt->execute();
		$stmt->close();
	
		return ["pais" => $pais, "pagina" => $pagina];
		}
		
		// Conectar a la base de datos
		require_once 'conexion.php';
		if ($conexion->connect_error) {
			die("Error de conexión: " . $conexion->connect_error);
		}
		
		// Registrar la visita
		$datosUsuario = registrarVisita($conexion);
		//echo "Usuario de: " . $datosUsuario['pais'] . "<br>";
		//echo "Página visitada: " . $datosUsuario['pagina'];
		
		//$conexion->close();*/
	?>
