<?php

namespace Moonshiner\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Moonshiner\Cms\Post;

class FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(!$post)
            abort(404);

        $template = $this->templateForId($post->template);

        return view($template, compact('post'));
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
