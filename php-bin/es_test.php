<?php

use Elasticsearch\ClientBuilder;

require "vendor/autoload.php";

$hosts = [
  [
    "host" => "ticketlink-5176708725.eu-west-1.bonsaisearch.net",
    "port" => "443",
    "scheme" => "https",
    "user" => "2qk503ze47",
    "pass" => "gheja8axb4"
  ]
];

$client = ClientBuilder::create()
  ->setHosts($hosts) 
  ->build();

/*$params = [
    "index" => "phpindex",
    "type" => "my_type",
    "body" => [
        "query" => [
            "match" => [
                "Description" => "Hello World",
            ]
        ]
    ]
];

$response = $client->search($params);
print_r($response);*/

/*$params = [
    "index" => "tickets",
    "type" => "default",
    "body" => ["TicketID"       => "14615494",
               "TicketName"     => "Jeff Sesh",
               "Venue"          => "Jeff Place",
               "EventType"      => "Partay",
               "Artist"         => "",
               "StartDateTime"  => "2018-02-09 16:30:00",
               "FinishDateTime" => "2018-02-09 17:00:00",
               "Price"          => "20",
               "Location"       => "Manchester",
               "UserID"         => "40323499"]
];

$response = $client->index($params);
print_r($response);*/

$params = [
    "index" => "tickets",
    "type" => "default",
    "body" => [
        "query" => [
            "match" => [
                "TicketName" => "jeff sesh",
            ]
        ]
    ]
];

$response = $client->search($params);
print_r($response);
