<?php namespace Vistas;
 ?><!DOCTYPE html>
<html>
  <head>
    <title>Sucursales</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">

     <link rel="stylesheet" href="<?=BASE?>css/bootstrap.css">


    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {  height: 70%; }
      html, body{
        height: 100%;
        background-color: grey;
      }
      h3{color:white;}
    </style>
  </head>
  <body>
    <div class="container">
      <hr>
      <h3>SUCURSALES BEERGHOST</h3>
    </div>
    <div id="map" class="container mt-5"></div>
    <div class="container">
 <hr>  
       <button type="button" class="btn btn-warning"><a href="<?=BASE?>PaginaPrincipal">VOLVER</a></button>
    <br>
    <hr>     </div>
    
    <script>
      function initMap() {

      var opciones = { 
                        zoom:12, center: {lat:-38.0489819,lng:-57.5442369}
                      }

      
      var  map = new google.maps.Map
                  (document.getElementById('map'),opciones);



      agregarMarcador({lat:-38.0489819,lng:-57.5442369},'Infierno');
      agregarMarcador({lat:-38.0489819,lng:-57.5442369},'Lucifer');

          function agregarMarcador(coordenadas,titulo)
          {
            var marker = new google.maps.Marker(
            {
              position:coordenadas,
              title:titulo,
              map: map,
            });
            
          }

      }
      function loadLocation () {
  //inicializamos la funcion y definimos  el tiempo maximo ,las funciones de error y exito.
  navigator.geolocation.getCurrentPosition(viewMap,ViewError,{timeout:1000});
}

//Funcion de exito
function viewMap (position) {
  
  var lon = position.coords.longitude;  //guardamos la longitud
  var lat = position.coords.latitude;   //guardamos la latitud

  var link = "http://maps.google.com/?ll="+lat+","+lon+"&z=14";
  document.getElementById("long").innerHTML = "Longitud: "+lon;
  document.getElementById("latitud").innerHTML = "Latitud: "+lat;

  document.getElementById("link").href = link;

}



function ViewError (error) {
  alert(error.code);
} 
  
  

    </script>

    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdU7WVNTdZzt-t_clyx-mL2CnXYnKxxm8&callback=initMap"
    async defer></script>
  </body>
</html>






      