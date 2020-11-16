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
        <div class="col-lg-9">
      <h4>LISTA DE SUCURSALES</h4>
      </div>
        <div class="col-lg-3 d-flex justify-content-center">
        <button type="button" class="d-flex justify-content-end btn btn-dark" data-toggle="modal" data-target="#addSucu"> + AGREGAR SUCURSAL </button>
        </div>
      </div>
      <hr><br>  
      
      
     <table class="table table-bordered table-striped table-dark text-center">
   <thead class="thead-dark">
     <tr>
       <th scope="col">ID</th>
       <th scope="col">NOMBRE</th>
       <th scope="col">DOMICILIO</th>
       <th scope="col">LONGITUD</th>
       <th scope="col">LATITUD</th>
       <th scope="col">ESTADO</th>
       <th colspan="2" align="center" scope="col">OPCIONES</th>
       
     </tr>
   </thead>

   <tbody>
     <?php
     foreach ($listado as $key => $value) {
       ?>
       <tr>
         <th scope="row"><?php echo $value->getID(); ?></th>
         <td><?php echo $value->getNombre(); ?></td>
         <td><?php echo $value->getDomicilio(); ?></td>
         <td><?php echo $value->getLongitud(); ?></td>
         <td><?php echo $value->getLatitud(); ?></td>
         <td><?php echo $value->getEstado(); ?></td>
         <td><a class="d-flex justify-content-end btn btn-warning" data-toggle="modal" data-target=<?php echo '#'.$value->getID(); ?> href="<?php BASE ?>Sucursales/modificarSucursal">Modificar</a></td>


         <div class="modal fade" id=<?php echo $value->getID(); ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR CERVEZA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Sucursales/modificarSucursal" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value=<?php echo $value->getID();?> hidden >
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">NOMBRE:</label>
                <input type="text" name="nombre" class="form-control col-lg-9" value=<?php echo $value->getNombre();?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">DIRECCION:</label>
                <input type="text" name="dom" class="form-control col-lg-9" value=<?php echo $value->getDomicilio();?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LATITUD:</label>
                <input type="number" name="lat" class="form-control col-lg-5" value=<?php echo $value->getLongitud();?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LONGITUD:</label>
                <input type="number" name="long" class="form-control col-lg-5" value=<?php echo $value->getLatitud();?>>
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getEstado(); ?>>
                    <option value="Activo">ACTIVA</option>
                    <option value="Inactivo">INACTIVA</option>
                    </select>
              </div>
              
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">MODIFICAR SUCURSAL</button>
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


         <td><form action="<?=BASE?>Sucursales/eliminarSucursal" method="POST" accept-charset="utf-8">
          <input type="number" name="id" value=<?php echo $value->getID();?> hidden>
           <input class="d-flex justify-content-end btn btn-warning" type="submit" value="Eliminar">
         </form></td>
       </tr>


<?php
}
?>

   </tbody>
 </table>

<!-- modal agregar cerveza -->


<div class="modal fade" id="addSucu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR SUCURSAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Sucursales/nuevaSucursal" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value="<?= $id ?>" hidden>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">NOMBRE:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">DOMICILIO:</label>
                <input type="text" name="dom" class="form-control col-lg-5">
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LONGITUD:</label>
                <input type="number" name="long" class="form-control col-lg-5">
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LATITUD:</label>
                <input type="number" name="lat" class="form-control col-lg-5">
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados">
                    <option value="Activa">ACTIVO</option>
                    <option value="Inactiva">INACTIVO</option>
                    </select>
              </div>
               <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">CARGAR SUCURSAL</button>
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


<!-- fin modal agregar cerveza -->


<div class="modal fade" id="modifSucu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR CERVEZA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>Sucursales/modificarSucursal" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value=<?php echo $value->getID();?> hidden >
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">NOMBRE:</label>
                <input type="text" name="nombre" class="form-control col-lg-9" value=<?php echo $value->getNombre();?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">DIRECCION:</label>
                <input type="text" name="dom" class="form-control col-lg-9" value=<?php echo $value->getDomicilio();?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LATITUD:</label>
                <input type="number" name="lat" class="form-control col-lg-5" value=<?php echo $value->getLongitud();?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LONGITUD:</label>
                <input type="number" name="long" class="form-control col-lg-5" value=<?php echo $value->getLatitud();?>>
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getEstado(); ?>>
                    <option value="Activo">ACTIVA</option>
                    <option value="Inactivo">INACTIVA</option>
                    </select>
              </div>
              
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">MODIFICAR SUCURSAL</button>
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



   </body>
 </html>

