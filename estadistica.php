<!DOCTYPE html>
<html>
<head>
  <title>Gráfico de Películas por Género</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* Estilo para el div contenedor */
    #chartContainer {
      width: 500px;
      height: 500px;
    }
  </style>
</head>
<body>
  <!-- Div contenedor -->
  <div id="chartContainer">
    <!-- Canvas para el gráfico -->
    <canvas id="myChart"></canvas>
  </div>

  <script>
    // Datos de ejemplo (puedes reemplazarlos con tus propios datos)
    var labels = ['Acción', 'Comedia', 'Drama', 'Ciencia Ficción'];
    var data = [25, 30, 20, 15]; // Cantidad de películas por género

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Cantidad de Películas por Género',
          data: data,
          backgroundColor: 'skyblue',
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>


