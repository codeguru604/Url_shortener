<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class Helper
{
    function getSafeBrowsingURI()
    {
        $client = new Client();
        $apiKey = env('SAFE_BROWSING_API_KEY');
        $clientId = env('SAFE_CLIENT_ID');
        $appURI = env('APP_URI');
        $shorten_url = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz!@#$%^&*()-_=+[]{}|;:,.<>?'), 0, 6);
        do {
            $response = $client->post('https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . $apiKey, [
                'json' => [
                    'client' => [
                        'clientId' => $clientId,
                        'clientVersion' => '1.0.0',
                    ],
                    'threatInfo' => [
                        'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
                        'platformTypes' => ['WINDOWS'],
                        'threatEntryTypes' => ['URL'],
                        'threatEntries' => [
                            ['url' => $appURI . 'visit/' . $shorten_url]
                        ]
                    ]
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if (empty($result['matches'])) {
                break;
            } else {
                $shorten_url = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz!@#$%^&*()-_=+[]{}|;:,.<>?'), 0, 6);
            }
        } while (true);

        return $shorten_url;
    }
}
