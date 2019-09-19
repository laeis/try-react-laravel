<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndexProjects()
    {
       
        factory(Task::class)->create();

        $projects = Project::active()
        ->orderBy('created_at', 'desc')
        ->withCount(['tasks' => function ($query) {
            $query->active();
        }])
        ->get();

        $rexponse_example = $projects->toArray();

        $response = $this->json('GET', '/api/projects');
        
        $response->assertStatus(200)
            ->assertJson($rexponse_example);
    }

    public function testStoreProjects()
    {
        $this->assertTrue(true);
    }

    public function testShowProjects()
    {
        $this->assertTrue(true);
    }

    public function testMarkAsCompleated()
    {
        $this->assertTrue(true);
    }
}
