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
    'statics' => [
       [  
         "name" => "meta-title",
         "type" => "string"
      ],[  
         "name" => "meta-description",
         "type" => "string"
      ],
    ], 
    'templates' => [
        [ 
            "id" => "default",
            "name" => "Starter",
            "path" => "starter"
            ,
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
                   "name" => "picture",
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
            "path" => "special",
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
