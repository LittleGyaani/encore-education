<?php

    //Disabling all errors
    error_reporting( 0);

    //Including necessary callbacks
    include '../require/phpMailer/PHPMailerAutoload.php';



    //Default time zone
    date_default_timezone_set('Asia/Kolkata');

    //Required Parameter to catch the values received via POST
    $now =  date('d-m-Y H:i');
    $fullName = $_POST['fullname'];
    $fatherName = $_POST['fathername'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $tenthAggregate = $_POST['tenthAggregate'];
    $intermediateAggregate = $_POST['intermediate'];
    $neetStatus = $_POST['NEET'];
    $neetPercent = $_POST['percent'];
    $university = $_POST['university'];
    $country = $_POST['country'];
    $ticket = 'TKT-'.date(Hi);
    $respArray = array();

    if($neetStatus == 'NO')
      $neetPercent = 'NA';

    //If no fields are blank
    if (!empty($_POST)){

      //Before Shoot Mail
      //PHPMailer Object
      $mail = new PHPMailer;
      //Enable SMTP debugging.
      // $mail->SMTPDebug = 3;
      //Set PHPMailer to use SMTP.
      $mail->isSMTP();
      //Set SMTP host name
      $mail->Host = "smtp.zoho.com";
      //Set this to true if SMTP host requires authentication to send email
      $mail->SMTPAuth = true;
      //Provide username and password
      $mail->Username = "support@exelinserv.com";
      $mail->Password = "Haxwave#1";
      //If SMTP requires TLS encryption then set it
      $mail->SMTPSecure = "TLS";
      //Set TCP port to connect to
      $mail->Port = 587;

      //From email address and name
      $mail->From = "support@exelinserv.com";
      $mail->FromName = "Abroad MBBS Application - Encore Education. Your Application Number is : <b>$ticket</b>";

      //To address and name
      $mail->addAddress($email,$fullName); //Recipient name is optional

      //Address to which recipient will reply
      $mail->addReplyTo("support@exelinserv.com", "Reply");

      //CC and BCC
      //$mail->addCC("cc@example.com");
      //$mail->addBCC("bcc@example.com");

      //Send HTML or Plain Text email
      $mail->isHTML(true);

      $mail->Subject = "Ignore Once";
      $mail->Body = "<i>New Candidate Registered <br> Candidate ID is : CANID ".$ticket." <br> Name : ".$fullName." <br> Father Name : ".$fatherName." <br> Email : ".$email." <br> Phone : ".$phone." <br> State : ".$state." <br> Country : ".$country." <br> </i>";
      $mail->AltBody = "Thank You For registering.We will get back ASAP.";

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

          //Generating Response Array
          $respArray = array('responseStatus' => $responseStatus, 'status' => $status, 'message' => $message);
      }

}else{

  echo 'Please retry';

}

//Printing Response Array
echo json_encode($respArray, JSON_PRETTY_PRINT);
