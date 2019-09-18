<?php

namespace Tests\Unit;


use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A test for save Task.
     *
     * @return Json
     */
    public function testStoreTask()
    {
        $project = factory(Project::class)->create();
     
        $response = $this->post('/api/tasks', ['title' => 'test', 'project_id' =>  $project->id]);
        
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'title' => 'test',
                    'project_id' =>  $project->id,
                ]
            );
    }


    /**
     * testStoreTaskValidation
     *
     * @return void
     */
    public function testStoreTaskValidation()
    {
        $response = $this->json('POST', '/api/tasks', ['title' => 'test', 'project_id' => 0]);
        $response->assertStatus(422);

        $response = $this->json('POST', '/api/tasks', ['project_id' => 0]);
        $response->assertStatus(422);

        $response = $this->json('POST', '/api/tasks', ['title' => 'test']);
        $response->assertStatus(422);
    }

    /**
     * testStoreStatusUpdate
     *
     * @return void
     */
    public function testStoreStatusUpdate()
    {
        $this->assertTrue(true);
    }
}
