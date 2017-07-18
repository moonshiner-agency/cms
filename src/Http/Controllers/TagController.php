<?php

namespace Moonshiner\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Moonshiner\Cms\Tag;

class TagController
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
        $tags = Tag::all(['name', 'id']);
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $tag_id)
    {
        $output = [];
        $output['tag'] = Tag::findOrFail($tag_id);
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
        if(Tag::where('name','=',$request->name)->count() > 0) {
            $output['msg'] = 'Duplicate url. Please try with another url.';
            $output['tag'] = $request->all();
            // Returning without saving tag
            return response()->json($output);
        } 

        $tag = Tag::create($request->all());
        $output['tag'] = $tag;
        $output['msg'] = 'Erfolgreich gespeichert.';
        
        return response()->json($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @param  Moonshiner\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tag_id)
    {
        $tag = Tag::findOrFail($tag_id);
        if($tag->slug != $request->name) {
            if(Tag::where('name','=',$request->name)->count() > 0) {
                $output['msg'] = 'Duplicate name. Please try with another name.';
                $output['tag'] = $request->all();
                
                // Returning without saving tag
                return response()->json($output);
            }  
        }

        $tag->update($request->all());

        $output['tag'] = $tag;
        $output['msg'] = 'Update erfolgreich';

        return response()->json($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Moonshiner\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag_id)
    {
        $tag = Tag::findOrFail($tag_id);
        return response()->json($tag->delete());
    }


}
