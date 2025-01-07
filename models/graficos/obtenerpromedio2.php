<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/proyectoWeb/models/conexion.php';
  
  $sql = "SELECT 'Aventura' AS generoind, AVG(CASE WHEN genero LIKE '%Aventura%' THEN calificacion ELSE NULL END) AS promedio
  FROM series
  UNION ALL
  SELECT 'Drama', AVG(CASE WHEN genero LIKE '%Drama%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Comedia', AVG(CASE WHEN genero LIKE '%Comedia%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Misterio', AVG(CASE WHEN genero LIKE '%Misterio%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Accion', AVG(CASE WHEN genero LIKE '%Accion%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Animacion', AVG(CASE WHEN genero LIKE '%Animacion%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Ciencia Ficcion', AVG(CASE WHEN genero LIKE '%Ciencia Ficcion%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Crimen', AVG(CASE WHEN genero LIKE '%Crimen%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Historia', AVG(CASE WHEN genero LIKE '%Historia%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Suspenso', AVG(CASE WHEN genero LIKE '%Suspenso%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Sitcom', AVG(CASE WHEN genero LIKE '%Sitcom%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Fantasia', AVG(CASE WHEN genero LIKE '%Fantasia%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Thriller', AVG(CASE WHEN genero LIKE '%Thriller%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Satira', AVG(CASE WHEN genero LIKE '%Satira%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Musica', AVG(CASE WHEN genero LIKE '%Musica%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Intriga', AVG(CASE WHEN genero LIKE '%Intriga%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Terror', AVG(CASE WHEN genero LIKE '%Terror%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Supernatural', AVG(CASE WHEN genero LIKE '%Supernatural%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Supervivencia', AVG(CASE WHEN genero LIKE '%Supervivencia%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Biografia', AVG(CASE WHEN genero LIKE '%Biografia%' THEN calificacion ELSE NULL END)
  FROM series
  UNION ALL
  SELECT 'Politica', AVG(CASE WHEN genero LIKE '%Politica%' THEN calificacion ELSE NULL END)
  FROM series
  ORDER BY promedio DESC";

  $result = $conn->query($sql);
  // Crear arrays para los datos del gráfico
  $labels = array();
  $data = array();

  // Obtener los datos de la consulta
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($labels, $row["generoind"]);
      array_push($data, $row["promedio"]);
    }
  }

  // Cerrar la conexión
  $conn->close();

  // Convertir los arrays PHP a JavaScript
  echo "<script>";
  echo "var labels = " . json_encode($labels) . ";\n";
  echo "var data = " . json_encode($data) . ";\n";

  // Script de Chart.js para generar el gráfico
  echo "var ctx = document.getElementById('myChart4').getContext('2d');";
  echo "var myChart = new Chart(ctx, {";
  echo "type: 'bar',";
  echo "data: {";
  echo "labels: labels,";
  echo "datasets: [{";
  echo "label: 'Promedio',";
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