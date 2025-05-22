<script>
            document.getElementById("formTrayecto").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('./PHP/actualizar_trayecto.php', {
                method: 'POST',
                body: formData
                
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    // Opcional: actualizar visualmente los créditos y lugares disponibles sin recargar
                    location.reload(); // o actualizar manualmente el DOM
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error del servidor.");
            });
        });
        </script>