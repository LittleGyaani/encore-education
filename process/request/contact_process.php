<?php

//Hiding all errors and notices
error_reporting(0);

//Including necessary callbacks
include '../require/phpMailer/PHPMailerAutoload.php';

//Setting Header Type for JSON Output
header('Content-Type:application/json');

//Declaring default Date and Time Zone for Stamps
date_default_timezone_set('Asia/Kolkata');

//Allow Cross Access from Origin
header("Access-Control-Allow-Origin: *");

//Default time zone
date_default_timezone_set('Asia/Kolkata');

//Required Parameter to catch the values received via POST
$now =  date('d-m-Y H:i');
$ticket = 'TKT-'.date(Hi);
$respArray = array();
$email = $_POST['email'];
$location = $_POST['location'];
$fullName = $_POST['name'];
$message = $_POST['message'];
$phone = $_POST['phone'];

//If no fields are blank
if (!empty($_POST)){

    //Before Shoot Mail
    //PHPMailer Object
    $mail = new PHPMailer;
    //Enable SMTP debugging.
    //$mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name
    $mail->Host = "send.one.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password
    $mail->Username = "encore@encoregroup.in";
    $mail->Password = "saroj@66";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "STARTTLS";
    //Set TCP port to connect to
    $mail->Port = 587;

    //From email address and name
    $mail->From = "encore@encoregroup.in";
    $mail->FromName = "Quick Enquiry - Encore Education. Your Enquiry Ticket Number is : $ticket";

    //To address and name
    $mail->addAddress($email,$fullName); //Recipient name is optional

    //Address to which recipient will reply
    $mail->addReplyTo("encore@encoregroup.in", "Reply");

    //CC and BCC
    $mail->addCC("sarojbbs@gmail.com");
    //$mail->addBCC("bcc@example.com");

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "Thank you for getting in touch - Encore Education.";
    $mail->Body = "<i>Thank you for your query. Below are your ticket details <br> Ticket ID is : ".$ticket." <br> Name : ".$fullName."  <br> Email : ".$email." <br> Phone : ".$phone." <br> State : ".$location."  <br> </i>";
    $mail->AltBody = "Thank You For your query.We will get back ASAP.";

    if(!$mail->send()){

        $message = "Mail Sending Failed!";
        $responseStatus  = false;
        $status = 'FAIL';

        //Generating Response Array
        $respArray = array('responseStatus' => $responseStatus, 'status' => $status, 'message' => $message);

    }else{

        $message = "Mail Sent Successfully";
        $responseStatus  = true;
        $status = 'OK';

        //Send SMS for TEAM & Enquirer
        $teamMessage = "A new contact request has been received '$ticket'. Please take follow-up. Contact Name : $fullName & Phone : $phone at $now";
        $sendTeamMessage = file_get_contents('http://www.smscgateway.com/messageapi.asp?username=sarojbbs&password=jaisrisai&sender=ENCORE&mobile=8763333393,9040050029&message='.urlencode($teamMessage).'');
        $enquirerMessage = "Thank you for getting in touch. Your ticket ID is $ticket. We will contact you shortly. Please keep this ticket number handy. Call us on 87633333933 or visit www.encoregroup.in for more info.";
        $sendEnquirerMessage = file_get_contents('http://www.smscgateway.com/messageapi.asp?username=sarojbbs&password=jaisrisai&sender=ENCORE&mobile='.$phone.'&message='.urlencode($enquirerMessage).'');

        //Generating Response Array
        $respArray = array('responseStatus' => $responseStatus, 'status' => $status, 'message' => $message, 'ticketNumber' => $ticket);

    }

}else{

    $message = "Please retry fields are blank.";
    $responseStatus  = false;
    $status = 'ERROR';

    //Generating Response Array
    $respArray = array('responseStatus' => $responseStatus, 'status' => $status, 'message' => $message);

}

//Printing Response Array
echo json_encode($respArray, JSON_PRETTY_PRINT);
