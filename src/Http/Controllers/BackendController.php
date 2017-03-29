<?php

namespace Moonshiner\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Moonshiner\Cms\Post;

class BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function config()
    {
        return response()->json(config('cms'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(['featured_image', 'id', 'title', 'author', 'published_at', 'category', 'slug']);

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
        return response()->json($post->delete());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Moonshiner\Post $post
     * @return \Illuminate\Http\Response
     */
    public function savefile(Request $request)
    {
        
        $parts = explode(',', $request->file);
        $file = $parts[1];
        $file_type = $parts[0];

        switch($file_type) {
            case 'data:image/jpeg;base64':
                $suffix = '.jpg';
                break;
            case 'data:image/png;base64':
                $suffix = '.png';
                break;
            case 'data:image/svg+xml;base64':
                $suffix = '.svg';
                break;
            case 'data:image/gif;base64':
                $suffix = '.gif';
                break;
            case 'data:application/pdf;base64':
                $suffix = '.pdf';
                break;

            default:
                return response()->json(['msg' => ' Wrong Data Format: '.$parts[0]]);
        }

        $path = public_path()."/uploads/";
        $filepath = md5($request->file).$suffix;
        $fullpath = $path . $filepath;

        $success = file_put_contents($fullpath, base64_decode($file)); 

        if ($success === FALSE) {
          if (!file_exists($path))
            return response()->json(['msg' => "Saving file to folder failed. Folder ".$path." not exists."]);
          
          return response()->json(['msg' => "Saving file to folder failed. Please check write permission on " .$path]);
        }

        return response()->json(['path' => "/uploads/$filepath"]);
    }  
}
