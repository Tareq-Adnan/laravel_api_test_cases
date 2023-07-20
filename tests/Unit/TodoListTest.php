<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Support\Collection;

class TodoListTest extends TestCase
{
  /**
   * A basic unit test example.
   */
  use RefreshDatabase;
  public function test_a_todo_list_can_has_many_tasks()
  {
    $list = TodoList::factory()->create();
    $task = Task::factory()->create(['todo_list_id' => $list->id]);

    $this->assertInstanceOf(Collection::class, $list->tasks);
    $this->assertInstanceOf(Task::class, $list->tasks->first());


  }

  public function test_if_list_deleted_then_tasks_are_deleted(){
    $list=TodoList::factory()->create();
    $list2=TodoList::factory()->create();
    $task=Task::factory()->create(['todo_list_id'=>$list->id]);
    $task2=Task::factory()->create();

    //action
    $list->delete();

    $this->assertDatabaseMissing('todo_lists', ['id'=>$list->id]);
    $this->assertDatabaseMissing('tasks', ['id'=>$task->id]);
    $this->assertDatabaseHas('tasks',['id'=>$task2->id]);
  }
}