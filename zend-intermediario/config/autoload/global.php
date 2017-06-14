<?php

return [
    'mail' => [
        'name' => 'smtp.googlemail.com',
        'host' => 'smtp.googlemail.com',
        'connection_class' => 'login',
        'connection_config' => [
            'username' => '',
            'password' => '',
            'ssl' => 'tls',
            'port' => 465,
            'from' => ''
        ]
    ]
];
