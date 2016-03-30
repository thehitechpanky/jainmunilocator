<?php
require("../sendgrid-php/sendgrid-php.php");
include '../sendgridkey.php';
$email = new SendGrid\Email();
$email
    ->addTo($to)
    //->addTo('bar@foo.com') //One of the most notable changes is how `addTo()` behaves. We are now using our Web API parameters instead of the X-SMTPAPI header. What this means is that if you call `addTo()` multiple times for an email, **ONE** email will be sent with each email address visible to everyone.
    ->setFrom($from)
    ->setSubject($subject)
    ->setHtml($msg)
;
$sendgrid->send($email);
?>
