<div class="task bg-base-200 text-base-content rounded-lg hover:border hover:border-base-content">
    <form action="{{ route('tasks.update', ['task' => $id]) }}" method="POST">
        @method('PUT')

        <div tabindex="0" class="collapse flex-row collapse-arrow"> 
            <div class="form-control flex-row justify-start space-x-1">
                <label class="cursor-pointer label pl-6">
                    <input type="checkbox" name="done" class="checkbox rounded-md"
                        {{ !is_null($done) ? ($done == 1 || $done == true) ? 'checked' : '' : '' }}>
                </label>
                <span class="collapse-title ml-0">
                    <span class="label-text">{{ $task_name ?? 'N/A' }}</span> 
                </span>
            </div>
            <div class="collapse-content focus:bg-base-200 px-4">
                {{ $description ?? 'No description.' }}
            </div>
        </div>
    </form>
</div>