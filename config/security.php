<?php
return [
    'csrf_lifetime' => 7200,
    'rate_limit' => [
        'max_requests' => 100,
        'window' => 60,
    ],
    'password_algorithm' => PASSWORD_BCRYPT,
];