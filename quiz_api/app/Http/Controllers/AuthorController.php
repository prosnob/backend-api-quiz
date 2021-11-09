<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Resources\AuthorResource;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AuthorResource::collection(Author::with(["books"])->take(3)->get());
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
            "name"=>"min:3|max:30",
            "age"=>"integer|min:1|max:30",
            "provice"=>"nullable"
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->age = $request->age;
        $author->provice = $request->provice;
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
        return new AuthorResource(Author::findOrFail($id));
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
            "name"=>"min:3|max:10",
            "age"=>"integer|min:1|max:10",
            "provice"=>"nullable"
        ]);
        $author = Author::findOrFail($id);
        $author->name = $request->name;
        $author->age = $request->age;
        $author->provice = $request->provice;
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
