<?php

namespace App\Services;

use App\Models\auth;

class SendOneSignalNotification
{
    public static function send($title, $content, $userId = null)
    {
        $content = array(
            "en" => $content,
        );
        $headings = array(
            "en" => $title,
        );
        $hashes_array = array();
        // array_push($hashes_array, array(
        //     "id" => "like-button",
        //     "text" => "Like",
        //     "icon" => "http://i.imgur.com/N8SN8ZS.png",
        //     "url" => "https://yoursite.com",
        // ));
        // array_push($hashes_array, array(
        //     "id" => "like-button-2",
        //     "text" => "Like2",
        //     "icon" => "http://i.imgur.com/N8SN8ZS.png",
        //     "url" => "https://yoursite.com",
        // ));
        $fields = array(
            'app_id' => "ff9ceaf5-eb89-4769-b887-cebb20219544",
            'data' => array(
                "foo" => "bar",
            ),
            'contents' => $content,
            'headings' => $headings,
            'web_buttons' => $hashes_array,
        );

        if($userId) {
            $fields['include_player_ids'] = [$userId];
        } else {
            $fields['included_segments'] = ['Subscribed Users'];
        }

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NTYwOWI3YmEtYWNmOS00ZDJmLTkxYTYtZGZkMGNhMGQzOTBh',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
