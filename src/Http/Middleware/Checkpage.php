<?php

namespace Moonshiner\Cms\Http\Middleware;

use Closure;
use Moonshiner\Cms\Post;

class Checkpage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!$request->isMethod('get')){
          return $next($request);
        }
        $post = Post::where('slug', $request->segment(1))->first();
        if(!$post){
          return $next($request);
        }

        $template = $this->templateForId($post->template);
return $next($request);
        return response(view($template, compact('post')));
    }

}
