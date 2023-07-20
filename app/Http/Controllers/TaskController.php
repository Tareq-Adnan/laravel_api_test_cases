<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
   public function index(TodoList $todo_list){


    //$list=Task::where(['todo_list_id'=>$todo_list->id])->get();
   return $todo_list->tasks;
   // return response($list);
   }

   public function store(Request $request,TodoList $todo_list){
   
   //  $request['todo_list_id']=$todo_list->id;
   //  $task=Task::create($request->all());
   return $todo_list->tasks()->create($request->all());


   }

   public function destroy(Task $task){

    $task->delete();

    return response('',Response::HTTP_NO_CONTENT);

   }

   public function update(Request $request,Task $task){

    $task->update($request->all());

    return response($task);

   }
}
