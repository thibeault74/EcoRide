<?php 
require_once './inc/conexion.php'; 
require_once './inc/link.php';


if(isset($_GET['id'])) {
    
    $id = $_GET['id'];
    
   
    $query = "SELECT * FROM voiture WHERE id = ?";
    
 
    $stmt = $conexion->prepare($query);
    
 
    $stmt->bind_param("s", $id);
     

    $stmt->execute();
    
    
    $result = $stmt->get_result();
    
  
    if($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $usuario_id = $row['usuario_id'];
        $marca = $row['marca'];
        $modele = $row['modele'];
        $immatriculation = $row['immatriculation'];
        $energie = $row['energie'];
        $Places = $row['Places'];
        $couleur = $row['couleur'];
        $date_immatriculation = $row['date_immatriculation'];
        $photo = $row['photo'];
        $created_at = $row['created_at'];

        $queryUsuario = "SELECT nombre, apellidoPat FROM usuarios WHERE id = ?";
        $stmtUsuario = $conexion->prepare($queryUsuario);
        $stmtUsuario->bind_param("s", $usuario_id);
        $stmtUsuario->execute();
        $resultUsuario = $stmtUsuario->get_result();

        if($resultUsuario->num_rows > 0) {
            $usuarioData = $resultUsuario->fetch_assoc();
            $nombreCompleto = $usuarioData['nombre'] . ' ' . $usuarioData['apellidoPat'];
        } else {
            $nombreCompleto = "Utilisateur non trouvé";
        }

    } else {
        
        header('Location: index.php?p=/view_voiture'); 
        exit; 
    }
} else {
    
    header('Location: index.php?p=/view_voiture'); 
    exit; 
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
        

        <form id="userForm" method="post" action="actualizar_voiture.php">
            <h1>Edit voiture</h1><br>
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
            
            <label for="usuario_id">Propriétaire :</label>
            <input type="text" id="nombreCompleto" name="nombreCompleto" value="<?php echo $nombreCompleto; ?>" readonly><br>
            <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>">

            <label for="marca">Marque :</label>
            <input type="text" id="marca" name="marca" value="<?php echo $marca; ?>" required><br>

            <label for="modele">modele:</label>
            <input type="text" id="modele" name="modele" value="<?php echo $modele; ?>" required><br>

            <label for="immatriculation">Immatriculation:</label>
            <input type="text" id="immatriculation" name="immatriculation" value="<?php echo $immatriculation; ?>" required><br>

            <label for="energie">Energie :</label>
            <input type="text" id="energie" name="energie" value="<?php echo $energie; ?>" required><br>

            <label for="Places">Places :</label>
            <input type="text" id="Places" name="Places" value="<?php echo $Places; ?>" required><br>

            <label for="couleur">Couleur :</label>
            <input type="text" id="couleur" name="couleur" value="<?php echo $couleur; ?>" required><br>

            <label for="date_immatriculation">Date immatriculation:</label>
            <input type="date" id="date_immatriculation" name="date_immatriculation" value="<?php echo $date_immatriculation; ?>" required><br>

            <label for="created_at">Date d'inscription:</label>
            <input type="text" id="created_at" name="created_at" value="<?php echo $created_at; ?>" readonly><br>

            <label for="photo">Photo:</label>
            <img src="vistas/ver_voiture.php?id=<?php echo $id; ?>" alt="Foto" style="width:300px;height:200px;object-fit:cover;border-radius:5px;">
            <input type="file" id="photo" name="photo" accept="image/jpeg"><br>

            <label for="Places">Places :</label>
            <input type="text" id="Places" name="Places" value="<?php echo $Places; ?>" required><br>

            <button type="button" onclick="guardarCambios()">mettre à jour le véhicule</button>
            <button type="button"><a class="<?php echo ($pagina == 'eliminar_voiture' ? 'active' : ''); ?>" href="index.php?p=/view_voiture">Retour</a></button>
        </form>
    </div>
</body>