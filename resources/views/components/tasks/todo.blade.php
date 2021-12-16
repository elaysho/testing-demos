<div class="w-full">
    <div class="card shadow bg-base-300">
        <!-- Add Task -->
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="card-body space-y-4">
                <h1 class="text-2xl font-bold">Add a Task</h1>
                <div class="task-errors-container"></div>

                <div class="form-control">
                    <input type="text" name="task_name" placeholder="Task Name" class="input rounded-lg">
                </div>
                    <div class="form-control">
                    <textarea type="text" name="description" placeholder="Description"
                        class="textarea h-24 rounded-lg"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-add-task">Add</button>
            </div>
        </form>

        <!-- To Do List -->
        <div class="tasks-container card-body space-y-4 pt-0">
            <h1 class="text-2xl font-bold">Todo List</h1>
        </div>
    </div> 
</div>