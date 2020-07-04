<?php

namespace App\Http\Controllers;

use App\Libraries\Firebase;
use App\Libraries\Push;

class CronjobController extends Controller
{
	/*
	
	{
	   "payload": {
	     "a": "b",
	     "c": "d",
	     "e": "f"
	   },
	   "receiver_user": "receiver_fcm_registeration_id",
	   "sender_user": "sender_fcm_registeration_id",
	   "title":"sample title",
	   "message":"sample message",
	   "push_type":"individual"
	 }

	
	 */
    public function kirimNotifikasi()
    {

        $sender                 = "";
        $receiver               = "";
        $notification_payload   = "";
        $notification_title     = "";
        $notification_message   = "";
        $notification_push_type = "";

        try {

            $receiver_id = '';

            $firebase = new Firebase();
            $push     = new Push();

            // optional payload
            $payload = $notification_payload;

            $title = $notification_title ?? '';

            // notification message
            $message = $notification_message ?? '';

            // push type - single user / topic
            $push_type = $notification_push_type ?? '';

            $push->setTitle($title);
            $push->setMessage($message);
            $push->setPayload($payload);

            $json     = '';
            $response = '';

            if ($push_type === 'topic') {
                $json     = $push->getPush();
                $response = $firebase->sendToTopic('global', $json);
            } else if ($push_type === 'individual') {
                $json     = $push->getPush();
                $regId    = $receiver_id ?? '';
                $response = $firebase->send($regId, $json);

                return response()->json([
                    'response' => $response,
                ]);
            }

        } catch (\Exception $ex) {
            return response()->json([
                'error'   => true,
                'message' => $ex->getMessage(),
            ]);
        }

    }
}
