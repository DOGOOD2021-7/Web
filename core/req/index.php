<?php
function isValidJSON($str)
{
    json_decode($str);
    return json_last_error() == JSON_ERROR_NONE;
}

$json_params = file_get_contents("php://input");
if (strlen($json_params) > 0 && isValidJSON($json_params)) {
    $data = json_decode($json_params, true);
} else {
    header("HTTP/1.1 401 Unauthorized");
    die("data error .. ");
}

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$url = 'http://10.0.0.1:8000/';
switch($data["type"]) {
    case "login":
        $response = $client->post($url.'register/login/', [
            'json' => [
                'email' => $data["email"],
                'password' => $data["password"]
            ]
        ]);

        die($response->getBody()->getContents());
        break;
    case "signup":
        $response = $client->post($url.'register/rest-auth/registration/', [
            'json' => [
                'email' => $data["email"],
                'password1' => $data["password"],
                'password2' => $data["password"]
            ]
        ]);
        
        die($response->getBody()->getContents());
        break;
    case "check":
        if ($data["sign_type"] == "dieter") {
            $options = [
                'headers' => [
                    'Authorization' => 'Bearer ' . htmlspecialchars($_COOKIE["dogoodhackaton7"])
                ],
                'json' => [
                    'type' => $data["sign_type"],
                    'address' => $data["address"],
                    'address_detail' => $data["address_detail"],
                    'profile' => $data["profile"],
                ]
            ];
        } else {
            $options = [
                'headers' => [
                    'Authorization' => 'Bearer ' . htmlspecialchars($_COOKIE["dogoodhackaton7"])
                ],
                'json' => [
                    'type' => $data["sign_type"],
                    'address' => $data["address"],
                    'address_detail' => $data["address_detail"],
                    'logo' => '',
                    'website' => '',
                    'profile1' => '',
                    'profile2' => '',
                    'profile3' => '',
                    'gym_name' => $data["gym_name"],
                    'price_desc' => ''
                ]
            ];
        }
        
        $response = $client->post($url.'register/detail/', $options);
        
        die($response->getBody()->getContents());
        break;
    case "gyms":
        $response = $client->get($url.'gyms/', [
            'headers' => [
                'Authorization' => 'Bearer ' . htmlspecialchars($_COOKIE["dogoodhackaton7"])
            ]
        ]);
            
        die($response->getBody()->getContents());
        break;
    case "gym":
        $response = $client->get($url.'gyms/'.$data["id"]);
                
        die($response->getBody()->getContents());
        break;
    case "gymFindIDReservationDate":
        $date = gmdate("Y-m-d", $data["date"]);
        $response = $client->get($url.'gyms/'.$data["id"].'/reservations?date='.$date);
                    
        die($response->getBody()->getContents());
        break;
    case "reservationRequest":
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . htmlspecialchars($_COOKIE["dogoodhackaton7"])
            ],
            'json' => [
                'datetime' => $data["datetime"],
                'client_name' => $data["client_name"],
                'phone_num' => $data["phone_num"]
            ]
        ];

        $response = $client->post($url.'reservations/gyms/'.$data["id"], $options);
                        
        die($response->getBody()->getContents());
        break;
    case "reservationList":
        $response = $client->get($url.'reservations?type='.$_COOKIE["dogoodhackaton7-user_type"], [
            'headers' => [
                'Authorization' => 'Bearer ' . htmlspecialchars($_COOKIE["dogoodhackaton7"])
            ]
        ]);
                        
        die($response->getBody()->getContents());
        break;
    case "reservationConfirm":
        $response = $client->patch($url.'reservations/'.$data["reservation_id"], [
            'headers' => [
                'Authorization' => 'Bearer ' . htmlspecialchars($_COOKIE["dogoodhackaton7"])
            ],
            'json' => [
                'state' => $data["state"],
                'reason' => $data["reason"]
            ]
        ]);
                            
        die($response->getBody()->getContents());
        break;
    case "clientResearch":
        $response = $client->get($url.'clients/', [
            'headers' => [
                'Authorization' => 'Bearer ' . htmlspecialchars($_COOKIE["dogoodhackaton7"])
            ]
        ]);
        
        die($response->getBody()->getContents());
        break;
}