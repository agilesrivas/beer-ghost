
<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?=BASE?>css/bootstrap.css">
    <!-- JS -->
  <script src="<?=BASE?>http://code.jquery.com/jquery-2.1.4.js"></script>
  <title>ADMINISTRADOR</title>
</head>
<body>
  <header class="container-fluid">

    <nav class="navbar navbar-expand-md navbar-dark navbar-toggleable-md fixed-top " style="background-color: black">

      <a class="navbar-brand" href="#">
        <img src="<?=BASE?>img/logobeer.png" width="35" height="35" class="d-inline-block align-top" alt="">
        BEERGHOST(ADMIN)
      </a>

      <!-- boton-->
      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarToggler01" aria-controls="navbarToggler01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- colapse div a desaparecer
    -->
      <div class=" collapse navbar-collapse" id="navbarToggler01">

        <div class="nav navbar-nav justify-content-around text-center mr-auto ml-auto col-7">

          <a data-scroll class="nav-item nav-link active" href="<?=BASE?> TipoCerveza">CERVEZAS</a>

          <a data-scroll class="nav-item nav-link active" href="<?=BASE?>Registro/vistaAdministrador">CUENTAS</a>

          <a data-scroll class="nav-item nav-link active" href="<?=BASE?>Sucursales">SUCURSALES</a>

          <a data-scroll class="nav-item nav-link active" href="<?=BASE?>TipoEnvase">ENVASES</a>

          <a data-scroll class="nav-item nav-link active" href="<?=BASE?>Pedidos">PEDIDOS</a>
          <a data-scroll class="nav-item nav-link active" href="<?=BASE?>PaginaPrincipal">Pag Principal</a>
 
        </div>
          </div>
    
    </nav>

  </header>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="<?=BASE?>js/bootstrap.min.js"></script>
  <!-- ocultar y mostrar divs -->

</body>
</html>
