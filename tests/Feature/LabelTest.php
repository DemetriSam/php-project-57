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
        for($i = 0; $i < $labelsOnPage; $i++) {
            $labels[$i] = Label::factory()->create();       
        }

        $response = $this->get('/labels');

        for($i = 0; $i < $labelsOnPage; $i++) {
            $response->assertSee($labels[$i]->name);
        }
    }

    public function testShow()
    {
        $label = Label::factory()->create();
        $response = $this->get(implode('/', ['/labels', $label->id]));
        $response->assertSee($label->name);

    }

    public function testCreate()
    {
        $this->actingAs(User::factory()->make());

        $response = $this->get('/labels/create');

        $response->assertStatus(200);
        $response->assertSee('labels');
    }

    public function testEdit()
    {
        $label = Label::factory()->create();
        $this->actingAs(User::factory()->create());
        $url = implode('/', ['/labels', $label->id, 'edit']);
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertSee('labels/' . $label->id);
    }

    public function testUpdate()
    {
        $label = Label::factory()->create();

        $this->actingAs(User::factory()->create());
        
        $updated = [
            'name' => implode(' ', ["Updated Name", rand()]),
            'description' => implode(' ', ["Updated Description", rand()]),
        ];
        
        $url = implode('/', ['/labels', $label->id]);
        $this->patch($url, $updated);
        
        $this->assertDatabaseHas('labels', [
            'id'=> $label->id ,
            'name' => $updated['name'],
            'description' => $updated['description'],
        ]);
    }

    public function testDestroy()
    {
        $label = Label::factory()->create();
        $this->actingAs(User::factory()->create());
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
        $url = implode('/', ['/labels', $label->id]);

        $this->delete($url);
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }

    public function testStore()
    {        
        $label = Label::factory()->make();

        $this->actingAs(User::factory()->create());
        
        $hadBeen = Label::all()->count();
        $response = $this->post('/labels', $label->toArray());
        $became = Label::all()->count();

        $this->assertEquals($hadBeen + 1, $became);
    }

    public function test_guest_can_not_store()
    {
        $label = Label::factory()->make();
        $hadBeen = Label::all()->count();
        $response = $this->post('/labels', $label->toArray());
        $became = Label::all()->count();

        $this->assertEquals($hadBeen, $became);
    }

    public function test_guest_can_not_update()
    {
        $label = Label::factory()->create();
        
        $oldValue = $label->name;
        $updatedValue = implode(' ', ["Updated Title", rand()]);
        
        $label->name = $updatedValue;
        $url = implode('/', ['/labels', $label->id]);
        $this->patch($url, $label->toArray());
        
        $this->assertDatabaseHas('labels', ['id'=> $label->id , 'name' => $oldValue]);
    }

    public function test_guest_can_not_delete()
    {
        $label = Label::factory()->create();

        $this->assertDatabaseHas('labels', ['id' => $label->id]);
        $url = implode('/', ['/labels', $label->id]);

        $this->delete($url);
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }
}
