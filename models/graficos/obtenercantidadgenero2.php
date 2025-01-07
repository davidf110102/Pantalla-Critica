<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/proyectoWeb/models/conexion.php';
  
  $sql = "SELECT 'Aventura' AS generoind, SUM(CASE WHEN genero LIKE '%Aventura%' THEN 1 ELSE 0 END) AS cantidad
  FROM series
  UNION ALL
  SELECT 'Drama', SUM(CASE WHEN genero LIKE '%Drama%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Comedia', SUM(CASE WHEN genero LIKE '%Comedia%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Misterio', SUM(CASE WHEN genero LIKE '%Misterio%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Accion', SUM(CASE WHEN genero LIKE '%Accion%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Animacion', SUM(CASE WHEN genero LIKE '%Animacion%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Ciencia Ficcion', SUM(CASE WHEN genero LIKE '%Ciencia Ficcion%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Crimen', SUM(CASE WHEN genero LIKE '%Crimen%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Historia', SUM(CASE WHEN genero LIKE '%Historia%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Suspenso', SUM(CASE WHEN genero LIKE '%Suspenso%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Sitcom', SUM(CASE WHEN genero LIKE '%Sitcom%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Fantasia', SUM(CASE WHEN genero LIKE '%Fantasia%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Thriller', SUM(CASE WHEN genero LIKE '%Thriller%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Satira', SUM(CASE WHEN genero LIKE '%Satira%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Musica', SUM(CASE WHEN genero LIKE '%Musica%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Intriga', SUM(CASE WHEN genero LIKE '%Intriga%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Terror', SUM(CASE WHEN genero LIKE '%Terror%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Supernatural', SUM(CASE WHEN genero LIKE '%Supernatural%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Supervivencia', SUM(CASE WHEN genero LIKE '%Supervivencia%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Biografia', SUM(CASE WHEN genero LIKE '%Biografia%' THEN 1 ELSE 0 END)
  FROM series
  UNION ALL
  SELECT 'Politica', SUM(CASE WHEN genero LIKE '%Politica%' THEN 1 ELSE 0 END)
  FROM series
  ORDER BY cantidad DESC";

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
  echo "var ctx = document.getElementById('myChart2').getContext('2d');";
  echo "var myChart = new Chart(ctx, {";
  echo "type: 'bar',";
  echo "data: {";
  echo "labels: labels,";
  echo "datasets: [{";
  echo "label: 'Cantidad de Series',";
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


