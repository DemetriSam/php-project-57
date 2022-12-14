<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusTest extends TestCase
{
    /** @test */
    public function testIndex()
    {
        for($i = 0; $i < 10; $i++) {
            $taskStatuses[$i] = TaskStatus::factory()->make();       
        }

        $response = $this->get('/task_statuses');

        for($i = 0; $i < 10; $i++) {
            $response->assertSee($taskStatuses[$i]->name);
        }
    }

    public function testShow()
    {
        $taskStatus = TaskStatus::factory()->make();
        $response = $this->get(implode('/', ['/task_statuses', $taskStatus->id]));
        $response->assertSee($taskStatus->name);

    }

    public function testStore()
    {        
        $taskStatus = TaskStatus::factory()->make();

        $this->actingAs(User::factory()->make());
        
        $hadBeen = TaskStatus::all()->count();
        $response = $this->post('/task_statuses/create', [
            'name' => $taskStatus->name,
        ]);
        $became = TaskStatus::all()->count();

        $this->assertEquals($hadBeen + 1, $became);
    }

    public function testCreate()
    {
        $response = $this->get('/task_statuses/create');

        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $taskStatus = TaskStatus::factory()->make();
        $url = implode('/', ['/taskStatuses', $taskStatus->id, 'edit']);
        $response = $this->get($url);
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $taskStatus = TaskStatus::factory()->make();

        $this->actingAs(User::factory()->make());
        $updatedValue = implode(' ', ["Updated Title", rand()]);
        $taskStatus->name = $updatedValue;

        $this->put(implode('/', ['/taskStatuses', $taskStatus->id, 'edit']), $taskStatus->toArray());

        $this->assertDatabaseHas('task_statuses', ['id'=> $taskStatus->id , 'name' => $updatedValue]);
    }

    public function testDestroy()
    {
        $taskStatus = TaskStatus::factory()->make();
        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
        $this->actingAs(User::factory()->make());
        $url = implode('/', ['/task_statuses', $taskStatus->id]);

        $this->delete($url);
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }

}
