<?php namespace Vistas;

 ?>

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
      <h4>LISTA DE CERVEZAS</h4>
      </div>
        <div class="col-lg-3 d-flex justify-content-center">
        <button type="button" class="d-flex justify-content-end btn btn-dark" data-toggle="modal" data-target="#addcerveza"> + AGREGAR CERVEZA </button>
        </div>
      </div>
      <hr><br>  
      
      
     <table class="table table-bordered table-striped table-dark text-center">
   <thead class="thead-dark">
     <tr>
       <th scope="col">ID</th>
       <th scope="col">NOMBRE</th>
       <th scope="col">PRECIO</th>
       <th scope="col">DESCRIPCION</th>
       <th scope="col">IMAGEN</th>
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
         <td><?php echo $value->getNombreCerveza(); ?></td>
         <td><?php echo $value->getPrecioLitro(); ?></td>
         <td><?php echo $value->getDescripcion(); ?></td>
         <td><?php echo $value->getImagen(); ?></td>
         <td><?php echo $value->getEstado(); ?></td>
         <td><a class="d-flex justify-content-end btn btn-warning" data-toggle="modal" data-target=<?php echo '#'.$value->getID(); ?> href="<?php BASE ?>TipoCerveza/modificarCerveza">Modificar</a></td>
         
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
           
              <form action="<?=BASE?>TipoCerveza/modificarCerveza" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value=<?php echo $value->getID();?> hidden >
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">NOMBRE:</label>
                <input type="text" name="nombre" class="form-control col-lg-9" value=<?php echo $value->getNombreCerveza()?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">PRECIO:</label>
                <input type="number" name="precio" class="form-control col-lg-5" value=<?php echo $value->getPrecioLitro()?>>
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getEstado(); ?>>
                    <option value="Activo">ACTIVO</option>
                    <option value="Inactivo">INACTIVO</option>
                    </select>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-lg-2 col-form-label">IMAGEN:</label>
              </div>
                <input type="file" name="imagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" value=<?php echo $value->getImagen(); ?>>
              <!--  <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>-->
              
                <div class="form-grou row pt-5">

                  <label for="exampleTextarea">DESCRIPCION:</label>
                  <textarea class="form-control" id="exampleTextarea" name="descripcion" rows="3" value=<?php echo $value->getDescripcion();?>><?php echo $value->getDescripcion(); ?></textarea>
                </div>
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-12 mr-auto ml-auto">MODIFICAR CERVEZA</button>
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




         <td><form action="<?=BASE?>TipoCerveza/eliminarCerveza" method="POST" accept-charset="utf-8">
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


<div class="modal fade" id="addcerveza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR CERVEZA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>TipoCerveza/nuevaCerveza" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value="<?= $id ?>" hidden>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">NOMBRE:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">PRECIO:</label>
                <input type="number" name="precio" class="form-control col-lg-5">
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados">
                    <option value="Activo">ACTIVO</option>
                    <option value="Inactivo">INACTIVO</option>
                    </select>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-lg-2 col-form-label">IMAGEN:</label>
              </div>
                <input type="file" name="imagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <!--  <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>-->
              
                <div class="form-group row pt-5">

                  <label for="exampleTextarea">DESCRIPCION:</label>
                  <textarea class="form-control" id="exampleTextarea" name="descripcion" rows="3"></textarea>
                </div>
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">CARGAR CERVEZA</button>
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


<div class="modal fade" id="modifcerveza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
           
              <form action="<?=BASE?>TipoCerveza/modificarCerveza" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value=<?php echo $value->getID();?> hidden >
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">NOMBRE:</label>
                <input type="text" name="nombre" class="form-control col-lg-9" value=<?php echo $value->getNombreCerveza()?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">PRECIO:</label>
                <input type="number" name="precio" class="form-control col-lg-5" value=<?php echo $value->getPrecioLitro()?>>
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getEstado(); ?>>
                    <option value="Activo">ACTIVO</option>
                    <option value="Inactivo">INACTIVO</option>
                    </select>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-lg-2 col-form-label">IMAGEN:</label>
              </div>
                <input type="file" name="imagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" value=<?php echo $value->getImagen(); ?>>
              <!--  <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>-->
              
                <div class="form-grou row pt-5">

                  <label for="exampleTextarea">DESCRIPCION:</label>
                  <textarea class="form-control" id="exampleTextarea" name="descripcion" rows="3" value=<?php echo $value->getDescripcion();?>><?php echo $value->getDescripcion(); ?></textarea>
                </div>
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">MODIFICAR CERVEZA</button>
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
