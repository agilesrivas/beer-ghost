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
      <h4>LISTA DE ENVASES</h4>
      </div>
        <div class="col-lg-3 d-flex justify-content-center">
        <button type="button" class="d-flex justify-content-end btn btn-dark" data-toggle="modal" data-target="#addenvase"> + AGREGAR ENVASE </button>
        </div>
      </div>
      <hr><br>  
      
      
     <table class="table table-bordered table-striped table-dark text-center">
   <thead class="thead-dark">
     <tr>
       <th scope="col">ID</th>
       <th scope="col">DESCRIPCION</th>
       <th scope="col">FACTOR</th>
       <th scope="col">CAPACIDAD</th>
       <th scope="col">RECARGA</th>
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
         <td><?php echo $value->getDescripEnvase(); ?></td>
         <td><?php echo $value->getFactor(); ?></td>
         <td><?php echo $value->getLitrosDeEnvasado(); ?></td>
         <td><?php echo $value->getRecarga(); ?></td>
         <td><?php echo $value->getImagen(); ?></td>
         <td><?php echo $value->getEstado(); ?></td>
         <td><a class="d-flex justify-content-end btn btn-warning" data-toggle="modal" data-target=<?php echo '#'.$value->getID(); ?> href="<?php BASE ?>TipoEnvase/modificarEnvase">Modificar</a></td>

         <div class="modal fade" id=<?php echo $value->getID(); ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR ENVASE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>TipoEnvase/modificarEnvase" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value=<?php echo $value->getID();?> hidden >
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">DESCRIPCION:</label>
                <input type="text" name="nombre" class="form-control col-lg-9" value=<?php echo $value->getDescripEnvase()?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">FACTOR:</label>
                <input type="number" name="precio" class="form-control col-lg-5" value=<?php echo $value->getFactor()?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LITROS:</label>
                <input type="number" name="litroEnv" class="form-control col-lg-5" value=<?php echo $value->getLitrosDeEnvasado() ?>>
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">RECARGA:</label>
                    <select name="recarga" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getRecarga(); ?>>
                    <option value="permitido">Permitido</option>
                    <option value=" negativo">Negado</option>
                    </select>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-lg-2 col-form-label">IMAGEN:</label>
              </div>
                <input type="file" name="imagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" value=<?php echo $value->getImagen(); ?>>

              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getEstado(); ?>>
                    <option value="Activo">ACTIVO</option>
                    <option value="Inactivo">INACTIVO</option>
                    </select>
              </div>
              
              <!--  <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>-->
        
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">MODIFICAR ENVASE</button>
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
         <td><form action="<?=BASE?>TipoEnvase/eliminarEnvase" method="POST" accept-charset="utf-8">
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


<div class="modal fade" id="addenvase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR ENVASE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>TipoEnvase/nuevoEnvase" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value="<?= $id ?>" hidden>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">TIPO:</label>
                <input type="text" name="nombre" class="form-control col-lg-9">
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">FACTOR:</label>
                <input type="float" name="precio" class="form-control col-lg-5">
              </div>
               <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LITROS:</label>
                <input type="float" name="litroEnv" class="form-control col-lg-5">
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">RECARGA:</label>
                    <select name="recarga" class="form-control col-lg-5" id="selecEstados">
                    <option value="permitido">Permitido</option>
                    <option value=" negativo">Negado</option>
                    </select>
              </div>

             
              <div class="form-group row">
                <label for="exampleInputFile" class="col-lg-2 col-form-label">IMAGEN:</label>
              </div>
                <input type="file" name="imagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <!--  <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>-->
               <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados">
                    <option value="Activo">ACTIVO</option>
                    <option value="Inactivo">INACTIVO</option>
                    </select>
              </div>
                
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">CARGAR ENVASE</button>
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


<div class="modal fade" id="modifEnvase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR ENVASE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row d-flex justify-content-center" >
           
              <form action="<?=BASE?>TipoEnvase/modificarEnvase" method="POST">
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label" hidden>ID:</label>
                <input type="number" name="id" class="form-control col-lg-9" value=<?php echo $value->getID();?> hidden >
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">DESCRIPCION:</label>
                <input type="text" name="nombre" class="form-control col-lg-9" value=<?php echo $value->getDescripEnvase()?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">FACTOR:</label>
                <input type="number" name="precio" class="form-control col-lg-5" value=<?php echo $value->getFactor()?>>
              </div>
              <div class="form-group row">
                <label for="" class="col-lg-3 col-form-label">LITROS:</label>
                <input type="number" name="litroEnv" class="form-control col-lg-5" value=<?php echo $value->getLitrosDeEnvasado() ?>>
              </div>
              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">RECARGA:</label>
                    <select name="recarga" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getRecarga(); ?>>
                    <option value="permitido">Permitido</option>
                    <option value=" negativo">Negado</option>
                    </select>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-lg-2 col-form-label">IMAGEN:</label>
              </div>
                <input type="file" name="imagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" value=<?php echo $value->getImagen(); ?>>

              <div class="form-group row">
                    <label for="" class="col-3 col-form-label">ESTADO:</label>
                    <select name="estado" class="form-control col-lg-5" id="selecEstados" value=<?php echo $value->getEstado(); ?>>
                    <option value="Activo">ACTIVO</option>
                    <option value="Inactivo">INACTIVO</option>
                    </select>
              </div>
              
              <!--  <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>-->
        
              <div class="form-group row pt-5">
                <button type="submit" class="btn btn-primary col-10 mr-auto ml-auto">MODIFICAR ENVASE</button>
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
