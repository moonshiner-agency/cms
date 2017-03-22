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
        $this->router->group(['middleware' => ['web', 'auth']], function ($router) {
            
            // get list of pages
            $router->get('/cms-pages', [
                'uses' => 'CmsController@index',
            ]);

            // get details of Page
            $router->get('/cms-pages/{post}', [
                'uses' => 'CmsController@show',
            ]);

            // create Page
            $router->post('/cms-pages/{post}/create', [
                'uses' => 'CmsController@create',
            ]);

            // update Page
            $router->post('/cms-pages/{post}/edit', [
                'uses' => 'CmsController@update',
            ]);

            // delete Page
            $router->delete('/cms-pages/{post}', [
                'uses' => 'CmsController@destroy',
            ]);
        });
    }
}
