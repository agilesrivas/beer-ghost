<?php namespace Vistas;


$sumar=0;


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PEDIDO</title>
 <link rel="stylesheet" href="<?=BASE?>css/bootstrap.css">
<style>
body{
  font-size: 16px;
  line-height: 25px;
  padding-top: 50px;
  background-color: #e7e7e7;
  padding-bottom:50px;
}

.color-invoice{
  background-color: #ffffff;
    border: 1px solid #d7d7d7;
    padding-top:100px;
    padding-bottom:100px;
}

</style>

</head>
<body>
  
<div class="container">
  
   <div class="row color-invoice">
      <div class="col-md-12">
        #Sr: <?php echo $pedidoOK->getCuenta()->getID(); ?>    
            <div class="row">
          <div class="col-lg-7 col-md-7 col-sm-7">
            <h1>FACTURA</h1>
            <br />
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5">

            <h2>BEERGHOST</h2> Mar del Plata,
            <br> Buenos Aires,
            <br> Argentina.

          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-lg-7 col-md-7 col-sm-7">
            <h3>Detalle Cliente : </h3>
            <h5> <?php echo $cuenta->getEmail(); ?> </h5> 
            <?php echo $pedidoOK->getMetodo(); ?>
            <br /> Mar del Plata
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <h3>Sucursal: <?php echo $pedidoOK->getNombreEmpresa(); ?></h3>
            <br> 
            <h5>Domicilio:<?php echo $pedidoOK->getDomicilioSucu(); ?></h5>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <strong>DETALLE Y DESCRIPCION DEL PEDIDO:</strong>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Cantidad</th>
                    <th>Precio Unidad</th>
                    <th>Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($lineas as $key => $value){ 
                      $cerveza=$value->getTipoCerveza();
                      $present=$value->getPresentacion();
                      $sumar=$sumar+$value->getImporte();
                    ?>
                    
                  
                  <tr>
                    <td><?php echo $cerveza->getNombreCerveza(); ?></td>
                    <td><?php echo $present->getLitrosDeEnvasado(); ?></td>
                    <td><?php echo $value->getCantidad(); ?></td>
                    <td><?php echo $cerveza->getPrecioLitro(); ?></td>
                    <td><?php echo $value->getImporte(); ?></td>
                  </tr><?php } ?>
                </tbody>
              </table>
            </div>
            <hr>
            <div>
              <h4>  Total :<?php echo $sumar; ?> $ </h4>
             

            </div>
            <hr>
            <div>
              <h4>  Descuento : (NO POSSE DESCUENTOS) </h4>
            </div>
            <hr>
            <hr/>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <strong> Importante: </strong>
            <ol>
              <li>
                cosas a tener en cuenta 
              </li>
              <li>
               ...
              </li>
            </ol>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <a href="<?=BASE?>PaginaPrincipal/irPrincipal" class="btn btn-success btn-sm">Cancelar</a>
            <a href="<?=BASE?>Pedidos" class="btn btn-info btn-sm">VOLVER HOME</a>
            
            <a href="<?=BASE?>Pedidos/DescargarPdf" class="btn btn-info btn-sm">DESCARGAR PDF</a>
          </div>
        </div>
        
        <hr>
        <div class="row">
  

</div>
      </div>
    </div>



</div>



</body>
</html>