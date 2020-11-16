<?php namespace Vistas; $sumar=0; 
 
        use BaseDatos\PresentacionBD as envase;
       use BaseDatos\CervezasBD as cerveza;
       use BaseDatos\SucursalesBD as Sucu;
       use BaseDatos\PedidosBD as Pedidos;
       //use Daos\DaoListaCerveza as cerveza;

       $Todosenvases=envase::getInstance();
       $Todascervezas=cerveza::getInstance();
       $TodasSucu=Sucu::getInstance();
       $misPedidos=Pedidos::getInstance();
    $listaTotalEnvase=$Todosenvases->getListaPresentaciones();
    $listaTotalCerveza=$Todascervezas->getListaCerveza();
    $listaSucu=$TodasSucu->getListaSucursales();
    
    if(isset($_SESSION['CuentaLogueada']))
    {
          $id=$_SESSION['CuentaLogueada']->getID(); 
          $pedidosList=$misPedidos->ConsultarEstadoPedidos($id); 

        } else {
          $id=0;
        }
           
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= BASE ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE ?>css/stylebeer.css">
  <!--  efecto scroll-->
    <script src="<?= BASE ?>js/smooth-scroll.js"></script>
    <script>
          var scroll = new SmoothScroll('a[href*="#"]', {
          // Selectors
          ignore: '[data-scroll-ignore]', // Selector for links to ignore (must be a valid CSS selector)
          header: null, // Selector for fixed headers (must be a valid CSS selector)

          // Speed & Easing
          speed: 850, // Integer. How fast to complete thebody scroll in milliseconds
          offset: 100, // Integer or Function returning an integer. How far to offset the scrolling anchor location in pixels
          easing: 'easeInOutCubic', // Easing pattern to use
          customEasing: function (time) {}, // Function. Custom easing pattern

          // Callback API
          before: function () {}, // Callback to run before scroll
          after: function () {} // Callback to run after scroll
          });
    </script>
    <script type="text/javascript">
          $('#myTab a').on('click', function (e) {
              e.preventDefault()
              $(this).tab('show');
          });
    </script>
      <script> $('#cerA').click(function(){
      $('#listaCervezas').hide();    
});</script>
    <<script id='script'>
      $('#EtiquetaAPed').click(function(e){
        $mensajeNoLogueaado="Usted no esta logueado, Inicie seccion o Registrese para Comprar";
        alert($mensajeNoLogueaado);
      });
    </script>
  

  </head>
  <body data-spy="scroll" data-target="#barramenu">
    <!-- barra de divegacion  -->
    <nav id="barramenu" class="navbar navbar-expand-lg navbar-dark  navbar-toggleable-md fixed-top row" style="background-color: black;" >

      <div id="textlogo">
        <a class="navbar-brand" href="#">
           <img src="<?= BASE ?>img/logo.svg" width="65" height="65" class="d-inline-block align-center" alt="" data-toggle="tooltip" data-placement="bottom" title="..mm cerveeza!">
           BEERGHOST
      </a>
      </div>
      <div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarbeer"
      aria-controls="navbarbeer" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      </div>
      <div class="collapse navbar-collapse " id="navbarbeer">

        <div class="shift col-12 col-lg-9">

          <div class="navbar-nav d-flex justify-content-start mr-auto ml-auto text-center">
            <a data-scroll class="nav-item nav-link active" href="#">Inicio</a>
            <a data-scroll class="nav-item nav-link" href="#cervezas">Cervezas</a>
            <a data-scroll class="nav-item nav-link" href="<?=BASE?>Sucursales/vistaMapa">Sucursales</a>
            <?php if(isset($_SESSION['CuentaLogueada'])){ ?>
            <a data-scroll class="nav-item nav-link" data-toggle="modal" data-target="#ordenPedida">Pedido</a>
            <?php } else { ?>
              <a data-scroll class="nav-item nav-link" id="EtiquetaAPed">Pedido</a>
           <?php  } ?>
            <a data-scroll class="nav-item nav-link" href="#FAQ">Preguntas</a>
            <a data-scroll class="nav-item nav-link" href="#contacto">Contacto</a>
            <?php if(isset($_SESSION['CuentaLogueada']))
            {  
              $rol=$_SESSION['CuentaLogueada']->getRol()->getDescripcion();
               if(strcmp($rol,'Administrador')===0)
                  { ?>
                    <a data-scroll class="nav-item nav-link" href="<?= BASE ?>Administrador">Administracion</a>
                 <?php  } ?> 
            <?php } ?>
          </div>

        </div>
      <?php if(isset($_SESSION['CuentaLogueada'])){ ?>
      <?php for ($i=0; $i<=sizeof($lista); $i++) { $sumar=0;
        $sumar=$sumar+$i;}?>
      <?php }?>
      <?php if(isset($_SESSION['CuentaLogueada'])) {?>
        <div class="scart nav navbar-nav d-flex justify-content-center mr-auto ml-auto col-12 col-lg-3">
          <a href="" data-toggle="modal" data-target="#pedido"><img src="<?= BASE ?>img/cart.svg" width="25" height="25" alt="" class="d-inline-block align-center">
             (<?php echo $sumar; ?>)
           </a>
           <a href="<?=BASE?>Loguin/CerrarSession"><?php echo $_SESSION['CuentaLogueada']->getUsuario(); ?>   <img src="<?=BASE?>img/botoncierre.png" alt="" height="35" width="35" class="d-inline-block align-center"></a>
           <?php }  else {?>

           <a id="btnnaranja" data-toggle="modal" data-target="#login_reg" class="btn btn-primary" href="" role="button">INGRESAR</a>
          <?php } ?>
        </div>
    </div>

  </nav>

