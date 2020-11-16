<?php namespace Vistas; 
           $suma=0;

             use BaseDatos\PresentacionBD as envase;
       use BaseDatos\CervezasBD as cerveza;
       use BaseDatos\SucursalesBD as Sucu;
       //use Daos\DaoListaCerveza as cerveza;

       $Todosenvases=envase::getInstance();
       $Todascervezas=cerveza::getInstance();
       $TodasSucu=Sucu::getInstance();
    $listaTotalEnvase=$Todosenvases->getListaPresentaciones();
    $listaCerveza=$Todascervezas->getListaCerveza();
    $listaSucu=$TodasSucu->getListaSucursales();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href=="<?=BASE?>">
  <link rel="stylesheet" href="<?=BASE?>css/bootstrap.css">
</head>
<body background="<?=BASE?>img/fondo1.jpg">

<hr>

<div align="center">
  <img src="<?=BASE?>img/portada1.png" class="img-fluid" width="50%" alt="Responsive image">
</div>
  
</div>
<hr>


  <div class="container mt-5 d-flex justify-content-between">
    
      <h3>LISTA DE CERVERZAS</h3> 
      <h5>CARRITO (<?php for ($i=1; $i <= sizeof($_SESSION['CarritoVirtual']); $i++){
        $suma=0;
               $suma=$suma+$i; 
      } echo $suma;?>) </h5>     

  </div>
<div class="container mt-3">
  
<hr>
	 <table class="table table-bordered table-striped table-dark text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">IMAGEN</th>
                    <th colspan="2" align="center" scope="col">SELECCION</th>           
                   </tr>
                </thead>
                <tbody>
                  <?php foreach ($listaCerveza as $key => $cer) {?>
                    
                   <tr>
                    <td><?php echo $cer->getNombreCerveza(); ?></td>
                    <td><?php echo $cer->getDescripcion(); ?></td>
                    <td>
                        <span><?php echo '$'.$cer->getPrecioLitro(); ?></span>
                    </td>
                    <td><?php echo BASE.'imgCervesas/'.$cer->getImagen(); ?></td>

                   <td>
                     <a type="button" class="btn btn-warning" data-toggle="modal" data-target=<?php echo '#'.$cer->getID(); ?> >Agregar</a>

                     <div class="modal fade" id=<?php echo $cer->getID(); ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ENVASES EN STOCK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <table class="table table-bordered table-striped table-dark text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">CERVEZA</th>
                    <th scope="col">DESCRIP</th>
                    <th scope="col">LITROS</th>
                    <th scope="col">FACTOR</th>
                     <th scope="col">CANTIDAD</th>
                    <th colspan="1" align="center" scope="col">OPCION</th>           
                   </tr>
                </thead>
                <tbody>
                  <?php foreach ($listaTotalEnvase as $key => $value) 
                  {
                    
                   ?>
                  <tr style="background-color: #212529;">
                    
                  </style>>
                    <td><?php  echo $cer->getNombreCerveza(); ?></td>
                    <td><?php  echo $value->getDescripEnvase(); ?></td>
                    <td><?php  echo $value->getLitrosDeEnvasado(); ?></td>
                    <td><?php  echo $value->getFactor(); ?></td>
                    <form action="<?=BASE?>LineaPedido/nuevaLineaMetodoSecundario" method="POST">
                    <input type="number" name="idcer" value=<?php echo $cer->getID(); ?> hidden>
                    <input type="number" name="idenv" value=<?php echo $value->getID(); ?> hidden>
                    <td><input type="number" name="cantidad" value="1" ></td>
                    <td><input   class="btn btn-danger" type="submit" value="AGREGAR A CARRITO"></td>
                    </form>
                  </tr>
                  <?php  } ?>
                </tbody>
              </table>
              
          
      </div>
    
      </div>
    </div>
  </div>
                   </td>
                  </tr>
                   <?php } ?>

                </tbody>
              </table>
</div>
<hr>
<br>


<div class="container d-flex justify-content-between">
 
 <a id="btnVolver" type="button" class="btn btn-warning" href= "<?=BASE?>PaginaPrincipal/index">Volver</a>
 <a id="btnFin" type="button" class="btn btn-warning" data-toggle="modal" data-target="#Listasucursal" >Finalizar compra</a>

</div>






<!--MODAL ENVASE-->
<div class="modal fade" id="listaEnvases" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ENVASES EN STOCK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            <table class="table table-bordered table-striped table-dark text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">CERVEZA</th>
                    <th scope="col">DESCRIP</th>
                    <th scope="col">LITROS</th>
                    <th scope="col">FACTOR</th>
                     <th scope="col">CANTIDAD</th>
                    <th colspan="1" align="center" scope="col">OPCION</th>           
                   </tr>
                </thead>
                <tbody>
                  <?php foreach ($listaTotalEnvase as $key => $value) 
                  {
                    
                   ?>
                  <tr>
                    <td><?php  echo $cer->getNombreCerveza(); ?></td>
                    <td><?php  echo $value->getDescripEnvase(); ?></td>
                    <td><?php  echo $value->getLitrosDeEnvasado(); ?></td>
                    <td><?php  echo $value->getFactor(); ?></td>
                    <form action="<?=BASE?>LineaPedido/nuevaLineaMetodoSecundario" method="POST">
                    <input type="number" name="idcer" value=<?php echo $cer->getID(); ?> hidden>
                    <input type="number" name="idenv" value=<?php echo $value->getID(); ?> hidden>
                    <td><input type="number" name="cantidad" ></td>
                    <td><input type="submit" value="AGREGAR A CARRITO"></td>
                    </form>
                  </tr>
                  <?php  } ?>
                </tbody>
              </table>
              
          
      </div>
    
      </div>
    </div>
  </div>


<!--MODAL SUCURSAL-->

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
                          <input type="number" name="id" value=<?php echo $_SESSION['CuentaLogueada']->getID();  ?> hidden>
                          <input type="text" name="nombreSucursal" value=<?php echo $sucur->getNombre(); ?> hidden>
                          <input type="text" name="DomicilioSucursal" value=<?php echo $sucur->getDomicilio(); ?> hidden>
                          <td><select name="formadeObtencion">
                           <option value="RETIRO EN SUCURSAL">RETIRO EN SUCURSAL</option>
                             <option value="ENVIO DEL PEDIDO">ENVIO DEL PEDIDO</option>
                           </select></td>  
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




  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="<?=BASE?>js/bootstrap.js"></script>

</body>
</html>