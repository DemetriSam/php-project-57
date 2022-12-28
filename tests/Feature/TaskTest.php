<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $tasksOnPage = 3;
        $tasks = [];
        for ($i = 0; $i < $tasksOnPage; $i++) {
            $tasks[$i] = Task::factory()->create();
        }

        $response = $this->get('/tasks');

        for ($i = 0; $i < $tasksOnPage; $i++) {
            $response->assertSee($tasks[$i]->name);
        }
    }

    public function testShow()
    {
        $task = Task::factory()->create();
        $response = $this->get(implode('/', ['/tasks', $task->id]));
        $response->assertSee($task->name);
    }

    public function testCreate()
    {
        $this->actingAs(User::factory()->make());

        $response = $this->get('/tasks/create');

        $response->assertStatus(200);
        $response->assertSee('tasks');
    }

    public function testEdit()
    {
        $task = Task::factory()->create();
        $this->actingAs(User::factory()->create());
        $url = implode('/', ['/tasks', $task->id, 'edit']);
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertSee('tasks/' . $task->id);
    }

    public function testUpdate()
    {
        $task = Task::factory()->create();

        $this->actingAs(User::factory()->create());

        $updated = [
            'name' => implode(' ', ["Updated Name", rand()]),
            'description' => implode(' ', ["Updated Description", rand()]),
            'status_id' => TaskStatus::factory()->create()->id,
            'assigned_to_id' => User::factory()->create()->id,
        ];

        $url = implode('/', ['/tasks', $task->id]);
        $this->patch($url, $updated);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id ,
            'name' => $updated['name'],
            'description' => $updated['description'],
            'status_id' => $updated['status_id'],
            'assigned_to_id' => $updated['assigned_to_id'],
        ]);
    }

    public function testDestroy()
    {
        $task = Task::factory()->create();
        $creator = User::find($task->created_by_id);
        $this->actingAs($creator);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
        $url = implode('/', ['/tasks', $task->id]);

        $this->delete($url);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testStore()
    {
        $task = Task::factory()->make();

        $this->actingAs(User::factory()->create());

        $hadBeen = Task::count();
        $response = $this->post('/tasks', $task->toArray());
        $became = Task::count();

        $this->assertEquals($hadBeen + 1, $became);
    }

    public function testGuestCanNotStore()
    {
        $task = Task::factory()->make();
        $hadBeen = Task::count();
        $response = $this->post('/tasks', $task->toArray());
        $became = Task::count();

        $this->assertEquals($hadBeen, $became);
    }

    public function testGuestCanNotUpdate()
    {
        $task = Task::factory()->create();

        $oldValue = $task->name;
        $updatedValue = implode(' ', ["Updated Title", rand()]);

        $task->name = $updatedValue;
        $url = implode('/', ['/tasks', $task->id]);
        $this->patch($url, $task->toArray());

        $this->assertDatabaseHas('tasks', ['id' => $task->id , 'name' => $oldValue]);
    }

    public function testGuestCanNotDelete()
    {
        $task = Task::factory()->create();

        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
        $url = implode('/', ['/tasks', $task->id]);

        $this->delete($url);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }

    public function testNotCreatorCanNotDelete()
    {
        $task = Task::factory()->create();
        $notCreator = User::factory()->create();
        $this->actingAs($notCreator);

        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
        $url = implode('/', ['/tasks', $task->id]);

        $this->delete($url);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }
}
