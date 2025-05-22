<?php 
require_once './inc/conexion.php'; 
require_once './inc/link.php';

// Verifica si se está recibiendo un ID de usuario para editar
if(isset($_GET['id'])) {
    // Obtiene el ID del usuario a editar
    $id = $_GET['id'];
    
    // Consulta para obtener los datos del usuario a editar
    $query = "SELECT * FROM usuarios WHERE id = ?";
    
    // Preparar la consulta
    $stmt = $conexion->prepare($query);
    
    // Vincular parámetros
    $stmt->bind_param("s", $id);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener el resultado
    $result = $stmt->get_result();
    
    // Verifica si se encontró algún usuario con el ID proporcionado
    if($result->num_rows > 0) {
        // Obtiene los datos del usuario
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $nombre = $row['nombre'];
        $apellidoPat = $row['apellidoPat'];
        $fechaNac = $row['fechaNac'];
        $telephone = $row['telephone'];
        $adresse = $row['adresse'];
        $photo = $row['photo'];
        $email = $row['email'];
        $level2 = $row['level2'];
        $confirmado = $row['confirmado'];
        $activo = $row['activo'];
        $fecha_registro = $row['fecha_registro'];
        
        $tituloFormulario = "Modifier l'utilisateur";
        $botonAccion = 'Enregistrer les modifications';
    } else {
        // Si no se encuentra el usuario, redirecciona o muestra un mensaje de error
        header('Location: lista_usuarios.php'); // Redirecciona a la página de lista de usuarios
        exit; // Termina la ejecución del script
    }
} else {
    // Si no se proporciona un ID, redirecciona o muestra un mensaje de error
    header('Location: lista_usuarios.php'); // Redirecciona a la página de lista de usuarios
    exit; // Termina la ejecución del script
}
?>
<link rel="stylesheet" href="./CSS/styleB.css">
<style>
    body {
        margin-top: 5%;
    }
</style>
<body>
    <div class="containerForm">
        <h1><?php echo $tituloFormulario; ?></h1>

        <form id="userForm" method="post" action="actualizar_usuario.php">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
            
            <label for="nombre">Prenom :</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>

            <label for="apellidoPat">Nom:</label>
            <input type="text" id="apellidoPat" name="apellidoPat" value="<?php echo $apellidoPat; ?>" required><br>

            <label for="fechaNac">Date de naissance:</label>
            <input type="date" id="fechaNac" name="fechaNac" value="<?php echo $fechaNac; ?>" required><br>

            <label for="telephone">Telephone:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $telephone; ?>" required><br>

            <label for="photo">Photo:</label>
            <img src="vistas/ver_imagen.php?id=<?php echo $id; ?>" alt="Foto" style="width:50px;height:50px;object-fit:cover;border-radius:5px;">
            <input type="file" id="photo" name="photo" accept="image/jpeg"><br>

            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $adresse; ?>" required><br>

            <label for="level2">Niveau utilisateur :</label>
            <select id="level2" name="level2">
                <option value="1" <?php if($level2 == 1) echo 'selected'; ?>>Utilisateur</option>
                <option value="2" <?php if($level2 == 2) echo 'selected'; ?>>Conducteur</option>
                <option value="3" <?php if($level2 == 3) echo 'selected'; ?>>Employé</option>
                <option value="3" <?php if($level2 == 4) echo 'selected'; ?>>Administrateur</option>
            </select>

            <label for="confirmado">Confirmé:</label>
            <select name="confirmado" id="confirmado">
                <option value="1" <?php if($confirmado == 1) echo 'selected'; ?>>Confirmé</option>
                <option value="0" <?php if($confirmado == 0) echo 'selected'; ?>>Non confirmé</option>
            </select>

            <label for="activo">Actif:</label>
            <select name="activo" id="activo">
                <option value="1" <?php if($activo == 1) echo 'selected'; ?>>Actif</option>
                <option value="0" <?php if($activo == 0) echo 'selected'; ?>>Inactif</option>
            </select>

            <button type="button" onclick="guardarCambios()">mettre à jour l'utilisateur</button>
            <button type="button"><a class="<?php echo ($pagina == 'eliminar_usuarios' ? 'active' : ''); ?>" href="index.php?p=/view_usuarios">Retour</a></button>
        </form>
    </div>
</body>
