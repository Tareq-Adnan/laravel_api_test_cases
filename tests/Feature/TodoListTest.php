<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TodoList;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->list = TodoList::factory()->create(['name' => 'my list']);
    }
    public function test_fetch_all(): void
    {


        //preparation /prepare
        //TodoList::factory()->create(['name'=> 'my list']);


        //action /performe
        $response = $this->getJson(route('todo-list.index'));

        //assertion /predict
        $this->assertEquals(1, count($response->json()));
        $this->assertEquals('my list', $response->json()[0]['name']);
    }

    public function test_fetch_single(): void
    {

        //preparation
        // $list=TodoList::factory()->create();
        //action
        $res = $this->getJson(route('todo-list.show', $this->list->id))->assertOk()
            ->json();

        //assertion

        $this->assertEquals($res['name'], $this->list->name);
        

    }


    public function test_store_new_todo_list(): void
    {

        //preparation
        $list = TodoList::factory()->make();
        //action
        $res = $this->postJson(route('todo-list.store'), ['name' => $list->name])
            ->assertCreated()->json();


        //assertion

        $this->assertEquals($list->name, $res['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);


    }

    public function test_while_storing_todo_list_name_is_required(): void
    {
        $this->withExceptionHandling();

        $res = $this->postJson(route('todo-list.store'))->assertUnprocessable()
            ->assertJsonValidationErrors('name');

    }

    public function test_delete_todo_list(): void
    {


        $this->deleteJson(route('todo-list.destroy', $this->list->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('todo_lists', ['name' => $this->list->name]);

    }


    public function test_update_todo_list(): void
    {

        $this->patchJson(route('todo-list.update', $this->list->id), ['name' => 'updated name'])->assertOk();

        $this->assertDatabaseHas('todo_lists', ['id' => $this->list->id, 'name' => 'updated name']);
    }


   public function test_while_updating_todo_list_name_is_required(): void
    {
        $this->withExceptionHandling();

        $res = $this->patchjson(route('todo-list.update',$this->list->id))->assertUnprocessable()
            ->assertJsonValidationErrors(['name']);

    }

}