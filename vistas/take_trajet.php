<?php
if (isset($_GET['id'])) {
    require_once './inc/conexion.php';
    $conexion->set_charset("utf8");

    $consulta = "SELECT credit FROM credi WHERE usuario_id = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $_SESSION['usuario_id']);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $credit = $resultado->fetch_assoc();

    $id = $_GET['id'];
    $query = "SELECT usuario_id, origen, destino, fecha_salida, hora_salida, fecha_llegada, hora_llegada, duracion_estimada, lugares_disponibles, precio, detalles FROM destinos WHERE id = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
?>
    <link rel="stylesheet" href="./CSS/styleB.css">
    <style>
        .containerForm {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            /*padding: 20px;*/
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            /*box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);*/
            text-align: left;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: left;
            font-size: 16px;
            margin-bottom: 10px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <body>
        <div class="containerForm">
            <form id="formTrayecto">
                <h1>Prendre le trajet</h1>
                <input type="hidden" name="usuario_id" id="usuario_id" value="<?= $_SESSION['usuario_id'] ?>">
                <input type="hidden" name="destinos_id" id="destinos_id" value="<?= $id ?>">
                <h3>Crédits : <?= htmlspecialchars($credit['credit']) ?> Є</h3>
                <p>Origine : <?= htmlspecialchars($row['origen']) ?></p>
                <p>Destination : <?= htmlspecialchars($row['destino']) ?></p>
                <p>Date de départ : <?= htmlspecialchars($row['fecha_salida']) ?></p>
                <p>Heure de départ : <?= htmlspecialchars($row['hora_salida']) ?></p>
                <p>Date d'arrivée : <?= htmlspecialchars($row['fecha_llegada']) ?></p> 
                <p>Heure d'arrivée : <?= htmlspecialchars($row['hora_llegada']) ?></p>
                <p>Durée estimée : <?= htmlspecialchars($row['duracion_estimada']) ?></p>
                <p>Places disponibles : <?= htmlspecialchars($row['lugares_disponibles']) ?></p>
                <p>Prix : <?= htmlspecialchars($row['precio']) ?> Є</p>
                <!--<p>Détails : <?= htmlspecialchars($row['detalles']) ?></p>-->
                <label for="places_prendre">Places a prendre</label>
                <input type="number" name="places_prendre" id="places_prendre"
        min="1" max="<?= (int)$row['lugares_disponibles'] ?>" required>

                <button type="submit">Prendre  mes places</button>
            </form>
        </div>
        <script>
            document.getElementById("formTrayecto").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);

        fetch('./PHP/actualizar_trayecto.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text()) // 👈 primero como texto
        .then(text => {
            console.log("Respuesta cruda:", text);
            const data = JSON.parse(text); // 👈 luego parseas tú
            alert(data.message);
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error("Error al procesar JSON:", error);
            alert("Error del servidor.");
        });
        });
        </script>
    </body>
<?php
    } else {
        echo "<p>No se encontró el trayecto con ese ID.</p>";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "<p>No se recibió un ID válido.</p>";
}
?>


