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
</head>
<body>
    <section id="about-chart1" class="about">
        <div class="container">
            <h1>Client abonné confirmé / actif</h1>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </section>
    <section id="about-chart2" class="about">
        <div class="container">
            <h1>Nombre de clients abonnés par mois</h1>
            <div>
                <canvas id="myMonthChart"></canvas>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        
        fetch('./grafic/grafico_clientes.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map((_, index) => `Client ${index + 1}`);
                const values1 = data.map(item => item.confirmado);
                const values2 = data.map(item => item.activo);

                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Confirmé',
                                data: values1,
                                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Actif',
                                data: values2,
                                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: 'white'
                                }
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
                    }
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données clients :', error));

        // ----------- Segundo gráfico: Registros por mes -----------
        fetch('./grafic/grafico_registrosMes.php')
            .then(response => response.json())
            .then(data => {
                const monthNames = [
                    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
                ];

                const values = new Array(12).fill(0);
                data.forEach(item => {
                    values[item.mes - 1] = item.cantidad;
                });

                const ctx = document.getElementById('myMonthChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: monthNames,
                        datasets: [{
                            label: 'Enregistrements par mois',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.8)',
                            borderColor: 'rgba(75, 192, 192, 1)',
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
                    }
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
