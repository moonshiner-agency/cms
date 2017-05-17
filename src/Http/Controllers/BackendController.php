<?php

namespace Moonshiner\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Moonshiner\Cms\Post;
use Moonshiner\Cms\Parser\ConfigParser; 
use File; 
class BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function config()
    {
        $config = (new ConfigParser(config('cms')))->build(); 

        return $config;
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

    
    public function show(Request $request, Post $post)
    {
        $output = [];

        $output['post'] = $post; 
        return $output;
    }

    
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
    public function update(Request $request, Post $post)
    {
        $post = $post;
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
    public function destroy(Post $post)
    {
        $output['msg'] = 'Erfolgreich gelöscht'; 
        $post->delete(); 

        return response()->json($post);
    }

   
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
        if(!file_exists($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $success = file_put_contents($fullpath, base64_decode($file)); 
        if ($success === FALSE) {
          if (!file_exists($path))
            return response()->json(['msg' => "Saving file to folder failed. Folder ".$path." not exists."]);
          
          return response()->json(['msg' => "Saving file to folder failed. Please check write permission on " .$path]);
        }
        return response()->json(['path' => "/uploads/$filepath"]);
    }  
}
