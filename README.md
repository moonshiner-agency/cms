# laravel-cms

## Introduction

It is tough to add CMS functionality to an existing Laravel Application. It feels that everytime you have to setup your content types and parameters seperately. This library is in out-of-the-box CMS module, that is easily integrated and logic to handle by Development. The Design is kept close to the Wordpress template (to calm the user), the rest is done properly in one extra table. This projects wants to make things easier.

## Installation

To get started, install Moonshine via the Composer package manager:

`composer config repositories.moonshiner-cms vcs https://github.com/moonshiner-agency/cms`

Next, add the line `"moonshiner/cms": "master@dev"` and run `composer update`. Next register the Laravel CMS service provider in the providers array of your config/app.php configuration file:

`Moonshiner\Cms\CmsServiceProvider::class`

The CMS service provider registers its own database migration directory with the framework, so you should migrate your database after registering the provider. The CMS migrations will create the table your application needs to store Content and Content Meta:

`php artisan migrate`

To publish all files needed for the CMS run `vendor:publish` or 

`php artisan vendor:publish --provider="Moonshiner\Cms\CmsServiceProvider"`

This will copy Vue files to `resources/vendor/moonshine` where all files responsible for handling the CMS ui.

Our package automatically loads routes needed for CMS CRUD operations.

## Backend View Quickstart

In order to use the Cms Vue components, you must be using the Vue JavaScript framework. The Passport ships with a JSON API that you may use to allow your users to CRUD posts. It also shippes with a fully functional Vue backend to setup the functionality very easily.

The published components will be placed in your `resources/vendor/moonshine` directory. Once the components have been published, you should register them in your  resources/assets/js/app.js file:

```
Vue.component(
    'cms-backend',
    require('../../vendor/moonshine/js/CmsBackend.vue')
);
```

After registering the components, make sure to run npm run dev to recompile your assets. Once you have recompiled your assets, you drop the backend component into your application's template and the fully functional CMS Backend gets rendered - for tinymce make sure that tinymce is a valid variable in the window namespace:




```
<div id="app"></div>

<script src="/js/app.js"></script>
```
To safely dispatch requests we also need the csrf-token tag somewhere in the html head section. This tag is also used by the standard laravel bootstrap to enable csrf for axios. You'll find more information here https://laravel.com/docs/csrf#csrf-x-csrf-token


```
<meta name="csrf-token" content="{{ csrf_token() }}">
```

## Frontend View Quickstart

The CMS System allows to select different templates per Detailpage. To enable the Views to be selectable in the backend you need to define them in the config/cms.php configuration File.

```
'templates' => [
        [  
            "id" => "default",
            "name" => "DefaultTemplate",
            "path" => "frontend.app",
            "additional_fields" => [  
                [  
                   "name" => "subheader",
                   "type" => "text"
                ],
                [  
                   "name" => "quotes",
                   "type" => [  
                      [  
                         "name" => "test",
                         "type" => "file"
                      ]
                   ]
                ]
            ]
        ]
    ]
```

The name of an additional field must be unique and the type can be a string or Array. If it is an array, an unlimited number of entries is possible. This can be used for Lists or Galleries.

Those Views will be the Views, that you should change and adapt to your application. In those views you have a `$cms` Variable available to use. This variable will be filled with the content, in the backend.

To get a better understanding for the structure of the $cms Array you can publish Example views for the Frontend rendering. 

## Configuration

(to be done)
