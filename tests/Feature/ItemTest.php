<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_fetch_all_tasks(): void
    {
        //preparation 
        $task=Task::factory()->create();

        //action
        $response=$this->getJson(route('task.index'))->assertOk()->json();

        //assertion

        $this->assertEquals($task->title,$response[0]['title']);
    }
}
