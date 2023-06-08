<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
    <h1>Todo List</h1>

    <form id="addTaskForm">
        <input type="text" id="taskName" placeholder="Task name" required>
        <button type="submit">Add Task</button>
    </form>

    <h2>Tasks:</h2>
    <ul id="taskList">
    </ul>

    <script>
        $(document).ready(function() {
            loadTasks();

            // Cargar las tareas al cargar la página
            function loadTasks() {
                $.ajax({
                    url: 'tasks.php',
                    type: 'GET',
                    success: function(response) {
                        $('#taskList').html(response);
                    }
                });
            }

            // Función para agregar una nueva tarea
            $('#addTaskForm').submit(function(e) {
                e.preventDefault();
                var taskName = $('#taskName').val();
                $.ajax({
                    url: 'tasks.php',
                    type: 'POST',
                    data: {
                        action: 'add_task',
                        task_name: taskName
                    },
                    success: function(response) {
                        $('#taskName').val('');
                        loadTasks();
                        Swal.fire('Task added!', '', 'success');
                    }
                });
            });

            // Función para eliminar una tarea
            $(document).on('click', '.deleteTask', function() {
                var taskId = $(this).data('task-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'tasks.php',
                            type: 'POST',
                            data: {
                                action: 'delete_task',
                                task_id: taskId
                            },
                            success: function(response) {
                                loadTasks();
                                Swal.fire('Task deleted!', '', 'success');
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
