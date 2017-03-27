<?php

namespace Moonshiner\Cms;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar
{
    /**
     * The router implementation.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new route registrar instance.
     *
     * @param  Router  $router
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes for transient tokens, clients, and personal access tokens.
     *
     * @return void
     */
    public function all()
    {
        $this->forPosts();
    }

    /**
     * Register the routes needed for authorization.
     *
     * @return void
     */
    public function forPosts()
    {
        $this->router->group(['middleware' => ['web']], function ($router) {
            
            // get list of pages
            $router->get('/config', [
                'uses' => 'CmsController@config',
            ]);

            // get list of pages
            $router->get('/pages', [
                'uses' => 'CmsController@index',
            ]);

            // get details of Page
            $router->get('/pages/{post_id}', [
                'uses' => 'CmsController@show',
            ]);

            // create Page
            $router->post('/pages/create', [
                'uses' => 'CmsController@store',
            ]);

            // update Page
            $router->put('/pages/{post_id}', [
                'uses' => 'CmsController@update',
            ]);

            // delete Page
            $router->delete('/pages/{post_id}', [
                'uses' => 'CmsController@destroy',
            ]);

            // delete Page
            $router->post('/image', [
                'uses' => 'CmsController@saveimage',
            ]);
        });
    }
}