<div class="modal fade" id="ordenPedida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MIS PEDIDOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <table class="table table-bordered table-striped table-dark text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($pedidosList as $key => $info) 
                  {
                    
                   ?>
                  <tr>
                    <td><?php echo $info->getFecha(); ?></td>
                    <td><?php  echo $info->getEnvio(); ?></td>
                  </tr>
                  <?php  } ?>
                </tbody>
              </table>
              
          
      </div>
    
      </div>
    </div>
  </div>

<!--  model login -->
<div class="container">
  <div class="modal fade" id="login_reg" tabindex="-1" role="dialog" aria-labelledby="LabelLogin" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title ml-auto mr-auto" id="LabelLogin">   :: BIENVENIDO BEERGHOST ::</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">



          <nav class="nav nav-tabs" id="myTab" role="tablist">
            <a class="nav-item nav-link active" id="nav-loguearse-tab" data-toggle="tab" data-target="#nav-login" role="tab" aria-controls="nav-home" aria-selected="true">LOGUEARSE</a>
            <a class="nav-item nav-link" id="nav-registrarse-tab" data-toggle="tab" data-target="#nav-register" role="tab" aria-controls="nav-profile" aria-selected="false">REGISTRARSE</a>
          </nav>
          <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-loguearse-tab">


                  <form iclass="form-signin mt-5 pl-4 pr-4 " action="<?=BASE?>Loguin/iniciarSession" method="POST">

                <input  name="nameUser" class="form-control pl-3" placeholder="INGRESE EMAIL O NICK" required="" autofocus="" type="text">

                <input  name="passUser" class="form-control mt-3" placeholder="INGRESE SU CONTRASEÑA" required="" type="password">
                <input class="btn btn-lg btn-primary btn-block mt-3" type="submit" value="INICIAR SESSION"> 
             <br>
                  <div class="text-center">- Ó -</div> 
                  <div class="text-center">
                  <a  href="">
                  <img src="<?= BASE ?>img/btn_facebook.png" alt="boton de facebook">
                </a>
                </div>              </form>
                </div>

                <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-registrarse-tab">

                  <form class="form-signin mt-5 pl-4 pr-4" action="<?= BASE ?>Registro/registrarUsuario" method="POST">
                  <input class="form-control" name="id" autofocus="" type="number" value="1" hidden>
                  <input class="form-control" name="idcuenta" autofocus="" type="number" value="1" hidden>
                  <input name="nick" class="form-control" placeholder="INGRESE NICK" required="" autofocus="" type="text">
                  <div class="row ml-auto mr-auto ">
                  <input name="nombre" class="col-5 form-control mt-3 pr-2 " placeholder="INGRESE NOMBRE" required="" type="text">
                  <input name="apellido" class=" col-5 form-control mt-3 pl-3 offset-2" placeholder="INGRESE APELLIDO" required="" type="text">
                </div>
                  <input name="dirrecion" class="form-control mt-3" placeholder="INGRESE DIRECCION" required="" type="text">
                  <input name="direccionenvio" class="form-control mt-3" placeholder="INGRESE DIRECCION DE ENVIO" required="" type="text">
                  <input name="email" class="form-control mt-3" placeholder="INGRESE SU E-MAIL" required="" type="email">
                <div class="row ml-auto mr-auto ">
                  <input name="contraseña" class="col-5 form-control mt-3 pr-2" placeholder="INGRESE UNA CONTRASEÑA" required="" type="password">
                  <input class="col-5 form-control mt-3 pl-2 offset-2" placeholder="REPITA LA CONTRASEÑA" required type="password">
                </div>
                  <button id="botonRegistrar" class="btn btn-lg btn-primary btn-block mt-3" type="submit">REGISTRARSE</button>
                  <img src=""><span id="mensajeRegistro"></span>
                  </form>

                  </div>

                </div>

            </div>

            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>

        </div>
      </div>
    </div>
  </div>
