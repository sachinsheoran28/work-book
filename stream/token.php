<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// ADD TWILIO REQURIED LIBRARIES
require_once('twilio/Services/Twilio.php');

// TWILIO CREDENTIALS
$TWILIO_ACCOUNT_SID = 'ACdcf1d62c63904b55bffbaeae99a4f31e';
$TWILIO_CONFIGURATION_SID = 'VSbf4d1e64f0406a61ada26208246240fd';
$TWILIO_API_KEY = 'SK001b3d48be315dc98fadd66950cb95b5';
$TWILIO_API_SECRET = 'zcg8bQhBAdmaaLZ0Hq1pj0usCO4Eu6Uf';

// CREATE TWILIO TOKEN
// $id will be the user name used to join the chat
$id = $_GET['id'];

$token = new Services_Twilio_AccessToken(
    $TWILIO_ACCOUNT_SID,
    $TWILIO_API_KEY,
    $TWILIO_API_SECRET,
    3600,
    $id
);

// GRANT ACCESS TO CONVERSTATION
$grant = new Services_Twilio_Auth_ConversationsGrant();
$grant->setConfigurationProfileSid($TWILIO_CONFIGURATION_SID);
$token->addGrant($grant);

// JSON ENCODE RESPONSE
echo json_encode(array(
    'id'    => $id,
    'token' => $token->toJWT(),
));
