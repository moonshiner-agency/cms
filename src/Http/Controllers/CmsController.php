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
    public function templates()
    {
        return response()->json(config('cms.templates'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(['id', 'featured_image', 'title', 'author', 'published_at']);

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $post_id)
    {
        $output = [];
        $output['post'] = Post::findOrFail($post_id);
        return response()->json($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());

        $output['post'] = $post;
        $output['msg'] = 'Erfolgreich gespeichert.';

        return response()->json($output);
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
        $post->update($request->all());

        $output['post'] = $post;
        $output['msg'] = 'Update erfolgreich';

        return response()->json($output);
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
}