<!--  fin  modal login-->

</div>
  <!--  fin de barra navegacion -->


  <!-- carrusel -->

  <div id="carouselExampleIndicators" class="carousel slide mt-5c " data-ride="carousel" data-interval="4000" data-pause="hover-null">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active" style="height: 100vh">
        <img class="d-block img-fluid" src="<?= BASE ?>img/beer1.jpg" alt="First slide">
      </div>
      <div class="carousel-item" style="height: 100vh">
        <img class="d-block img-fluid" src="<?= BASE ?>img/beer2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item" style="height: 100vh">
        <img class="d-block img-fluid" src="<?= BASE ?>img/beer3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- fin carrusel -->




<div class="modal fade" id="Listasucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SUCURSALES A SU DISPOSICION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <table class="table table-bordered table-striped table-dark text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DOMICILIO</th>
                    <th scope="col">METODO DE OBTENCION</th>
                    <th  scope="col">OPCION</th>           
                   </tr>
                </thead>
                <tbody>
                  <?php foreach ($listaSucu as $key => $sucur) 
                  {
                      
                   ?>
                  <tr>
                    <td><?php  echo $sucur->getNombre(); ?></td>
                    <td><?php  echo $sucur->getDomicilio(); ?></td>
                    <form action="<?=BASE?>Pedidos/nuevoPedido" method="POST">
                          <input type="number" name="id" value=<?php echo $id;  ?> hidden>
                          <input type="text" name="nombreSucursal" value=<?php echo $sucur->getNombre(); ?> hidden>
                          <input type="text" name="DomicilioSucursal" value=<?php echo $sucur->getDomicilio(); ?> hidden>
                          <td><select name="formadeObtencion">
                           <option value="RETIRO EN SUCURSAL">RETIRO EN SUCURSAL</option>
                             <option value="ENVIO DEL PEDIDO">ENVIO DEL PEDIDO</option>
                           </select></td>  
                           <?php foreach ($_SESSION['CarritoVirtual'] as $key => $value) {
                                                  $sumar=0;
                                                  $sumar+=$value->getImporte();
                                                       } ?>
                           <input type="number" name="total" value=<?php echo $sumar;  ?> hidden>
                            <td><input class="btn-primary" type="submit" value="FINALIZAR PEDIDO"></td>          
                    </form>
                  </tr>
                  <?php  } ?>
                </tbody>
              </table>
              
          
      </div>
    
      </div>
    </div>
  </div>
</div>



















<!--  fin modal agregar a carrito-->

<!--  modal pedido-->


<div class="modal fade" id="pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PRODUCTOS AGREGADOS - VISTA PREVIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <table class="table table-bordered table-striped table-dark text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">CAPACIDAD</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">SUBTOTAL</th>
                    <th colspan="2" align="center" scope="col">OPCIONES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($lista as $key => $value) 
                  {
                    $cervezaObjeto=$value->getTipoCerveza();
                    $envaseObjeto=$value->getPresentacion();
                   ?>
                  <tr>
                    <td><?php  echo $cervezaObjeto->getNombreCerveza(); ?></td>
                    <td><?php  echo $cervezaObjeto->getPrecioLitro(); ?></td>
                    <td><?php  echo $envaseObjeto->getLitrosDeEnvasado(); ?></td>
                    <td><?php echo $value->getCantidad(); ?></td>
                    <td><?php echo $value->getImporte(); ?></td>
                    <td><form action="<?=BASE?>LineaPedido/eliminarLineaDeSession" method="POST" accept-charset="utf-8">
                      <input type="number" name="id" value='<?php echo $value->getID();?>' hidden>
                    <input  class="btn btn-danger" type="submit" value="ELIMINAR">
                    </form></td>
                  </tr>
                  <?php  } ?>
                </tbody>
              </table>
               <?php foreach ($lista as $key => $sumImp) 
            { 
              $sumar=$sumar+$sumImp->getImporte();

              ?><?php } ?>
              <?php 
              if($sumar===0)
              { ?>
                  <div class="text-right">
                       <h3 >TOTAL: $ 0.0</h3>
                  </div>
          <?php 
              } 
          else { ?>
            <div class="text-right">
                <h3><?php echo 'TOTAL: $'. $sumar; ?></h3>
             </div>
               <?php } ?>
             
              
          
          </div>
              
        
          
       </div>
          
      </div>
      <div class="modal-footer">
        <a id="trPed" data-toggle="modal" data-target="#Listasucursal" class="btn btn-primary" href="" role="button">TRAMITAR PEDIDO</a>
      </div>
    </div>
  </div>
