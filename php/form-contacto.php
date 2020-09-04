<?php
if(isset($_POST['correo'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "juniortosta@bmsoccer.com.mx";
    $email_subject = "Contacto a través del sitio";
 
    function died($error) {
        // your error code can go here
        echo "Lo siento, pero hemos encontrado errores al rellenar el formulario. ";
        echo "Estos son los errores que se indican a continuación<br /><br />";
        echo $error."<br /><br />";
        echo "¡Por favor, vuelve e inténtalo de nuevo! <br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['nombre']) ||
        !isset($_POST['correo']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['mensaje'])) {
        died('Lo siento, pero hemos encontrado errores al rellenar el formulario.        ');       
    }
 
     
 
    $first_name = $_POST['nombre']; // required
    $email_from = $_POST['correo']; // required
    $telephone = $_POST['telefono']; // not required
    $comments = $_POST['mensaje']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La dirección de correo electrónico que has rellenado no parece válida.    <br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'El nombre que ha rellenado no parece válido.    <br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'El mensaje que ha rellenado no parece válido.
    <br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalles del mensaje de abajo.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
    $email_message .= "Correo electrónico: ".clean_string($email_from)."\n";
    $email_message .= "Teléfono: ".clean_string($telephone)."\n";
    $email_message .= "Mensaje: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
echo "<script>alert("¡Gracias! Nos pondremos en contacto con usted pronto");window.location.assign('http://www.bmsoccer.com.mx');</script>";
 
<?php
 
}
?>