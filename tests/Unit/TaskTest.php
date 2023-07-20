<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TodoList;   
use  App\Models\Task;
use Illuminate\Support\Collection;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_task_belongs_to_a_todo_list(): void
    {
        $list = TodoList::factory()->create();
        $task = Task::factory()->create(['todo_list_id' => $list->id]);
    
        //$this->assertInstanceOf(Collection::class, $list->tasks);
        $this->assertInstanceOf(TodoList::class, $task->todoList);
    }
}