</div>

<!--  fin pedido-->


  <div class="container mt-5 pt-5">

  <hr>
  <!--cervezas -->
  <section id="cervezas">
    <h2>NUESTRAS CERVEZAS PRIVILIGIADAS</h2>
    <hr>
    <div class="card-deck">
      <div class="card">
        <img class="card-img-top" src="<?= BASE ?>img/cardaleespecial.png" alt="Card image cap">
        <div class="card-block">
          <br>
          <h4 class="card-title"> Ale especial</h4>
          <p class="card-text">Utilizan levaduras aque al final del proceso de fermentacion van a
          la parte superior de los tanques y tiene alcoholes entre 2.5 y 10 grados.
        El amargo y el color son mas intensos.
        </p>
        <br>
       
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="<?= BASE ?>img/cardaletrapense.png" alt="Card image cap">
        <div class="card-block">
          <br>
          <h4  class="card-title"> Ale trapense</h4>
          <p class="card-text">Utilizan levaduras aque al final del proceso de fermentacion van a
          la parte superior de los tanques y tiene alcoholes entre 2.5 y 10 grados.
        El amargo y el color son mas intensos.
        </p>
        <br>
          
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="<?= BASE ?>img/cardlagernegra.png" alt="Card image cap">
        <div class="card-block">
        <br>
          <h4 class="card-title"> Lager Negra</h4>
          <p class="card-text">Utilizan levaduras que al final del proceso de fermentacion van al fondologin
          del tanque. Tienen que contenidos de alcohol entre los 4 y 13 grados y su amargo y color
        son menos intensos. Son las mas populares
          </p>
        </div>
      </div>
    </div>

    <br><br>

    <div class="card-deck">
      <div class="card">
        <img class="card-img-top" src="<?= BASE ?>img/cardlagertradicional.png" alt="Card image cap">
        <div class="card-block">
          <br>
          <h4 class="card-title"> Lager Tradicional</h4>
          <p class="card-text">Utilizan levaduras aque al final del proceso de fermentacion van a
          la parte superior de los tanques y tiene alcoholes entre 2.5 y 10 grados.
        El amargo y el color son mas intensos.
        </p>
        <br>
        <br>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="<?= BASE ?>img/cardlagerespecial.png" alt="Card image cap">
        <div class="card-block">
          <br>
          <h4 class="card-title"> Lager Especial</h4>
          <p class="card-text">Utilizan levaduras aque al final del proceso de fermentacion van a
          la parte superior de los tanques y tiene alcoholes entre 2.5 y 10 grados.
        El amargo y el color son mas intensos.
        </p>
        <br>
        <br>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="<?= BASE ?>img/cardtrigo.png" alt="Card image cap">
        <div class="card-block">
        <br>
          <h4 class="card-title">Trigo</h4>
          <p class="card-text">Son elaboradas con una elevada proporción de trigo,
             más ligera y de color más pálido que la mayoría de las cervezas Ale hechas sólo con cebada.
             También se conocen como cervezas blancas ya que su aspecto,
             cuando no están filtradas, asemeja la neblina.
          </p>
        </div>
      </div>
    </div>
    <br>
    
    <div class="">
     <a id="vrCervesas" href="<?=BASE?>PaginaPrincipal/verCervezas"><h6 class="text-right"> VER MAS CERVEZAS</h6></a>
      </div>
      

    
    <!---MODAAALS -->

  <br><br>

</div>
  </section>
<!-- fin cervezas -->

