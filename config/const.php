<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Status Order
    |--------------------------------------------------------------------------
    |
    | Show the status of the order
    |
    */

    'order' => [
        'pending' => '0',
        'confirmed' => '1',
        'delivering' => '2',
        'delivered' => '3',
        'cancelled' =>  '4',
        'pages' => '10'
    ],

    'discount' => [
        'active' => '0',
        'expired' => '1',
        'scheduled' => '2'
    ],

    'social' => [
        'facebook' => 'facebook',
        'google' => 'google',
        'github' => 'github',
    ],
    
    'paginate' => [
        'products' => '12'
    ],
];
