<div class="task bg-base-200 rounded-lg hover:border hover:border-base-content py-2 px-4">
    <form action="{{ route('tasks.update', ['task' => $id]) }}" method="POST">
        @method('PUT')

        <div class="form-control">
            <label class="cursor-pointer label justify-start space-x-4">
                <input type="checkbox" name="done" class="checkbox rounded-md"
                    {{ ($done == 1 || $done == true) ? 'checked' : '' }}>
                <span class="label-text">{{ $task_name ?? 'N/A' }}</span> 
            </label>
        </div>
    </form>
</div>