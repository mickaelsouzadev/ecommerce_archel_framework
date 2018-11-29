<?php  
/* PHP Class for send Emails
 * AUTHOR: Mickael Souza
 * LAST EDIT: 2018-11-26
 */
namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

date_default_timezone_set('Etc/UTC');


class Email
{
	private $from;
	private $to;
	private $subject;
	private $message;
	private $html;
	private $replyUser;
	private $mailer;

	public function __construct($from = 'mickael.souza.if@gmail.com', $name = 'Arthur & Michel - Autopeças', $to, $message, $html = null, $replyUser = null)
	{
		$this->mailer = new PHPMailer(true);
		$this->from = $from;
		$this->name = $name;
		$this->to = $to;
		$this->message = $message;
		$this->html = $html;
		$this->replyUser = $replyUser;

		if($replyUser == null) {
			$this->replyUser = $this->de;
		}

	}

	public function sendEmail()
	{
		$this->mailer->isSMTP();

 		$this->mailer->SMTPOptions =[
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $this->mailer->SMTPDebug = 0;

        $this->mailer->Host = 'smtp.gthis->mailer.com';

        $this->mailer->Port = 587;

        $this->mailer->SMTPSecure = 'tls';

        $this->mailer->SMTPAuth = true;

        $this->mailer->AuthType = 'XOAUTH2';

        $clientId = '650637100521-l7vjuevtin11gkeilgk0u4536mt9dtk8.apps.googleusercontent.com';
        $clientSecret = '8YVq0ZY6c34mLDzuoICanxez';

        $refreshToken = '1/ey7h_uZ2ZpeXDpc4VCpde3CVzVwXMeS5EPmzgZAOBak';

        $provider = new Google([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret
        ]);

        $this->mailer->setOAuth( new OAuth([
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $this->from])
        );

        try {
        	$this->mailer->ClearReplyTos();

	        $this->mailer->addReplyTo($this->replyUser, '');

	        $this->mailer->setFrom($this->from, $this->name);

	        $this->mailer->addAddress($this->to, $this->to);

	        $this->mailer->Subject = $this->subject;

	        $this->mailer->CharSet = 'utf-8';
	         
	        if (!$this->html)
	                $this->html = $this->message;

	        $this->mailer->msgHTML($this->html, dirname(__FILE__));

	        $this->mailer->AltBody = $this->mensagem;

	        $result = $this->mailer->Send();

        } catch(phpmailerException $e) {
        	echo $e->errorMessage();
        } catch (Exception $e) {
        	echo $e->getMessage();
        } finally {
        	return $result;
        }
       
	}
}