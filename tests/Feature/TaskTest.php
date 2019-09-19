<?php

namespace Tests\Feature;


use App\Models\Project;
use App\Models\Task;
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

        $task = factory(Task::class)->create();

        $response = $this->json('PUT', '/api/tasks/' . $task->id);
       
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Task updated!'
            ]);

        $updated_task = Task::find($task->id);
       
        $this->assertTrue($updated_task->is_compleated == true, 'Task status not updated');
    }


    /**
     * testErorrStatusUpdate
     * 
     * @return void
     */
    public function testErorrStatusUpdate()
    {
        $response = $this->json('PUT', '/api/tasks/0');
        $response
            ->assertStatus(404);
    }
}
