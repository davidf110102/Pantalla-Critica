var pelicula;
var usuario;
  
  function abrirPantallaFlotante(num, peliculaParam, usuarioParam) {
    var pantallaFlotante = document.getElementById("pantallaFlotante" + num);
    pantallaFlotante.style.display = "flex";
    pelicula = peliculaParam;
    usuario = usuarioParam;
  }
  
  function aplicarHoverAnteriores(event, num) {
    var estrellaSeleccionada = event.target;
    var estrellas = document.querySelectorAll("#estrellas" + num + " .estrella");
    var indiceSeleccionado = Array.from(estrellas).indexOf(estrellaSeleccionada);
  
    for (var i = 0; i <= indiceSeleccionado; i++) {
      estrellas[i].classList.add('hover-previous');
    }
  
    for (var j = indiceSeleccionado + 1; j < estrellas.length; j++) {
      estrellas[j].classList.remove('hover-previous');
    }
  }
  
  function calificar(event, num) {
    var estrellaSeleccionada = event.target;
    var estrellas = document.querySelectorAll("#estrellas" + num + " .estrella");  
    var calificacion = Array.prototype.indexOf.call(estrellas, estrellaSeleccionada) + 1;
    var pantallaFlotante = document.getElementById("pantallaFlotante" + num);
    pantallaFlotante.style.display = "none";
    var estrella = "cEstrellas" + num;
    enviarCalificacion(calificacion);
    document.getElementById(estrella).innerHTML = calificacion + "&#9733";
  }

  function enviarCalificacion(calificacion) {
    // Supongamos que las variables pelicula, usuario y calificacion ya están definidas.
    var peli = pelicula;
    var usua = usuario;
    var cali = calificacion;
    if(peli > 50000000){
      var url = 'models/actualizarcalificacionserie.php';
    }else{
      var url = 'models/actualizarcalificacion.php';
    }
    $.post(url, {calificacion: cali, usuario: usua, pelicula: peli}, function(data) {
      if (data !== undefined && data !== null) {
      } else {
        alert("Los datos no se enviaron correctamente");
      }
    })
    .fail(function() {
      alert("Error en la solicitud AJAX");
    });
    
  }


  function marcarComoUtil(idResena, cant, tipo) {
    var tipo = tipo;
    cant = cant + 1;
    document.getElementById('c_util_' + idResena).innerText = cant;
    var url = 'models/actualizarutil.php';
      $.post(url, {id: idResena, cantidad: cant, tipo: tipo}, function(data) {
        if (data !== undefined && data !== null) {
          alert(idResena);
        } else {
          alert("Los datos no se enviaron correctamente");
        }
      })
      .fail(function() {
        alert("Error en la solicitud AJAX");
      });
      document.getElementById('btnUtil' + idResena).disabled = true;
      document.getElementById('btnNoUtil' + idResena).disabled = true;
  }
  
  function marcarComoNoUtil(idResena, cant, tipo) {
      var tipo = tipo;
      cant = cant+1;
      document.getElementById('c_no_util_' + idResena).innerText = cant;
      var url = 'models/actualizarnoutil.php';
      $.post(url, {id: idResena, cantidad: cant, tipo: tipo}, function(data) {
        if (data !== undefined && data !== null) {
          alert(idResena);
        } else {
          alert("Los datos no se enviaron correctamente");
        }
      })
      .fail(function() {
        alert("Error en la solicitud AJAX");
      });
      document.getElementById('btnUtil' + idResena).disabled = true;
      document.getElementById('btnNoUtil' + idResena).disabled = true;
  }
  


function mostrarCuadroComentario(idResena) {
    ocultarTodosCuadrosComentario();
    var cuadroComentario = document.getElementById('cuadroComentario' + idResena);
    cuadroComentario.style.display = 'block';
}

function ocultarTodosCuadrosComentario() {
    var cuadrosComentario = document.querySelectorAll('[id^="cuadroComentario"]');
    cuadrosComentario.forEach(function(cuadro) {
        cuadro.style.display = 'none';
    });
}


function cambiarColor(corazon, pelicula, usuario, tipo) {
  corazon.classList.toggle("clicked");
    var url = 'models/ingresarfavoritos.php';
      $.post(url, {pelicula: pelicula, usuario: usuario, tipo:tipo}, function(data) {
        if (data !== undefined && data !== null) {
        } else {
          alert("Los datos no se enviaron correctamente");
        }
      })
      .fail(function() {
        alert("Error en la solicitud AJAX");
      });
}





  



  