<!-- preguntas frecuentes -->
  <div class="container mt-5 pt-5">
  <hr>
  <section id="FAQ">
    <h2>PREGUNTAS FRECUENTES</h2>
    <hr>
    <div role="tablist">
    <div class="card">
      <div class="card-header" role="tab" id="headingOne">
        <h5 class="mb-0">
          <a data-toggle="collapse" href="" data-target="#preg1" aria-expanded="true" aria-controls="collapseOne">
           ¿COMO AGREGO AL CARRITO UNA CERVEZA?
          </a>
        </h5>
      </div>
      <div id="preg1" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
         Primero vas a la seccion de Cervezas  clickeas ver mas cervezas, se le abrira una pestaña flotante donde podra elegir la cerveza que quiere luego clickea en agregar al carrito debe elegir en que envase la quiere una vez que lo eligio clickea aceptar y se le agregara al carrito
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" role="tab" id="headingTwo">
        <h5 class="mb-0">
          <a class="collapsed" data-toggle="collapse" href=" "data-target="#preg2" aria-expanded="false" aria-controls="collapseTwo">
            ¿DEBO TENER UNA CUENTA PARA PODER COMPRAR?
          </a>
        </h5>
      </div>
      <div id="preg2" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
         Se le habilitara la opcion de compra solo cuando este logueado con su cuenta , sino tiene una cuenta tiene la posibilidad de registrarse desde el boton INGRESAR del menu
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" role="tab" id="headingThree">
        <h5 class="mb-0">
          <a class="collapsed" data-toggle="collapse" href="" data-target="#preg3" aria-expanded="false" aria-controls="collapseThree">
            ¿COMO HAGO UN PEDIDO?
          </a>
        </h5>
      </div>
      <div id="preg3" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
         Una vez que usted ha elegido la cerveza y el envase de su producto debe agregarlo al carrito ,cuando ya no desee mas productos debe ir al carrito y clickear Tramitar Pedido donde eligira el metodo de envio y la direccion a donde sera enviado o si lo retira desde la sucursal
        </div>
      </div>
    </div>

  </section>

</div>

<!-- fin preguntas frecuentes -->

<div class="container">
    <hr>
    <h2>CONTACTO</h2>
    <hr>

  <div class="container" style="background-image: url('<?=BASE?>img/mardelplata.png');">
      <div class="container mt-5">
          <p class="display-4">Envienos su consulta</p>
          <form action="" method="" accept-charset="utf-8">
          <div class="row">
          <input id="nameUser" name="nameUser" class="form-control m-4 col-4 align-center" placeholder="INGRESE EMAIL" required="" autofocus="" type="email">  
          </div>
          <div class="row">
          <textarea class="form-control m-4 col-5" id="exampleFormControlTextarea1" placeholder="INGRESE SU MENSAJE" rows="3"></textarea>
          </div>      
          <div class="row">
            <button type="button" class="btn btn-lg btn-primary btn-block col-4 m-4">ENVIAR</button>
          </div>
          <br>
        </form>
      </div>
  </div>    
</div>

<hr>

<!-- footer -->
<footer id="contacto" class="row">
          <div class="secfooter col-lg-3 col-md-6 pt-5 pb-5 text-center">

                <h4>NAVEGACION</h4>
                <hr>
                <a href="#">-INICIO</a>
                <a href="#cervezas">-CERVEZAS</a>
                <a href="<?=BASE?>Sucursales/vistaMapa">-SUCURSALES</a>
                <a href="#ordenPedida">-PEDIDO</a>
                <a href="#FAQ">-PREGUNTA</a>

          </div>

          <div id="seccionfooter" class="col-lg-3 col-md-6 text-center pt-5">

                  <h4>SIGUENOS</h4>
                  <hr>
                <div >
                  <a href="">
                    <img class="float-left" src="<?= BASE ?>img/facebook.png" alt="">
                  </a>
                  <a href="">
                    <img class="float-right" src="<?= BASE ?>img/google.png" alt="">
                  </a>
                  <a href="">
                    <img src="<?= BASE ?>img/twitter.png" alt="">
                  </a>
                </div>

          </div>

          <div class="secfooter col-lg-3 col-md-6 text-center pt-5">

                  <h4>CONTACTANOS</h4>
                  <hr>
            <div class="row justify-content-center">
                  <img width="40" height="40" src="<?= BASE ?>img/whatsapp.png" alt="">
                  <h5 class="ml-2">  +5422311223344</h5>
              </div>
          <div class="row pt-3 justify-content-center">
                <h5 class="mr-2">ESCRIBENOS  </h5>
                <img src="<?= BASE ?>img/email.png" width="40" height="40" alt="">
              </div>
          </div>


          <div id="seccionfooter" class="col-lg-3 col-md-6 text-center pt-4 d-flex justify-content-center">
            <div class="mr-auto ml-auto text-center">
                  <img src="<?= BASE ?>img/logo.svg" width="100" height="100" alt="" data-toggle="tooltip" data-placement="bottom" title="..mm mas cerveeza!">
                <hr>
                  <h3 style="font-weight:bold">BEERGHOST</h3>
                    <h3 style="font-weight:bold; color:grey">2017</h3>
                </div>

              </div>


</footer>


  <!-- fin section cervezas -->


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="<?= BASE ?>js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('.collapse').collapse();
  </script>
  <script>
    $('#trPed').click(function(){
      $('#pedido').modal('hide');    
});
 
  </script>

  

</body>
</html>
