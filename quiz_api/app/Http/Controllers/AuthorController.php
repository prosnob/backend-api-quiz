<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"string|min:3|max:30",
            "age"=>"integer|min:1|max:30",
            "province"=>"nullable"
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->age = $request->age;
        $author->provice = $request->province;
        $author->save();

        return response()->json(["message"=>"Author created"],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Author::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>"string|min:3|max:30",
            "age"=>"integer|min:1|max:30",
            "province"=>"nullable"
        ]);
        $author = Author::findOrFail($id);
        $author->name = $request->name;
        $author->age = $request->age;
        $author->provice = $request->province;
        $author->save();

        return response()->json(["message"=>"Author updated"],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Author::destroy($id);
        if($isDeleted){
            return response()->json(["message"=>"Author deleted"],200);
        }
        else{
            return response()->json(["message"=>"Not found"],404);
        }
    }
}
