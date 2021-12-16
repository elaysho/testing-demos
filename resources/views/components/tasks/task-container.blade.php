<h1 class="text-2xl font-bold">Todo List</h1>
<div class="grid grid-cols-1 gap-2">
    @if(!is_null($data))
        @forelse($data as $task)
            @include('components.tasks.task-with-description', [
                'id'          => $task['id'],
                'task_name'   => $task['task_name'],
                'description' => $task['description'],
                'done'        => $task['done'],
                'done_at'     => $task['done_at']
            ])
        @empty
        @endforelse
    @else
        <div class="task bg-base-200 text-center rounded-lg py-2 px-4">
            <span class="label-text">No tasks yet.</span> 
        </div>
    @endif
</div>