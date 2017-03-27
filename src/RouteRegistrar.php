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
            $router->get('moonshiner/config', [
                'uses' => 'BackendController@config',
            ]);

            // get list of pages
            $router->get('moonshiner/pages', [
                'uses' => 'BackendController@index',
            ]);

            // get details of Page
            $router->get('moonshiner/pages/{post_id}', [
                'uses' => 'BackendController@show',
            ]);

            // create Page
            $router->post('moonshiner/pages/create', [
                'uses' => 'BackendController@store',
            ]);

            // update Page
            $router->put('moonshiner/pages/{post_id}', [
                'uses' => 'BackendController@update',
            ]);

            // delete Page
            $router->delete('moonshiner/pages/{post_id}', [
                'uses' => 'BackendController@destroy',
            ]);

            // delete Page
            $router->post('moonshiner/image', [
                'uses' => 'BackendController@saveimage',
            ]);

            // delete Page
            $router->get('/{slug}', [
                'uses' => 'FrontendController@index',
            ]);
        });
    }
}
