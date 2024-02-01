<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require_once("core/mod_includes/php/ctracker.php");
include_once("core/mod_includes/php/connect.php");
$base_url = 'https://' . $_SERVER['HTTP_HOST'] . '/blog/';

$email = explode("recupera_login/", $_SERVER["REQUEST_URI"]);

$sql_email = "SELECT * FROM users where id = :id limit 1";
$stmt_email = $PDO->prepare($sql_email);
$stmt_email->bindValue(':id', $email[1]);
if ($stmt_email->execute()) {
    $result_email = $stmt_email->fetch();
  
}else{
    echo'<script>window.location.href = "'.$base_url.'restrita/login";</script>';
    exit;
}

$sql_sistema = "SELECT * FROM sistema where sistema_id = :sistema_id";
$stmt_sistema = $PDO->prepare($sql_sistema);
$stmt_sistema->bindValue(':sistema_id', 1);
if ($stmt_sistema->execute()) {
    $result_sistema = $stmt_sistema->fetch();
}else{
    echo'<script>window.location.href = "'.$base_url.'restrita/login";</script>';
    exit;
}



			// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
			require("core/mod_includes/php/phpmailer/class.phpmailer.php");

			// Inicia a classe PHPMailer
			$mail = new PHPMailer();
			// Define os dados do servidor e tipo de conexão
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$mail->IsSMTP();
			$mail->Host = "mail.mogicomp.com.br"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
			$mail->SMTPAuth = false; // Usa autenticação SMTP? (opcional)
			$mail->Username = 'autenticacao@mogicomp.com.br'; // Usuário do servidor SMTP
			$mail->Password = 'Infomogi123#'; // Senha do servidor SMTP

			// Define o remetente
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$mail->From = $result_sistema['sistema_email'];
			$mail->Sender = $result_sistema['sistema_email'];
			$mail->FromName = $result_sistema['sistema_site_titulo']; 

			// Define os destinatário(s)
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$mail->AddAddress($result_email['usuario_email']);

			// Define os dados técnicos da Mensagem
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML

			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

			// Define a mensagem (Texto e Assunto)
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$assunto = 'Recuperação de login'; 
			$mail->Subject  = '=?utf-8?B?' . base64_encode($assunto) . '?='; 
			$mail->Body = '
                    <head>
                        <style type="text/css">
                            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Zen+Kaku+Gothic+New&display=swap");
                            .email {
                                margin: 30px 2%;
                                font-family: "Zen Kaku Gothic New", sans-serif; 
                                color: #585857;
                                font-size: 18px;
                            }
                    
                            .destaque {
                                font-family: "Poppins", sans-serif;
                            }
                            .mensagem {
                                width: 95%;
                                margin: 0 auto;
                                padding:20%;
                                margin-bottom:100px;
                            }
                    
                            .rodape {
                                padding: 1% 2%;
                                border-top: 2px solid #666;
                                font-style: italic;
                                font-size:14px;
                            }
                        </style>
                    </head>
                    
                    <body>
                        <div class="email">
                            <p><b class="destaque">Olá, '.$result_email['nome'].'. Acesse esse link para criar uma nova senha, <a href="'.$base_url.'restrita/login/cria_novo_login/'.$result_email['token'].'">clique aqui para gerar sua senha.</a></p>
                    
                            <div class="rodape">
                                <b>Este é um email gerado automaticamente pelo sistema da '.$result_sistema['sistema_site_titulo'].'.</b><br><br>
                                As informações contidas nesta mensagem e nos arquivos anexados são para uso restrito, sendo seu sigilo protegido por lei, não havendo ainda garantia legal quanto à integridade de seu conteúdo. Caso não seja o destinatário, por favor desconsidere essa mensagem. O uso indevido dessas informações será tratado conforme as normas da empresa e a legislação em vigor.
                            </div>
                    
                        </div>
                    </body>
                ';

			// Envia o e-mail
			$enviado = $mail->Send();

			// Limpa os destinatários e os anexos
			$mail->ClearAllRecipients();

            if ($enviado){
							
                echo'<script>window.location.href = "'.$base_url.'restrita/login/recupera_login_enviado/'.$result_email['token'].'";</script>';
                exit;

            }else{

                echo'<script>window.location.href = "'.$base_url.'restrita/login/erro_email/'.$result_email['token'].'";</script>';
                
                exit;

            }

			?>


