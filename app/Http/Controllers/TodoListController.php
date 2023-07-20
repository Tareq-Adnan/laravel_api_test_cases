<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\Models\TodoList;
use Illuminate\Http\Request;


class TodoListController extends Controller
{
    public function index()
    {

        $list = TodoList::all();

        return response($list);
    }

    public function show(TodoList $todo_list)
    {

        //$list=TodoList::findOrFail($id);

        return response($todo_list);
    }

    public function store(Request $request)
    {

        $request->validate(['name' => 'required']);

        $list = TodoList::create(request()->all());
        // return response($list,Response::HTTP_CREATED);
        return $list;

    }

    public function destroy(TodoList $todo_list)
    {
        
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }


    public function update(Request $request, TodoList $todo_list)
    {

        $request->validate(['name' => 'required']);

        $todo_list->update($request->all());
        return response($todo_list);
    }



}