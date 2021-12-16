<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Carbon\Carbon;

use App\Models\Task;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test required fields
     * 
     * @return void
     */
    public function test_task_required_fields() {
        $response = $this->json('POST', 'api/tasks', 
            [
                'task_name'   => null,
                'description' => null
            ], 
            [
                'Accept' => 'application/json'
            ]
        );

        // We can dump the response
        // $response->dump();
            
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY) // 422
            ->assertJsonStructure([
                'message',
                'errors' => ['task_name']
            ]);

            // Other Json Matchers
            // ->assertJson([
            //     "message" => "The given data was invalid.",
            //     "errors" => [
            //         "task" => ["The task field is required."],
            //     ]
            // ]);

            // ->assertExactJson([
                //     "message" => "The given data was invalid.",
                //     "errors" => [
                //         "task" => ["The task field is required."],
                //     ]
            // ]);
            
    }

    /**
     * Test nullable fields
     * 
     * @return void
     */
    public function test_task_nullable_fields() {
        $response = $this->json('POST', 'api/tasks', 
            [
                'task_name' => 'Create a Presentation',
                'description' => null
            ],
            [
                'Accept' => 'application/json'
            ]
        );
            
        $response
            ->assertStatus(Response::HTTP_CREATED) // 201
            ->assertJson([
                "message" => "Task successfully added.",
            ]);
    }
    
    /**
     * Test storing of tasks
     * 
     */
    public function test_store_task() {
        $response = $this->json('POST', 'api/tasks', 
            [
                'task_name'   => 'Create a Presentation',
                'description' => 'Choose your own topic to discuss within the team that you think will help with your workflow.'
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        // We can dump the response
        // $response->dump();
            
        $response
            ->assertStatus(Response::HTTP_CREATED) // 201
            ->assertJson([
                "message" => "Task successfully added.",
            ]);
    }

    /**
     * Test updating of tasks if done
     * 
     */
    public function test_update_task_required_if_done() {
        // Create a task
        $task = [
            'task_name'   => 'Create a Presentation',
            'description' => 'Choose your own topic to discuss within the team that you think will help with your workflow.',
        ];

        Task::create($task);

        // Update recently created task
        $response = $this->json('PUT', 'api/tasks/3', 
            array_merge($task,
                [
                    'done'    => true,
                    'done_at' => null
                ]
            ),
            [
                'Accept' => 'application/json'
            ]
        );

        // We can dump the response
        // $response->dump();
            
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY) // 422
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'done_at'
                ]
            ]);
    }

    /**
     * Test updating of tasks
     * 
     */
    public function test_update_task() {
        // Create a task
        $task = [
            'task_name'   => 'Create a Presentation',
            'description' => 'Choose your own topic to discuss within the team that you think will help with your workflow.',
        ];

        Task::create($task);

        // Update recently created task
        $response = $this->json('PUT', 'api/tasks/4', 
            array_merge($task,
                [
                    'done'        => true,
                    'done_at'     => Carbon::now()->format('Y-m-d H:i:s')
                ]
            ),
            [
                'Accept' => 'application/json'
            ]
        );

        // We can dump the response
        // $response->dump();
            
        $response
            ->assertStatus(Response::HTTP_OK) // 200
            ->assertJson([
                "message" => "Task successfully updated.",
            ]);
    }

    /**
     * Test get all tasks
     * 
     */
    public function test_get_all_tasks_without_data() {
        $response = $this->json('GET', 'api/tasks');

        $response
            ->assertStatus(Response::HTTP_OK) // 200
            ->assertJsonStructure([
                'message',
                'data',
            ]);
    }

    /**
     * Test get all tasks
     * 
     */
    public function test_get_all_tasks_with_data() {
        // Create tasks through factory
        Task::factory()->count(10)->create();

        // Get tasks
        $response = $this->json('GET', 'api/tasks');

        // We can dump the response
        // $response->dump();

        $response
            ->assertStatus(Response::HTTP_OK) // 200
            ->assertJsonStructure([
                'message',
                'data' => [
                    '*' => ['id', 'task_name', 'description', 'done', 'done_at', 'created_at', 'updated_at']
                ]
            ]);
    }
}
