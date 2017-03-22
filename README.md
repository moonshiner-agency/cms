# laravel-cms

## Introduction

It is tough to add CMS functionality to an existing Laravel Application. It feels that everytime you have to setup your content types and parameters seperately. This library is in out-of-the-box CMS module, that is easily integrated and logic to handle by Development. The Architecture, Structures and Interface are based on the Wordpress Architecture.

## Installation

To get started, install Passport via the Composer package manager:

`composer require moonshiner/laravel-cms`

Next, register the Laravel CMS service provider in the providers array of your config/app.php configuration file:

`Moonshiner\LaravelCMS\CmsServiceProvider::class`

The CMS service provider registers its own database migration directory with the framework, so you should migrate your database after registering the provider. The CMS migrations will create the tables your application needs to store Categories, Content and Content Meta:

`php artisan migrate`

To publish the config file for the CMS do an vendor:publish

`php artisan vendor:publish --tag=cms-config`

You should call the Cms::routes method within the boot method of your RouteServiceProvider. This method will add the CMS Pieces necessary to render the correct content on one view.

```<?php

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Moonshiner\LaravelCms\Cms;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Cms::routes();
    }
```

## Backend View Quickstart

In order to use the Cms Vue components, you must be using the Vue JavaScript framework. The Passport ships with a JSON API that you may use to allow your users to CRUD categories, contents and content meta. It also shippes with a fully functional Vue backend to setup the functionality very easily.

To publish the Passport Vue components, use the vendor:publish Artisan command:

`php artisan vendor:publish --tag=cms-components`

The published components will be placed in your resources/assets/js/components directory. Once the components have been published, you should register them in your  resources/assets/js/app.js file:

```
Vue.component(
    'cms-backend',
    require('./components/laravel-cms/Application.vue')
);
```

After registering the components, make sure to run npm run dev to recompile your assets. Once you have recompiled your assets, you drop the backend component into your application's template and the fully functional CMS Backend gets rendered:

`<cms-backend></cms-backend>`

## Frontend View Quickstart

The CMS System allows to select different templates per Detailpage. To enable the Views to be selectable in the backend you need to define them in the config/cms.php configuration File.

```
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
```

The *Detailview* is used for rendering a single Content Element, in the additional fields the structure and additional fields for that template is defined. If one of the entries is an array, an unlimited number of entries is possible. This can be used for Lists or Galleries.

Those Views will be the Views, that you should change and adapt to your application. In those views you have a `$cms` Variable available to use. This variable will be filled with the content, in the backend.

To get a better understanding for the structure of the $cms Array you can publish Example views for the Frontend rendering. 

`php artisan vendor:publish --tag=cms-frontend`

This will copy View files to resources/views/cms-frontend/ that are defined in the config file.

## Configuration



