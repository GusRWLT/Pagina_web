<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'donaresayudar1@gmail.com';             //SMTP username
        $mail->Password   = 'LnqtYswiu3ve29i';                      //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('donaresayudar1@gmail.com', 'Donar es ayudar');
        $mail->addAddress($usu_email);                     //Add a recipient (name is optional)

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $mensaje;

        $mail->CharSet = 'UTF-8';

        $mail->send();
        //echo 'El mensaje se ha enviado correctamente.';
        header("location:../listadadores.php");
    } catch (Exception $e) {
        echo "El mensaje no se pudo enviar. Error: {$mail->ErrorInfo}";
    }
?>