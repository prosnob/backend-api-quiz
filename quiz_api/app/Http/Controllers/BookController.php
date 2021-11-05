<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::orderBy('id','desc')->get();
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
            "title"=>"string|min:3|max:10",
            "body"=>"string|min:3|max:50"
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->body = $request->body;
        $book->author_id = $request->author_id;
        $book->save();
        return response()->json(["message"=>"Book created"],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::findOrFail($id);
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
            "title"=>"string|min:3|max:10",
            "body"=>"string|min:3|max:50"
        ]);
        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->body = $request->body;
        $book->author_id = $request->author_id;
        $book->save();
        return response()->json(["message"=>"Book updated"],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Book::destroy($id);
        if($isDeleted){
            return response()->json(["message"=>"Book deleted"],200);
        }
        else{
            return response()->json(["message"=>"Not found"],404);
            
        }
    }
}
