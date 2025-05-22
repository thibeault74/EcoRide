<?php
require_once './inc/conexion.php';
?>
<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="./CSS/styleB.css">
<body>
    <section id="about" class="about">
        <div class="container">
            <h1>Gráfico de visitas por páginas</h1>
            <div>
                <canvas id="graficoPaginas"></canvas>
            </div>
        </div>
    </section>
    <section id="about" class="about">
        <div class="container">
            <h1>Gráfico de visitas por países</h1>
            <div>
                <canvas id="graficoPaises"></canvas>
            </div>
        </div>
    </section>
</body>
<script>
fetch('./grafic/datos_paginas.php')
    .then(response => response.json())
    .then(data => {
        // Gráfico de visitas por página
        let ctxPaginas = document.getElementById('graficoPaginas').getContext('2d');
        new Chart(ctxPaginas, {
            type: 'bar',
            data: {
                labels: data.paginas,
                datasets: [{
                    label: 'Visitas por Página',
                    data: data.visitas,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Cambia el color de las etiquetas de la leyenda a blanco
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            color: 'white' // Cambia el color de las etiquetas del eje Y a blanco
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white' // Cambia el color de las etiquetas del eje X a blanco
                        }
                    }
                }
            }
        });

        // Gráfico de visitas por país
        let ctxPaises = document.getElementById('graficoPaises').getContext('2d');
        new Chart(ctxPaises, {
            type: 'pie',
            data: {
                labels: data.paises,
                datasets: [{
                    label: 'Visitas por País',
                    data: data.visitasPaises,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Cambia el color de las etiquetas de la leyenda a blanco
                        }
                    }
                }
            }
        });
    });
</script>
