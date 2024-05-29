<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
   
    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        //Crear ojeto del email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];


        $mail->setFrom('admin@pnud.com');
        $mail->addAddress('admin@pnud.com', 'pnud.com');
        $mail->Subject = 'Confirma tu cuenta';

        //Set HTML

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta con exito,
        Solo debes confirmarla presionando el siguiente enlace: </p>";
        $contenido .= "<p>Presiona aquí: <a href='". $_ENV['APP_URL'] ."/confirmar-cuenta?token=". $this->token ."'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, favor de ignorar este correo.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar mail
        $mail->send();

    }

    public function enviarInstrucciones() {
        //Crear ojeto del email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];


        $mail->setFrom('admin@pnud.com');
        $mail->addAddress('admin@pnud.com', 'pnud.com');
        $mail->Subject = 'Reestablece tu password';

        //Set HTML

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el siguiente
        enlace para hacerlo: </p>";
        $contenido .= "<p>Presiona aquí: <a href='". $_ENV['APP_URL'] ."/recuperar?token=". $this->token ."'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, favor de ignorar este correo.</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar mail
        $mail->send();

    }
}