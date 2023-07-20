<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TodoList;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_fetch_all_tasks(): void
    {
        //preparation 
        $list = TodoList::factory()->create();
        $list2 = TodoList::factory()->create();
        $task = Task::factory()->create(['todo_list_id' => $list->id]);
        Task::factory()->create(['todo_list_id' =>$list2->id]);

        //action
        $response = $this->getJson(route('todo-list.task.index', $list->id))->assertOk()->json();

        //assertion

        $this->assertEquals(1, count($response));
        $this->assertEquals($task->title, $response[0]['title']);
    }


    public function test_store_a_task()
    {

        $list = TodoList::factory()->create();
        $task = Task::factory()->make();

        $this->postJson(route('todo-list.task.store', $list->id), ['title' => $task->title])->assertCreated();


        $this->assertDatabaseHas('tasks', ['title' => $task->title,'todo_list_id' => $list->id]);
    }


    public function test_delete_a_task_from_database()
    {

        $task = Task::factory()->create();

        $this->deleteJson(route('task.destroy', $task->id))->assertNoContent();


        $this->assertDatabaseMissing('tasks', ['title' => $task->title]);

    }

    public function test_update_a_task()
    {

        $task = Task::factory()->create();

        $this->patchJson(route('task.update', $task->id), ['title' => 'new title'])->assertOk();


        $this->assertDatabaseHas('tasks', ['title' => 'new title']);
    }
}