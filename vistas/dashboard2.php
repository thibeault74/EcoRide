<?php
require_once "./inc/conexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Clients</title>
    <link rel="stylesheet" href="./CSS/styleB.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body>
    <section id="about-chart1" class="about">
        <div class="container">
            <h1>Nombre de trajets réalisés par mois</h1>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </section>
    <section id="about-chart2" class="about">
        <div class="container">
            <h1>Gains par mois</h1>
            <div>
                <canvas id="myMonthChart"></canvas>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // ----------- Primer gráfico: Clientes confirmados y activos -----------
        
fetch('./grafic/grafico_destinos.php')
    .then(response => response.json())
    .then(data => {
        const monthNames = [
            "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
        ];

        // Inicializa todos los meses con 0
        const values = new Array(12).fill(0);

        // Asigna los valores obtenidos del PHP a su mes correspondiente
        data.forEach(item => {
            if (item.mes >= 1 && item.mes <= 12) {
                values[item.mes - 1] = item.cantidad;
            }
        });

        const backgroundColors = [
            '#9b59b6', '#2980b9', '#27ae60', '#f39c12', '#c0392b', '#1abc9c',
            '#8e44ad', '#d35400', '#2ecc71', '#34495e', '#e67e22', '#7f8c8d'
        ];

        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [{
                    label: 'Sorties par mois',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: 'rgba(255,255,255,0.3)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        }
                    },
                    datalabels: {
                        color: 'white',
                        anchor: 'end',
                        align: 'top',
                        font: {
                            weight: 'bold'
                        },
                        formatter: value => value
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    })
    .catch(error => console.error('Erreur lors de la récupération des données mensuelles (destinos) :', error));

        // ----------- Segundo gráfico: Registros por mes -----------
        fetch('./grafic/grafico_gains.php')
    .then(response => response.json())
    .then(data => {
        const monthNames = [
            "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
        ];

        // Rellenar con 0 los 12 meses
        const values = new Array(12).fill(0);
        data.forEach(item => {
            values[item.mes - 1] = item.cantidad;
        });

        // Colores distintos por mes
        const backgroundColors = [
            '#e74c3c', '#8e44ad', '#3498db', '#1abc9c', '#f1c40f', '#e67e22',
            '#2ecc71', '#34495e', '#9b59b6', '#95a5a6', '#d35400', '#7f8c8d'
        ];

        const ctx = document.getElementById('myMonthChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [{
                    label: 'Enregistrements par mois',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: 'rgba(255, 255, 255, 0.5)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'
                        }
                    },
                    // Mostrar etiquetas numéricas arriba de las barras
                    datalabels: {
                        color: 'white',
                        anchor: 'end',
                        align: 'top',
                        font: {
                            weight: 'bold'
                        },
                        formatter: (value) => value
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    })
    .catch(error => console.error('Erreur lors de la récupération des données mensuelles :', error));
    });
    </script>
</body>
<style>
    body {
    background-color: #1e1e1e;
    color: white;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.about {
    padding: 40px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.container {
    width: 100%;
    max-width: 700px;
    background-color: rgba(55, 89, 255, 0.3);/* Fondo blanco semitransparente */
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
    padding: 30px;
    margin-bottom: 40px;
}

canvas {
    width: 100% !important;
    height: 400px !important;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.8em;
    color: #ffffff;
}
</style>
</html>