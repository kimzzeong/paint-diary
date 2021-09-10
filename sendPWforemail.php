<?php
  include $_SERVER['DOCUMENT_ROOT']."/db.php"; /* db load */
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

$email = $_POST["email"];

include"PHPMailer.php";
include"SMTP.php";
include"Exception.php";

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = "ssl";

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'paintdiary1@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'cru0817!!';

$mail->CharSet = 'UTF-8';

//Set who the message is to be sent from
$mail->setFrom('paintdiary1@gmail.com', 'PaintDiary'); //paintdiary1@gmail.com

//Set an alternative reply-to address
$mail->addReplyTo('paintdiary1@gmail.com', 'PaintDiary');

//Set who the message is to be sent to ->받는사람
$mail->addAddress($email, '');

//Set the subject line
$mail->Subject = '임시 비밀번호';

$characters  = "0123456789";
$characters .= "abcdefghijklmnopqrstuvwxyz";
$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$characters .= "_";

$string_generated = "";

$nmr_loops = 8;
while ($nmr_loops--)
{
    $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
}
//Replace the plain text body with one created manually
$mail->isHTML(true);
 $mail->Body = '<html>
				<body>
					<p> 회원님! </p>
					<p> 회원님의 임시 비밀번호는 다음과 같습니다. </p>
					<br>
					<p>[ '.$string_generated.' ]</p>
					<br>
					<p> 반드시 비밀번호를 변경해주세요! </p>
				</body>
			 </html>';

//여기에 sql로 비번 변경
$hashedPassword = password_hash($string_generated, PASSWORD_BCRYPT);
$fet = mq("update user set user_password = '".$hashedPassword."' where user_email = '".$email."'");
//Attach an image file
// $mail->addAttachment('img/logo.png');

//send the message, check for errors
if (!preg_match("/^[a-zA-Z]{1}[a-zA-Z0-9.\-_]+@[a-z0-9]{1}[a-z0-9\-]+[a-z0-9]{1}\.(([a-z]{1}[a-z.]+[a-z]{1})|([a-z]+))$/",$email))
  {
  // echo "<script>alert('이메일 보내기에 실패했습니다.\n이메일을 다시 확인해주세요.');</script>";
  echo "이메일 보내기에 실패했습니다. 이메일이 정확히 입력 되었는지 다시 확인해주세요.";
}else{
if (!$mail->send()) {
  echo "이메일 보내기에 실패했습니다. 이메일이 정확히 입력 되었는지 다시 확인해주세요.";
     //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    // echo "[".$string_generated."]";
    //수정해야함
    echo "이메일이 성공적으로 보내졌습니다.";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
// function save_mail($mail)
// {
//     //You can change 'Sent Mail' to any other folder or tag
//     $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
//
//     //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
//     $imapStream = imap_open($path, $mail->Username, $mail->Password);
//
//     $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
//     imap_close($imapStream);
//
//     return $result;
// }
