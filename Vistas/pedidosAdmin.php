<?php namespace Vistas; ?>
<!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     
      <br><hr>
      <div class="row">
        <div class="col-lg-3"><br><br>
      <h4>LISTA DE PEDIDOS</h4>
      </div>
        <div class="col-lg-2 d-flex justify-content-center">
        <button type="button" class="d-flex justify-content-end btn btn-dark" data-toggle="modal" data-target="#addFecha"> Consultar Por Fecha </button>
        </div>
                <div class="col-lg-2 d-flex justify-content-center">

        <button type="button1" class="d-flex justify-content-end btn btn-dark" data-toggle="modal" data-target="#addCliente"> Consultar Por Cliente </button>
        </div>
                <div class="col-lg-2 d-flex justify-content-center">

        <button type="button2" class="d-flex justify-content-end btn btn-dark" data-toggle="modal" data-target="#addSucu"> Consultar Por Sucursal </button>
        </div>
      </div>
      <hr><br>  
      
      
     <table class="table table-bordered table-striped table-dark text-center">
   <thead class="thead-dark">
     <tr>
       <th scope="col">ID</th>
       <th scope="col">FECHA</th>
       <th scope="col">CLIENTE</th>
       <th scope="col">SUCURSAL</th>
       <th scope="col">ESTADO</th>
       <th scope="col">METODO</th>
       <th colspan="3" align="center" scope="col">OPCIONES</th>
       
     </tr>
   </thead>

   <tbody>
     <?php
     foreach ($listado as $key => $value) {
       ?>
       <tr>
         <th scope="row"><?php echo $value->getID(); ?></th>
         <td><?php echo $value->getFecha(); ?></td>
         <td><?php echo $value->getCuenta()->getEmail(); ?></td>
         <td><?php echo $value->getNombreEmpresa(); ?></td>
         <td><?php echo $value->getEnvio(); ?></td>
         <td><?php echo $value->getMetodo(); ?></td>
         <td><form action="<?=BASE?>Pedidos/setNuevoEstado" method="POST" accept-charset="utf-8">
           <input type="number" name="idn" value=<?php echo $value->getID();?> hidden>
            <select name="estadoib" >
               <option value="Recibido">Recibido</option>
                <option value="Preparando">Preparando</option>
                <option value="Finalizado">Finalizado</option>
                
             </select> 
           <input class="d-flex justify-content-end btn btn-warning" type="submit" value="MODIFICAR ESTADO">
           
         </form></td>
          <td><form action="<?=BASE?>Pedidos/setNuevoMetodo" method="POST" accept-charset="utf-8">
           <input type="number" name="id" value=<?php echo $value->getID();?> hidden>
           <select name="estado" >
               <option value="Envio a Domicilio">Envio a Domicilio</option>
                <option value="Retiro en Sucursal">Retiro en Sucursal</option>
                
             </select> 
           <input class="d-flex justify-content-end btn btn-warning" type="submit" value="MODIFICAR METODO">
           
         </form></td>
         <td><form action="<?=BASE?>Pedidos/verFactura" method="POST" accept-charset="utf-8">
           <input type="number" name="id" value=<?php echo $value->getID();?> hidden>
           <input class="d-flex justify-content-end btn btn-warning" type="submit" value="VER FACTURA">
           
         </form></td>
       </tr>


<?php
}
?>

   </tbody>
 </table>

 <div class="modal fade" id="addSucu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BUSCAR POR SUCURSAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Pedidos/buscarPorSucursal" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">NOMBRE:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
             
               <div class="form-group row pt-1">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">BUSCAR SUCURSAL</button>
              </div>
              </form>
            
            </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BUSCAR POR CLIENTES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Pedidos/buscarPorCliente" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">EMAIL:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
             
               <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">BUSCAR CLIENTE</button>
              </div>
              </form>
            
            </div>
      </div>
      <div class="modal-footer">
      	   <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="addFecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BUSCAR POR FECHAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Pedidos/buscarPorFecha" method="POST">                
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">FECHA:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
               <div class="form-group row pt-1">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">BUSCAR FECHA</button>
              </div>
              </form>
            
            </div>
      </div>
      <div class="modal-footer">
      	   <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="setEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR ESTADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Pedidos/setEstadoEnvio" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">ESTADO:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
             
               <div class="form-group row pt-1">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">SETEAR ESTADO</button>
              </div>
              </form>
            
            </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="litrosPorCerveza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR ESTADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Pedidos/consultarLitros" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">Nombre Cerveza:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
             
               <div class="form-group row pt-1">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">BUSCAR CERVEZA</button>
              </div>
              </form>
            
            </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
      </div>
    </div>
  </div>
</div>




