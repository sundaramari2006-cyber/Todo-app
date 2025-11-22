<?php
$con = mysqli_connect("localhost", "root", "", "todoapplicationpro")
       or die("Could not connect");

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM todo WHERE id=$id");
$row = mysqli_fetch_assoc($result);

// UPDATE TASK
if (isset($_POST['update'])) {
    $data = $_POST['listdata'];
    mysqli_query($con, "UPDATE todo SET Name='$data' WHERE Id=$id");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <style>

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 40px;
        }

        .edit-container {
            width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
        }

        .edit-title {
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
        }

        .edit-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .edit-input {
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .edit-btn {
            background: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.25s ease-in-out;
        }

        .edit-btn:hover {
            background: #0056b3;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
        }

        .back-link {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #444;
        }

        .back-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="edit-container">
    <h2 class="edit-title">Edit Task</h2>

    <form method="post" class="edit-form">
        <input type="text" name="listdata" class="edit-input"
               value="<?php echo $row['Name']; ?>" required>

        <input type="submit" name="update" value="Update Task" class="edit-btn">
    </form>

    <a href="index.php" class="back-link">← Back to List</a>
</div>

</body>
</html>
