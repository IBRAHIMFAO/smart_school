<?php

namespace App\Http\Controllers;
use Vonage\Client\Credentials\Basic;




class SMSController extends Controller
{

    public function sendsms()
    {

        $basic  = new Basic("5fb0aaf0", "ujnDxTWw6e2iPyaO");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("
            +212605344117", 'rfid', 'A text message sent using the Nexmo SMS API')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

// $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

// $apiInstance = new TransactionalSMSApi(
//     new Client(),
//     $config
// );
// $sendTransacSms = new SendTransacSms();
// $sendTransacSms['sender'] = 'senderName';
// $sendTransacSms['recipient'] = '+212622136241';
// $sendTransacSms['content'] = 'This is a transactional SMS';
// $sendTransacSms['type'] = 'transactional';
// $sendTransacSms['webUrl'] = 'https://example.com/notifyUrl';

// try {
//     $result = $apiInstance->sendTransacSms($sendTransacSms);
//     print_r($result);
// } catch (Exception $e) {
//     echo 'Exception when calling TransactionalSMSApi->sendTransacSms: ', $e->getMessage(), PHP_EOL;
// }
    }
}
// Dear Sendinblue Support Team,

// I hope this message finds you well. I am writing to request activation of transactional SMS for my account. As I understand it, this service will enable me to send personalized, real-time text messages to my customers, improving their overall experience with my business.

// I would be grateful if you could activate this feature for my account as soon as possible. Please let me know if there are any additional steps I need to take to make this happen.

// Thank you for your time and attention.

// Best regards,
