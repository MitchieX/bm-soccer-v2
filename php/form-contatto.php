<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "juniortosta@bmsoccer.com.mx";
    $email_subject = "Contacto a través del sitio";
 
    function died($error) {
        // your error code can go here
        echo "Mi dispiace, ma abbiamo trovato degli errori nella compilazione del modulo. ";
        echo "Questi sono gli errori elencati di seguito<br /><br />";
        echo $error."<br /><br />";
        echo "Per favore, tornate e riprovate! <br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['nome']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['messaggio'])) {
        died('Mi dispiace, ma abbiamo trovato degli errori nella compilazione del modulo.');       
    }
 
     
 
    $first_name = $_POST['nome']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telefono']; // not required
    $comments = $_POST['messaggio']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Lindirizzo e-mail che hai compilato non sembra valido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Il nome che avete compilato non sembra valido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Il messaggio che avete compilato non appare valido.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Dettagli del messaggio qui sotto. \n\n";
 
     
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
 
echo "<script>alert("Grazie! Vi contatteremo presto");window.location.assign('http://www.bmsoccer.com.mx');</script>";
 
<?php
 
}
?>