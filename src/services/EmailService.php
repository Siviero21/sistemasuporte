<?php

class EmailService {
    public function enviarEmail($para, $assunto, $mensagem) {
        $headers = 'From: exemplo@suporte.com' . "\r\n" .
                   'Reply-To: exemplo@suporte.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        mail($para, $assunto, $mensagem, $headers);
    }
}
?>
