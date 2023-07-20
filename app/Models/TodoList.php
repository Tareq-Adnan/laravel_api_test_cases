<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

   protected $fillable=['name'];

   public static function boot(){
    parent::boot();
    // self::deleting(function($todo_list){
    //     $todo_list->tasks()->delete();
    // });
   }

   public function tasks(){
    return $this->hasMany(Task::class);
   }

}
