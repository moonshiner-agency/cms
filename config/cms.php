<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    | Here you can set the Templates available in the CMS
    | and the additional Fields, that should be available in the Template
    |
    | Additional Field Type: text, string, integer, decimal, date, image, file
    */

    'templates' => [
        'default' => [
            'name' => 'Standardtemplate',
            'path' => 'frontend.app',
            'additional_fields' => [
                'subheader' => 'string',
                'count' => 'number',
                'email' => 'email',
                'gallery' => [
                    'image' => 'image'
                ]
            ]
        ]
    ],
];
