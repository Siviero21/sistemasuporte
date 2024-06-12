<?php

class EmailService {
    public function enviarEmail($para, $assunto, $mensagem) {
        $headers = 'From: no-reply@suporte.com' . "\r\n" .
                   'Reply-To: no-reply@suporte.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        mail($para, $assunto, $mensagem, $headers);
    }
}
?>
