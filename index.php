<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO Application</title>

    <style>

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fa;
            padding: 40px;
            margin: 0;
        }

        .container {
            width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
        }

        .title {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 25px;
        }

        /* Form */
        .task-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .task-input {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .task-button {
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .task-button:hover {
            background: #218838;
            transform: scale(1.05);
        }

        /* Table */
        .task-table {
            width: 100%;
            border-collapse: collapse;
        }

        .task-table th {
            background: #007bff;
            color: white;
            padding: 12px;
            text-align: center;
        }

        .task-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        /* Completed task style */
        .completed {
            color: #888 !important;
            text-decoration: line-through;
        }

        /* Checkbox */
        .status-checkbox {
            transform: scale(1.3);
            cursor: pointer;
            accent-color: #28a745;
        }

        /* Actions */
        .action-box {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .btn {
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            transition: 0.25s ease-in-out;
        }

        .btn-edit {
            background: #ffc107;
        }
        .btn-edit:hover {
            background: #e0a800;
        }

        .btn-delete {
            background: #dc3545;
        }
        .btn-delete:hover {
            background: #c82333;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #888;
        }

    </style>
</head>
<body>

<div class="container">

    <h1 class="title">TODO List Application</h1>

    <!-- ADD TASK FORM -->
    <form action="index.php" method="post" class="task-form">
        <input type="text" name="listdata" class="task-input" placeholder="Enter your task" required>
        <input type="submit" name="submit" value="Submit" class="task-button">
    </form>

    <?php
    // CONNECT DATABASE
    $con = mysqli_connect("localhost", "root", "", "todoapplicationpro")
        or die("Could not connect to server");

    // INSERT DATA
    if (isset($_POST['submit'])) {
        $data = $_POST['listdata'];
        $query = "INSERT INTO todo (Name, Status) VALUES ('$data', 0)";
        mysqli_query($con, $query) or die(mysqli_error($con));
    }

    // DELETE
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($con, "DELETE FROM todo WHERE Id=$id");
        header("Location: index.php");
        exit;
    }

    // UPDATE STATUS (AJAX alternative simple GET)
    if (isset($_GET['status'])) {
        $id = $_GET['status'];
        $value = $_GET['value'];
        mysqli_query($con, "UPDATE todo SET Status=$value WHERE Id=$id");
        header("Location: index.php");
        exit;
    }

    // FETCH TASKS
    $query = "SELECT * FROM todo ORDER BY Id DESC";
    $result = mysqli_query($con, $query);
    ?>

    <!-- SHOW DATA -->
    <table class="task-table">
        <tr>
            <th>ID</th>
            <th>Task</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $isDone = $row['Status'] == 1 ? "checked" : "";
                $textClass = $row['Status'] == 1 ? "completed" : "";
        ?>
                <tr>
                    <td><?php echo $row['Id']; ?></td>

                    <td class="<?php echo $textClass; ?>">
                        <?php echo $row['Name']; ?>
                    </td>

                    <td>
                        <input 
                            type="checkbox" 
                            class="status-checkbox"
                            onclick="location.href='index.php?status=<?php echo $row['Id']; ?>&value='+this.checked"
                            <?php echo $isDone; ?>
                        >
                    </td>

                    <td>
                        <div class="action-box">
                            <a class="btn btn-edit" href="edit.php?id=<?php echo $row['Id']; ?>">Edit</a>

                            <a class="btn btn-delete" 
                               href="index.php?delete=<?php echo $row['Id']; ?>"
                               onclick="return confirm('Delete this task?')">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>

        <?php } } else { ?>

            <tr>
                <td colspan="4" class="no-data">No tasks yet</td>
            </tr>

        <?php } ?>
    </table>

</div>

</body>
</html>
