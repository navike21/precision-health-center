<?php
  //include_once("../gestion-datos/data/conexion.php");

  $nombre  = $_POST["name"];
  $correo  = $_POST["email"];
  $asunto  = "Contact from web";
  $services = $_POST['services'];
  $mensaje = "";
  echo "cualquiercosa";
  
  echo $nombre;
  
  if($nombre != "" && $correo != "" && $services != ""){

      $registro = date("Y-m-d H:i:s");
      
    
      $to = 'ivan@navike21.com';
      // $to = 'info@precisionhealthcenters.com';
    
      $subject = 'New contact from web - '.$registro;
    
      $headers = "From: Precision Health Center <".strip_tags("info@precisionhealthcenters.com").">\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    
    
      $message = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <title>Document</title>
        </head>
        <body style="background-color:#2B388F;">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" valign="middle" style="border-collapse: collapse; font-family: Arial; color: #808080; font-weight: 200; background-color:#2B388F; position: absolute; height:100%; top: 0px; bottom: 0px; left:0px;">
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-family: Arial; color: #808080; font-weight: 200; background-color:#fff;">
              <tr>
                <td style="background-color:#fff" height="5">&nbsp;</td>
              </tr>
              <tr>
                <td style="background-color:#ffffff">
                  &nbsp;&nbsp;&nbsp;<img style="margin: 15px;" src="https://precisionhealthcenters.com/images/isologo.png" alt="Logo" width="110">
                </td>
              </tr>
              <tr><td heigh="10" >&nbsp;</td></tr>
              <tr>
                <td align="center">
                  <h2 style="padding: 10px 0px; color:black;">New Contact from web</h2>
                </td>
              </tr>
              <tr><td heigh="10" >&nbsp;</td></tr>
              <tr>
                <td>
                  <p style="margin: 5px 30px; font-weight: 700; color:#2B388F; font-size: 18px;">Name:&nbsp;'.$nombre.'</p>
                  <p style="margin: 5px 30px 10px; font-size: 14px; color:black;">Email:&nbsp; '.$correo.'</p>
                  <p style="margin: 5px 30px 10px; font-size: 14px; color:black;">Service:&nbsp; '.$services.'</p>
                </td>
              </tr>
              <tr>
                <td heigh="20" >&nbsp;</td>
              </tr>
            </table>
          </table>
        </body>
        </html>
      ';
      mail($to, $subject, $message, $headers);
    
      echo true;
  }
  else {
      echo false;
  }
?>