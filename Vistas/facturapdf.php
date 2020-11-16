<?php 
require("lib/mpdf60/mpdf.php"); 



$html = '<head>
<style>
body{
  font-size: 13px;
  line-height: 20px;
  padding-top: 30px;
  background-color: #e7e7e7;
  padding-bottom:50px;
}

.color-invoice{
  background-color: #ffffff;
    border: 1px solid #d7d7d7;
    padding-top:50px;
    padding-bottom:100px;
}
</style>
</head>

<div class="container">
  
   <div class="row color-invoice">
      <div class="col-md-12">
        #Sr. ID: (aca va id cliente)
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
            <h5> aca va nombre </h5> aca va dirreccion
            <br /> Mar del Plata
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5">
            <h3>Client Vendedor :</h3> aca va nombre sucursal
            <br> aca va un mail o una direccion
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
                  <tr>
                    <td>ale</td>
                    <td>xl</td>
                    <td>1</td>
                    <td>5000$</td>
                    <td>5000$</td>
                  </tr>';
                
         $html.= '<tr>
         			<td>'
	                . print('aca va codigo php') .
	                	'</td>
					</tr>';

         $html .=
 
               	'</tbody>
              </table>
            </div>
            <hr>
            <div>
              <h4>  Total : 2000 $ </h4>
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

      </div>
    </div>';

$mpdf = new mPDF('c','A4', 11, 'Arial');
$css = file_get_contents('css/bootstrap.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output('factura.pdf','I');

 ?>