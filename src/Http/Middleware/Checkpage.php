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
        return response(view($template, compact('post')));
    }
      private function templateForId($id) {

        $array = config('cms.templates');
        foreach ($array as $key => $val) {
           if ($val['id'] === $id) {
               return $val['path'];
           }
        }
       return null;
    }

}
