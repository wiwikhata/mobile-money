<?php
return [
    'c2b' => [
        'consumer_key' => 'Ei4lr5xbDZXS9XEAZ1BhNE4xCBcAYGVy',
        'consumer_secret' => 'eMhCDmzFQyx1SNSZ',
        'initiator' => 'testapi',
        'stk_callback' => env('APP_URL') . '/payments/callbacks/stk_callback',
        'id_validation_callback' => env('APP_URL') . '/payments/callbacks/validate',
        'callback_method' => 'POST',
        'short_code' => 600505,
        'passkey' => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',
        'security_credential' => 'N0hEq5ecGOdDY7sLZjZSA+fNHbjOBJ59DAg5ViO8ZdICWeD0DqHVPnhgJc4kivBzxpATmk1uBeEvhkxldqEa4IVyhWkxjjqetBtkcvWR1d0ebx8TvvUAzlYuUGV0U55fvp28P7CIQOU2kin/p/SYLbHdxO4/BEouAYOTmdafK0sWrD3Q49LvHDAeUt6gO8A7NBFuVPxWybUb+WNRnwrGeuUO4XS4UkT8FE5JZGopTlOKwIa4yQnJLXLqTG9Je0ZWr0fB9X0QwVqbbQ7v2beOtyyhcOt9biU5/jaT1DDXsfc289dzpJv/taH+Vndpi5mRL4aBs+hGJ0MZcSyi42Qv0A==',
        'timeout_url' => env('APP_URL') . '/payments/callbacks/timeout',
        'result_url' => env('APP_URL') . '/payments/callbacks/result',
        'validation_url' => env('APP_URL') . '/payments/callbacks/validate',
        'confirmation_url' => env('APP_URL') . '/payments/callbacks/confirmation',
    ],
    'bulk' => [
        'consumer_key' => 'Ei4lr5xbDZXS9XEAZ1BhNE4xCBcAYGVyA',
        'consumer_secret' => 'eMhCDmzFQyx1SNSZ',
        'short_code' => 600000,
        'security_credential' => 'CLjvL+47Ocb0LTgY956szMiU6ls8whIQJXprduNtH6SBZp29/bz4d61gSA07IixluRhlTTRlQDl8Ihr8OL3+qhAj/lLPN7FLO8Ud+F5oxL4mI6hdDuhzcde+7ZFNkR5cGhRhnUfyVTdKpYblp2QX6UbLkdS5SJ45H0pYNkaMlXP3s6LUJSMydHNV6XzXhQCad3l2IoupyZr9lRkFplm4bkLdDSXRPq06XzZrgBAkpzlyccyz4KMbJKQnOokNl6C3E0LfOq1ZpjsGQgOhutAf3BFDYpSgoUpdeynv5vqTVuP7oBzg9PsR2fx+v58ZhtGrlZtw9NAWEs9VlFeGUBY1gA==',
        'initiator' => 'testapi',
        'timeout_url' => env('APP_URL') . '/payments/callbacks/timeout',
        'result_url' => env('APP_URL') . '/payments/callbacks/result',
    ],
    'notifications' => [
        'slack_web_hook' => '',
        'only_important' => true,
    ],
];
