<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/proyectoWeb/models/conexion.php';
  
  $sql = "SELECT 'Drama' AS generoind, AVG(CASE WHEN genero LIKE '%Drama%' THEN calificacion ELSE NULL END) AS promedio
  FROM peliculas
  UNION ALL
  SELECT 'Ciencia Ficcion', AVG(CASE WHEN genero LIKE '%Ciencia Ficcion%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Suspenso', AVG(CASE WHEN genero LIKE '%Suspenso%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Fantasia', AVG(CASE WHEN genero LIKE '%Fantasia%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Aventura', AVG(CASE WHEN genero LIKE '%Aventura%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Thriller', AVG(CASE WHEN genero LIKE '%Thriller%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Accion', AVG(CASE WHEN genero LIKE '%Accion%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Comedia', AVG(CASE WHEN genero LIKE '%Comedia%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Misterio', AVG(CASE WHEN genero LIKE '%Misterio%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Belico', AVG(CASE WHEN genero LIKE '%Belico%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Crimen', AVG(CASE WHEN genero LIKE '%Crimen%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Animacion', AVG(CASE WHEN genero LIKE '%Animacion%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Terror', AVG(CASE WHEN genero LIKE '%Terror%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Romance', AVG(CASE WHEN genero LIKE '%Romance%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Historia', AVG(CASE WHEN genero LIKE '%Historia%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Biografia', AVG(CASE WHEN genero LIKE '%Biografia%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Western', AVG(CASE WHEN genero LIKE '%Western%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Familia', AVG(CASE WHEN genero LIKE '%Familia%' THEN calificacion ELSE NULL END)
  FROM peliculas
  UNION ALL
  SELECT 'Musica', AVG(CASE WHEN genero LIKE '%Musica%' THEN calificacion ELSE NULL END)
  FROM peliculas
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
  echo "var ctx = document.getElementById('myChart3').getContext('2d');";
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