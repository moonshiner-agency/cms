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

    'categories' => [
      'blog',
      'page'
    ],
    'templates' => [
        [ 
            "id" => "default",
            "name" => "Standardtemplate",
            "path" => "frontend.app",
            "additional_fields" => [  
                [  
                   "name" => "subheader",
                   "type" => "string"
                ],
                [  
                   "name" => "count",
                   "type" => "number"
                ],
                [  
                   "name" => "bild",
                   "type" => "file"
                ],
                [  
                   "name" => "gallery",
                   "type" => [  
                      [  
                         "name" => "image",
                         "type" => "file"
                      ],
                      [  
                         "name" => "description",
                         "type" => "string"
                      ],
                      [  
                         "name" => "content",
                         "type" => "string"
                      ]
                   ]
                ]
            ]
        ],
        [  
            "id" => "special",
            "name" => "SpecialTemplate",
            "path" => "frontend.app",
            "additional_fields" => [  
            [  
               "name" => "quotes",
               "type" => [  
                  [  
                     "name" => "test",
                     "type" => "string"
                  ]
               ]
            ],
            [  
               "name" => "subheader",
               "type" => "string"
            ]
            ]
        ]
    ]
];
