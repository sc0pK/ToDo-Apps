<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function index()
    {
        return view("create");
    }
    public function create()
    {
        return view("create");
    }
    public function add(Request $req)
    {
        $create = Todo::create([
            "title" => $req->input("title"),
            "content" => $req->input("content"),
            "priority" => $req->input("priority"),
            "created_at" => Carbon::now(),
        ]);
        $create->save();
        return redirect("/");
    }
    public function get()
    {
        $todos = Todo::all();
        return view("view", compact("todos"));
    }
    //
}
