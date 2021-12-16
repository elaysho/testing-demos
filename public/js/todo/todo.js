$(document).ready(() => {
    // Get tasks and render a view
    $.ajax({
        method: "GET",
        url: location.href + 'api/tasks',
        success: (tasks) => {
            // Render view
            $.ajax({
                method: "POST",
                url: location + 'api/tasks/view',
                data: {
                    data: tasks,
                    view: 'task-container',
                    index: ['data']
                },
                success: (html) => {
                    $('.tasks-container').html(html.html);
                }
            });
        }
    });

    // Add task on database and append rendered view
    $('.btn-add-task').on('click', (ev) => {
        ev.preventDefault();

        var data = {
            task_name: $('[name="task_name"]').val(),
            description: $('[name="description"]').val()
        };

        $.ajax({
            method: "POST",
            url: location.href + 'api/tasks',
            data: data,
            success: (task) => {
                // Clear errors
                $('.tasks-errors-container').html('');
                
                // Render view
                $.ajax({
                    method: "POST",
                    url: location + 'api/tasks/view',
                    data: {
                        data: task['data'],
                        view: 'task-with-description',
                        index: ['id', 'task_name', 'description', 'done', 'done_at']
                    },
                    success: (html) => {
                        $('.tasks-container').append(html.html);
                    }
                });
            },
            error: (error) => {
                var errors = {
                    data: []
                };
                
                $.each(error.responseJSON.errors, (i, fieldErrors) => {
                    var flattened = fieldErrors.flat();
                    $.each(flattened, (j, err) => {
                        errors.data.push(err);
                    });
                });

                $.ajax({
                    method: "POST",
                    url: location + 'api/tasks/view',
                    data: {
                        data: errors,
                        view: 'task-errors',
                        index: ['data']
                    },
                    success: (html) => {
                        $('.task-errors-container').html(html.html);
                    }
                });
            }
        });
    });

    // Update task
    // TBA
});