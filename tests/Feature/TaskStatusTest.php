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
        $taskStatuses = TaskStatus::factory()->count($statusesOnPage)->create();

        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);

        for ($i = 0; $i < $statusesOnPage; $i++) {
            // @phpstan-ignore-next-line
            $response->assertSee($taskStatuses[$i]->name);
        }
    }

    public function testShow()
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses.show', $taskStatus));
        $response->assertStatus(200);
        $response->assertSee($taskStatus->name);
    }

    public function testCreate()
    {
        $this->actingAs(User::factory()->create());
        $taskStatus = TaskStatus::factory()->make();

        $response = $this->get(route('task_statuses.create'));

        $response->assertStatus(200);
        $response->assertSee('task_statuses');
    }

    public function testEdit()
    {
        $taskStatus = TaskStatus::factory()->create();
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('task_statuses.edit', $taskStatus));
        $response->assertStatus(200);
        $response->assertSee('task_statuses/' . $taskStatus->id);
    }

    public function testUpdate()
    {
        $this->actingAs(User::factory()->create());
        $taskStatus = TaskStatus::factory()->create();
        $data = $taskStatus->only(['name']);
        $response = $this
            ->patch(route('task_statuses.update', $taskStatus), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $this->actingAs(User::factory()->create());
        $taskStatus = TaskStatus::factory()->create();
        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
        $response = $this->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }

    public function testStore()
    {
        $taskStatus = TaskStatus::factory()->make();

        $this->actingAs(User::factory()->create());

        $hadBeen = TaskStatus::count();
        $response = $this->post(route('task_statuses.store'), $taskStatus->toArray());
        $became = TaskStatus::count();

        $response->assertRedirect();
        $this->assertEquals($hadBeen + 1, $became);
    }

    public function testGuestCanNotStore()
    {
        $taskStatus = TaskStatus::factory()->make();
        $hadBeen = TaskStatus::count();
        $response = $this->post(route('task_statuses.store'), $taskStatus->toArray());
        $became = TaskStatus::count();

        $this->assertEquals($hadBeen, $became);
    }

    public function testGuestCanNotUpdate()
    {
        $taskStatus = TaskStatus::factory()->create();

        $oldValue = $taskStatus->name;
        $updatedValue = implode(' ', ["Updated Title", rand()]);
        $taskStatus->name = $updatedValue;
        $this->patch(route('task_statuses.update', $taskStatus), $taskStatus->toArray());

        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id , 'name' => $oldValue]);
    }

    public function testGuestCanNotDelete()
    {
        $taskStatus = TaskStatus::factory()->create();

        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
        $this->delete(route('task_statuses.destroy', $taskStatus));
        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
    }
}
