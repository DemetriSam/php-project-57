<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $statusesOnPage = 3;
        for($i = 0; $i < $statusesOnPage; $i++) {
            $taskStatuses[$i] = TaskStatus::factory()->create();       
        }

        $response = $this->get('/task_statuses');

        for($i = 0; $i < $statusesOnPage; $i++) {
            $response->assertSee($taskStatuses[$i]->name);
        }
    }

    public function testShow()
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->get(implode('/', ['/task_statuses', $taskStatus->id]));
        $response->assertSee($taskStatus->name);

    }

    public function testCreate()
    {
        $taskStatus = TaskStatus::factory()->make();
        $this->actingAs(User::factory()->make());

        $response = $this->get('/task_statuses/create');

        $response->assertStatus(200);
        $response->assertSee('task_statuses');
    }

    public function testEdit()
    {
        $taskStatus = TaskStatus::factory()->create();
        $url = implode('/', ['/task_statuses', $taskStatus->id, 'edit']);
        $response = $this->get($url);
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $taskStatus = TaskStatus::factory()->create();

        $this->actingAs(User::factory()->make());
        $updatedValue = implode(' ', ["Updated Title", rand()]);
        $taskStatus->name = $updatedValue;
        $url = implode('/', ['/task_statuses', $taskStatus->id]);
        $this->patch($url, $taskStatus->toArray());
        $this->assertDatabaseHas('task_statuses', ['id'=> $taskStatus->id , 'name' => $updatedValue]);
    }

    public function testDestroy()
    {
        $taskStatus = TaskStatus::factory()->create();

        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
        $this->actingAs(User::factory()->make());
        $url = implode('/', ['/task_statuses', $taskStatus->id]);

        $this->delete($url);
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }

    public function testStore()
    {        
        $taskStatus = TaskStatus::factory()->make();

        $this->actingAs(User::factory()->make());
        
        $hadBeen = TaskStatus::all()->count();
        $response = $this->post('/task_statuses', $taskStatus->toArray());
        $became = TaskStatus::all()->count();

        $this->assertEquals($hadBeen + 1, $became);
    }
}
