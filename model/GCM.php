<?php
function fnSendAndroid($tokens, $text)
{
	require_once("CodeMonkeysRu/GCM/Sender.php");
	require_once("CodeMonkeysRu/GCM/Message.php");
	require_once("CodeMonkeysRu/GCM/Exception.php");
	require_once("CodeMonkeysRu/GCM/Response.php");
    $sender = new CodeMonkeysRu\GCM\Sender("AIzaSyBuWqIGh-XgnmReiygn5Os1TlObtvUtNS0");
    $message = new CodeMonkeysRu\GCM\Message($tokens, array("message" => $text));

    try {
        $response = $sender->send($message);

        if ($response->getFailureCount() > 0) {
            $invalidRegistrationIds = $response->getInvalidRegistrationIds();
            foreach($invalidRegistrationIds as $invalidRegistrationId) {
                //Remove $invalidRegistrationId from DB
                // на входе значение APS91bFY-2CYrriS-Dt6y9_dGHhkPVwy7njqFpfgpzGYlDT4l0SQeqKr-lc1OM0a2DQ33S3EKwy2YJn-upKxOT6rNwgk350xUM3g8VX65rkGocOQX80Ta34pwXo6fyn-usoaGUAm4lzsqbCL-gkzHZZXRX39kUQfnA 
				$model=new dbModel();
                 $model->fnDeleteToken($invalidRegistrationId);
            }
        }
        if ($response->getSuccessCount()) {
            echo 'The messages were sent to ' . $response->getSuccessCount() . ' device(s)';
        }
    } catch (CodeMonkeysRu\GCM\Exception $e) {

        switch ($e->getCode()) {
            case CodeMonkeysRu\GCM\Exception::ILLEGAL_API_KEY:
            case CodeMonkeysRu\GCM\Exception::AUTHENTICATION_ERROR:
            case CodeMonkeysRu\GCM\Exception::MALFORMED_REQUEST:
            case CodeMonkeysRu\GCM\Exception::UNKNOWN_ERROR:
            case CodeMonkeysRu\GCM\Exception::MALFORMED_RESPONSE:
                print_r('Error while sending to Android client ' . $e->getCode() . ' ' . $e->getMessage());
                break;
        }
    }
}