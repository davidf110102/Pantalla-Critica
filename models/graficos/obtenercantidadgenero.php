 <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/proyectoWeb/models/conexion.php';

  
  $sql = "SELECT 'Drama' AS generoind, SUM(CASE WHEN genero LIKE '%Drama%' THEN 1 ELSE 0 END) AS cantidad
  FROM peliculas
  UNION ALL
  SELECT 'Ciencia Ficcion', SUM(CASE WHEN genero LIKE '%Ciencia Ficcion%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Suspenso', SUM(CASE WHEN genero LIKE '%Suspenso%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Fantasia', SUM(CASE WHEN genero LIKE '%Fantasia%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Aventura', SUM(CASE WHEN genero LIKE '%Aventura%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Thriller', SUM(CASE WHEN genero LIKE '%Thriller%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Accion', SUM(CASE WHEN genero LIKE '%Accion%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Comedia', SUM(CASE WHEN genero LIKE '%Comedia%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Misterio', SUM(CASE WHEN genero LIKE '%Misterio%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Belico', SUM(CASE WHEN genero LIKE '%Belico%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Crimen', SUM(CASE WHEN genero LIKE '%Crimen%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Animacion', SUM(CASE WHEN genero LIKE '%Animacion%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Terror', SUM(CASE WHEN genero LIKE '%Terror%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Romance', SUM(CASE WHEN genero LIKE '%Romance%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Historia', SUM(CASE WHEN genero LIKE '%Historia%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Biografia', SUM(CASE WHEN genero LIKE '%Biografia%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Western', SUM(CASE WHEN genero LIKE '%Western%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Familia', SUM(CASE WHEN genero LIKE '%Familia%' THEN 1 ELSE 0 END)
  FROM peliculas
  UNION ALL
  SELECT 'Musica', SUM(CASE WHEN genero LIKE '%Musica%' THEN 1 ELSE 0 END)
  FROM peliculas ORDER BY cantidad DESC";
  
  $result = $conn->query($sql);
  // Crear arrays para los datos del gráfico
  $labels = array();
  $data = array();

  // Obtener los datos de la consulta
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($labels, $row["generoind"]);
      array_push($data, $row["cantidad"]);
    }
  }

  // Cerrar la conexión
  $conn->close();

  // Convertir los arrays PHP a JavaScript
  echo "<script>";
  echo "var labels = " . json_encode($labels) . ";\n";
  echo "var data = " . json_encode($data) . ";\n";

  // Script de Chart.js para generar el gráfico
  echo "var ctx = document.getElementById('myChart').getContext('2d');";
  echo "var myChart = new Chart(ctx, {";
  echo "type: 'bar',";
  echo "data: {";
  echo "labels: labels,";
  echo "datasets: [{";
  echo "label: 'Cantidad de Películas',";
  echo "data: data,";
  echo "backgroundColor: 'skyblue',";
  echo "}]";
  echo "},";
  echo "options: {";
  echo "scales: {";
  echo "y: {";
  echo "beginAtZero: true";
  echo "}";
  echo "}";
  echo "}";
  echo "});";
  echo "</script>";
  ?>


