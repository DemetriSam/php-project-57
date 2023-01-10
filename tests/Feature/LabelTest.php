<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\Label;
use App\Models\User;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $labelsOnPage = 3;
        $labels = Label::factory()->count($labelsOnPage)->create();

        $response = $this->get(route('labels.index'));
        $response->assertStatus(200);

        for ($i = 0; $i < $labelsOnPage; $i++) {
            // @phpstan-ignore-next-line
            $response->assertSee($labels[$i]->name);
        }
    }

    public function testShow()
    {
        $this->actingAs(User::factory()->create());
        $label = Label::factory()->create();
        $response = $this->get(route('labels.show', $label));
        $response->assertStatus(200);
        $response->assertSee($label->name);
    }

    public function testCreate()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('labels.create'));

        $response->assertStatus(200);
        $response->assertSee('labels');
    }

    public function testEdit()
    {
        $label = Label::factory()->create();
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('labels.edit', $label));
        $response->assertStatus(200);
        $response->assertSee('labels/' . $label->id);
    }

    public function testUpdate()
    {
        $this->actingAs(User::factory()->create());
        $label = Label::factory()->create();
        $data = $label->only(['name', 'description']);
        $response = $this
            ->patch(route('labels.update', $label), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $label = Label::factory()->create();
        $this->actingAs(User::factory()->create());
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
        $response = $this->delete(route('labels.destroy', $label));
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }

    public function testStore()
    {
        $this->actingAs(User::factory()->create());
        $label = Label::factory()->make();

        $hadBeen = Label::count();
        $response = $this->post(route('labels.store'), $label->toArray());
        $became = Label::count();

        $response->assertRedirect();
        $this->assertEquals($hadBeen + 1, $became);
    }

    public function testGuestCanNotStore()
    {
        $label = Label::factory()->make();
        $hadBeen = Label::count();
        $response = $this->post(route('labels.store'), $label->toArray());
        $became = Label::count();

        $this->assertEquals($hadBeen, $became);
    }

    public function testGuestCanNotUpdate()
    {
        $label = Label::factory()->create();

        $oldValue = $label->name;
        $updatedValue = implode(' ', ["Updated Title", rand()]);

        $label->name = $updatedValue;
        $this->patch(route('labels.update', $label), $label->toArray());

        $this->assertDatabaseHas('labels', ['id' => $label->id , 'name' => $oldValue]);
    }

    public function testGuestCanNotDelete()
    {
        $label = Label::factory()->create();
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
        $this->delete(route('labels.destroy', $label));
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }
}
