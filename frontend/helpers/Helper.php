<?php

    require_once 'libraries/PHPMailer/src/Exception.php';
    require_once 'libraries/PHPMailer/src/PHPMailer.php';
    require_once 'libraries/PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    class Helper {

        const STATUS_ACTIVE = 1;
        const STATUS_DISABLED = 0;
        const STATUS_ACTIVE_TEXT = 'Active';
        const STATUS_DISABLED_TEXT = 'Disabled';
        // Tài khoản Gmail
        const MAIL_USERNAME = '';
        //Mật khẩu ứng dụng
        const MAIL_PASSWORD = '';

        /**
         * Gửi mail sử dụng thư viện PHPMailer
         * @param $to string Email nhận
         * @param $subject string Tiêu đề mail
         * @param $body string Nội dung mail
         */


        public static function sendMail(){

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

            try {
                //Server settings
                $mail->CharSet = 'utf8'; //fix gửi mail lỗi font có dấu
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp1.example.com;';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'vuongn6800@gmail.com';              // SMTP username
                $mail->Password = 'umfelmcyogbsfjrh';                           // SMTP password umfelmcyogbsfjrh
                $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('vuongn6800@gmail.com', 'Mailer');

                $mail->addAddress('vuongn123456789@gmail.com','vuongn123456789');     // Add a recipient

//                $mail->addReplyTo('info@example.com', 'Information');
//                $mail->addCC('cc@example.com');
//                $mail->addBCC('bcc@example.com');

                //Attachments
//                $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'subjest';
                $mail->Body    = 'body';
//                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

        }
    }




