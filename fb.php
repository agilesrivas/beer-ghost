<?php 




 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Facebook</title>
 </head>
 <body>
       <a id="loguin" href="" >Iniciar Seccion</a>


       <script>
       	// Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
       </script>
 </body>
 </html>