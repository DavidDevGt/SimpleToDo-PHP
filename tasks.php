<?php
include 'database.php';

// Manejar las operaciones CRUD
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'add_task') {
        if (isset($_POST['task_name'])) {
            $taskName = $_POST['task_name'];

            $query = "INSERT INTO tasks (task_name) VALUES ('$taskName')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Error: " . mysqli_error($conn));
            }
        }
    } elseif ($_POST['action'] === 'delete_task') {
        if (isset($_POST['task_id'])) {
            $taskId = $_POST['task_id'];

            $query = "DELETE FROM tasks WHERE id = $taskId";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Error: " . mysqli_error($conn));
            }
        }
    }
}

// Obtener y mostrar las tareas
$query = "SELECT * FROM tasks";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li>'.$row['task_name'].' 
              <button class="deleteTask" data-task-id="'.$row['id'].'">Delete</button>
              </li>';
    }
} else {
    echo '<li>No tasks found</li>';
}
?>
