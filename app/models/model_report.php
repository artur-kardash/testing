<?php
    use Dompdf\Dompdf;
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.01.2017
 * Time: 13:47
 */
class Model_Report extends Model
{
    private $dompdf;

    /**
     * Model_Report constructor.
     */
    public function __construct(){
        require_once str_replace('\\', '/', _MAIN_DOC_ROOT_.'/app/libs/dompdf/vendor/autoload.php');
//        require_once str_replace('\\', '/', _MAIN_DOC_ROOT_.'/app/libs/dompdf/vendor/dompdf/dompdf/autoload.inc.php');
        $this->dompdf = new Dompdf();
    }

    public function generate_pdf($html){
        $report_html =$this->template_report('header');
        $report_html .=$html;
        $report_html .=$this->template_report('footer');

        $dompdf = new Dompdf();
        $dompdf->loadHtml($report_html);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

//         $dompdf->stream();
         $dompdf->output();

        $filename = 'client-report'.strtotime("now");

        $pdf=$dompdf->output();
        @file_put_contents(UPLOAD_DIR.'/'.$filename.".pdf", $pdf);
        $url = json_encode(__HOST__.'/downloads/'.$filename.".pdf");

        return $url;

    }

    public function save_pdf(){
        $filename = 'js-client-report'.strtotime("now").rand(1,10);
        $data = base64_decode($_POST['data']);
        @file_put_contents(UPLOAD_DIR.'/'.$filename.".pdf", $data);
        $url = json_encode(__HOST__.'/downloads/'.$filename.".pdf");

        return $url;
    }

    public function send_pdf_mail($file_name, $email){

        return $this->send_mail_pdf($file_name, $email);
        require_once str_replace('\\', '/', _MAIN_DOC_ROOT_.'/app/libs/PHPMailer/PHPMailerAutoload.php');


        $mail = new PHPMailer();

        $mail->From     = 'me@example.com';
        $mail->FromName = 'My name';
        $mail->AddAddress('sergiy.zub@jointoit.com',"John Doe");

        $mail->WordWrap = 50;
        $mail->IsHTML(true);

        $mail->Subject  =  "Contact Form Submitted";
        $mail->Body     =  "This is the body of the message.";

        $path = UPLOAD_DIR.'/';
        $mail->AddAttachment($path, $file_name.'.pdf');

        if(!$mail->send()) {
        $msg =  'Message could not be sent. ';
        $msg .=' Mailer Error: ' . $mail->ErrorInfo;
            } else {
        $msg = 'Message has been sent';
        }
        return $msg;
    }

    public function send_mail_pdf($file_name, $email){
        $filename = $path = UPLOAD_DIR.'/'.$file_name.".pdf"; //Имя файла для прикрепления
        $to = "$email, ".ADMINEMAIL; //Кому ADMINEMAIL
        $from = "def@gmail.com"; //От кого
        $subject = "Test"; //Тема
        $message = "Text msg"; //Текст письма
        $boundary = "---"; //Разделитель
        /* Заголовки */
        $headers = "From: $from\nReply-To: $from\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";
        $body = "--$boundary\n";
        /* Присоединяем текстовое сообщение */
        $body .= "Content-type: text/html; charset='utf-8'\n";
        $body .= "Content-Transfer-Encoding: quoted-printablenn";
        $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
        $body .= $message."\n";
        $body .= "--$boundary\n";
        $file = fopen($filename, "r"); //Открываем файл
        $text = fread($file, filesize($filename)); //Считываем весь файл
        fclose($file); //Закрываем файл
        /* Добавляем тип содержимого, кодируем текст файла и добавляем в тело письма */
        $body .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode($filename)."?=\n";
        $body .= "Content-Transfer-Encoding: base64\n";
        $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
        $body .= chunk_split(base64_encode($text))."\n";
        $body .= "--".$boundary ."--\n";
//        mail($to, $subject, $body, $headers); //Отправляем письмо
        if( !mail($to, $subject, $body, $headers)) {
            $msg =  'error';
        } else {
            $msg = 'Message has been sent to :' .$to;
        }
        return $msg;
    }

    public function template_report($part){
        $header = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
            <html lang="en">
            <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <title>Document</title>
            </head>
            <body>
            <h1>PDF Report</h1>';
        $footer = '</body></html>';
        if ($part == 'header'){
            return $header;
        } elseif($part == 'footer'){
            return $footer;
        }
        return '';
    }

    public function get_client_info(){
        if (!$client_id = $_GET['id']){
            return 'there has no client id';
        }
        return $client_id;
    }

    public function get_agency_info(){
        session_start();
        $agency_id = $_SESSION['user_id'];
    }
}