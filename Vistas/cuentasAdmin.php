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
      <h4>CUENTAS DE CLIENTES</h4>
      </div>
        <div class="col-lg-3 d-flex justify-content-center">
        </div>
      </div>
      <hr><br>  
      
      
     <table class="table table-bordered table-striped table-dark text-center">
   <thead class="thead-dark">
     <tr>
       <th scope="col">ID</th>
       <th scope="col">NOMBRE</th>
       <th scope="col">EMAIL</th>
       <th scope="col">CONTRASEÑA</th>
       <th scope="col">ESTADO</th>
       <th scope="col">ROL</th>
       <th colspan="2" align="center" scope="col">OPCIONES</th>
       
     </tr>
   </thead>

   <tbody>
     <?php
     foreach ($listado as $key => $value) {
       ?>
       <tr>
         <th scope="row"><?php echo $value->getID(); ?></th>
         <td><?php echo $value->getUsuario(); ?></td>
         <td><?php echo $value->getEmail(); ?></td>
         <td><?php echo $value->getPassword(); ?></td>
         <td><?php echo $value->getEstado(); ?></td>
         <td><?php echo $value->getRol()->getDescripcion(); ?></td>
         <td><form action="<?=BASE?>Registro/setearModifRol" method="POST" accept-charset="utf-8">
          <input type="number" name="id" value=<?php echo $value->getID();?> hidden>
            <select name="estado" >
               <option value="Usuario">Usuario</option>
                <option value="Administrador">Administrador</option>
             </select> 
          <input class="d-flex justify-content-end btn btn-warning" type="submit" value="ACTUALIZAR ROL">
         </form></td>
         <td><form action="<?=BASE?>Registro/eliminarCuenta" method="POST" accept-charset="utf-8">
          <input type="number" name="id" value=<?php echo $value->getID();?> hidden>
           <input  class="d-flex justify-content-end btn btn-warning" type="submit" value="ELIMINAR">
         </form></td>
       </tr>


<?php
}
?>

   </tbody>
 </table>
   </body>
 </html>
