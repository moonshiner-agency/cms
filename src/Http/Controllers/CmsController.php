<?php

namespace Moonshiner\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Moonshiner\Cms\Post;

class CmsController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = [];

        $output['posts'] = Post::all();
        $output['templates'] = config('cms.templates');

        return response()->json($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);

        return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Post::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @param  Moonshiner\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);
        return $post->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Moonshiner\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);
        return $post->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Moonshiner\Post $post
     * @return \Illuminate\Http\Response
     */
    public function helper()
    {
        for($i=0; $i < 5; $i++) {
            $post = new Post;
            $post->author = "Flo";
            $post->title = "New".$i;
            $post->main_content = null;
            $post->content = null;
            $post->slug = "yo-yo-yo-".$i;
            $post->template = "test";
            $post->save();
        }
        //$post = Post::findOrFail($post_id);
        //return $post->delete();
    }
}
