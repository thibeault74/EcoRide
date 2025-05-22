<style>
    body {
    margin-top: 5%;
    background-image: url('./imagenes/fondoWEB.webp');
    background-repeat: repeat;
    background-attachment: fixed;
    }
    table {
    border-collapse: collapse;
    width: 100%;
    border: 2px solid #212738;
    margin-top: 20px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #ffffff;
    background-color: #588157;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
    border: 1px solid #212738;
    text-align: center;
    padding: 12px;
    }

    th {
    background-color: #3A5A40;
    color: white;
    font-weight: bold;
    }

    /*td{
    background-color: #CACD75;
    }*/

    tr:nth-child(even) {
    background-color: #658D38; /* Alterna los colores para las filas pares */
    }

    tr:hover {
    background-color: #FF695F; /* Resalta la fila al pasar el mouse */
    transition: background-color 0.3s ease;
    }

    /* Enlaces dentro de las celdas */
    td a {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    transition: background-color 0.3s ease, color 0.3s ease;
    }

    td a:hover {
    text-decoration: underline;
    color: #388E3C;
    }

    /* Mensaje cuando no hay registros */
    .no-records {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    color: #666;
    background-color: #f2f2f2;
    padding: 20px;
    }

    /* Botones de acción */
    td a.modifier {
    background-color: #1976D2; /* Azul */
    color: white;
    border: 1px solid #1976D2;
    }

    td a.modifier:hover {
    background-color: #0D47A1; /* Azul oscuro */
    border-color: #0D47A1;
    }

    td a.supprimer {
    background-color: #D32F2F; /* Rojo */
    color: white;
    border: 1px solid #D32F2F;
    }

    td a.supprimer:hover {
    background-color: #B71C1C; /* Rojo oscuro */
    border-color: #B71C1C;
    }
</style>
<body>
    <h1>Liste des voitures</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>propriétaire </th>
                <th>marque</th>
                <th>modèle</th>
                <th>immatriculation</th>
                <th>date immatriculation</th>
                <th>energie</th>
                <th>Places</th>
                <th>couleur</th>
                <th>Photo</th>
                <th>date d'inscription</th>
                <th>Modificar/Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php
            require_once './inc/conexion.php';

            $sql = "SELECT v.*, u.nombre, u.apellidoPat 
                    FROM voiture v
                    LEFT JOIN usuarios u ON v.usuario_id = u.id";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nombre"] . " " . $row["apellidoPat"] . "</td>";
                    echo "<td>" . $row["marca"] . "</td>";
                    echo "<td>" . $row["modele"] . "</td>";
                    echo "<td>" . $row["immatriculation"] . "</td>";
                    echo "<td>" . $row["date_immatriculation"] . "</td>";
                    echo "<td>" . $row["energie"] . "</td>";
                    echo "<td>" . $row["Places"] . "</td>";
                    echo "<td>" . $row["couleur"] . "</td>";
                    echo "<td><img src='vistas/ver_voiture.php?id=" . $row['id'] . "' alt='Foto' style='width:100px;height:70px;object-fit:cover;border-radius:5px;'></td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>";
                    echo "<a class='modifier''" . ($pagina == 'editar_usuarios' ? 'active' : '') . "' href='index.php?p=/editar_voiture&id=" . $row['id'] . "'>Modificar</a> | ";
                    echo "<a class='supprimer''" . ($pagina == 'eliminar_usuarios' ? 'active' : '') . "' href='index.php?p=/eliminar_voiture&?id=" . $row['id'] . "' onclick='return confirmarEliminacion()'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td class='no-records' colspan='29'>Aucun enregistrement trouvé.</td></tr>";
            }

            $conexion->close();
            ?>
        </tbody>
    </table>
    <script>
        function confirmarEliminacion() {
            return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
        }
    </script>
    <br>
</body>