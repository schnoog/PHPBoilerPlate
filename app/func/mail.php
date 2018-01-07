<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//für jeden aufruf wichtig!!!!

//////////////////////////////////////////////////////////////////////////////////////////
function fSendRegMail($email, $selector, $token, $bolEmailChange = false)
{
    global  $Settings;
    $sab ='/login/?action=activate';
    if (!$bolEmailChange) {
        $sab ="";
    }
    
    $subj = _('Your'). " " . $Settings['page']['projectname'] . " ". _('account activation');

    $thtml = _("In order to use our service, you'll need to activate your account")."<br><br>";

    $text = strip_tags(br2nl($thtml)) . $Settings['page']['baseurl'] ;

    $html = $thtml. "<a href='" . $Settings['page']['baseurl'] . $sab . "'>" . $Settings['page']['baseurl'] . $sab . "</a>";
    $thtml = "<br><br>"._('Once you logged in, you will be able to enter the following activation codes.')."<br><br>";
    $thtml .= "Security-Key<b> " . $selector . "</b><br>";
    $thtml .= "Security-Token<b> " . $token . "</b><br>";
    $thtml .= _("After this, you'll be able to login again and use our service")."<br><br>";
    $thtml .= _('Best regards')."<br>" ;
    $html .= $thtml;
    $text .= strip_tags(br2nl($thtml));
    $tmp = fSendMail($email, $Settings['page']['mailservice'], $subj, $html, $text);
    return $tmp;
}

//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
function fSendPWResetMail($email, $selector, $token)
{
    global  $Settings;
    
    $subj = _('Your')." " . $Settings['page']['projectname'] . " "._('password reset');

    $thtml = _('You just requested a password reset')."<br><br>";

    $text = strip_tags(br2nl($thtml)) . $Settings['page']['baseurl'] ;

    $html = $thtml. "<a href='" . $Settings['page']['baseurl'] . "'>" . $Settings['page']['baseurl'] . "</a>";
    $thtml = "<br><br>"._('Use the password forgotten function and enter the following activation codes')."<br><br>";
    $thtml .= "Security-Key<b> " . $selector . "</b><br>";
    $thtml .= "Security-Token<b> " . $token . "</b><br>";
    $thtml .= _('and set your new password')."<br><br>";
    $thtml .= _('Best regards')."<br>" ;
    $html .= $thtml;
    $text .= strip_tags(br2nl($thtml));
    $tmp = fSendMail($email, $Settings['page']['mailservice'], $subj, $html, $text);
    return $tmp;
}

//////////////////////////////////////////////////////////////////////////////////////////


function fSendMail($rcp, $sender, $subject, $texthtml, $textplain="")
{
    global $mailsetting;
   
    $system = $sender;
    $host = $mailsetting[$system]['host'];
    $username =$mailsetting[$system]['user'];
    $un = $username . "@". $host;
    $pass  = $mailsetting[$system]['password'];
    $sendname = $mailsetting[$system]['name'];
    $to = $rcp;
    $port = $mailsetting[$system]['port'];

    //echo "Sending $to a mail from $un ( $username , $sendname) over $host : $port ";

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );
    
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $un;                 // SMTP username
    $mail->Password = $pass;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $port;                                    // TCP port to connect to
   
    //Recipients
        $mail->setFrom($un, $sendname);
        // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($to);               // Name is optional
    $mail->addReplyTo($un);
        //  $mail->addCC('cc@example.com');
        //  $mail->addBCC('bcc@example.com');

        //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
        $mail->Body    = $texthtml;
        $mail->AltBody = $textplain;

        $mail->send();
        return $mail;
    } catch (Exception $e) {
        error_log("MAIL FAILED" . '\n' . print_r($mail, true));
        return $mail;
    }
}
