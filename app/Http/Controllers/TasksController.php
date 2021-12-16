<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;

use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Returns all tasks
     * 
     */
    public function index() {
        $tasks = Task::all()->toArray();

        return response()->json(
            [
                'message' => 'Tasks retrieved succesfully.',
                'data'    => $tasks
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Stores task
     * 
     */
    public function store(Request $request) {
        // Validate request body
        $validated = $request->validate([
            'task_name'   => 'string|required',
            'description' => 'nullable'
        ]);

        // Create a task
        $task = Task::create($validated);

        return response()->json(
            [
                'message' => 'Task successfully added.',
                'data'    => $task
            ],
            Response::HTTP_CREATED
        );
    }
    
    /**
     * Update task
     * 
     */
    public function update(Request $request) {
        // Validate request body
        $validated = $request->validate([
            'task'        => 'exists:tasks,id',
            'task_name'   => 'string|required',
            'done'        => 'in:0,1|required',
            'done_at'     => 'date|required_if:done,1',
            'description' => 'nullable'
        ]);

        // Update task
        $task = Task::findOrFail(intval($request->task));
        $task = $task->update($validated);

        return response()->json(
            [
                'message' => 'Task successfully updated.',
                'data'    => $task
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Render task list view
     * 
     */
    public function renderView(Request $request) {
        $validated = $request->validate([
            'view'  => 'required',
            'data' => 'required',
            'index' => 'required'
        ]);

        $data = [];
        foreach($validated['index'] as $i) {
            $data[$i] = $validated['data'][$i] ?? null;
        }

        $view = View::make("components.tasks.{$validated['view']}", $data);
        $html = $view->render();

        return response()->json([
            'message' => 'Succesfully rendered view.',
            'html'    => $html
        ]);
    }
}
