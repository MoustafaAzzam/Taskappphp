<?php include "./navbar.php";
require_once('task.php'); ?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">

    <style>
        form {
            border: 2px solid #ced4da;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
    <title>Notes app</title>
</head>

<body>



    <div class="container my-4">
        </br>
        <div class="row justify-content-center">
            <div class="col lg 10">
                <?php
                if (isset($_GET['id'])) {
                    $task_id = $_GET['id'];
                    $taskobj = new task();
                    $result = $taskobj->GetTasksById($task_id);

                    foreach ($result as $row) {

                    }



                }

                if (isset($_POST["submit"])) {

                    $id = $task_id;
                    $title = $_POST["title"];
                    $description = $_POST["desc"];
                    $duedate = $_POST["dudate"];
                    $status = $row['status'];

                    if (empty($title) || empty($description) || empty($duedate)) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Please Fill All fields</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
                    } else {
                        $taskobj = new task();
                        if($taskobj->UpdateTask($id,$title,$description,$status,$duedate)){

                            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
              <strong>Task Added Sucessfully</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';

                        }
                        header("location: index.php");
                        exit;
                    }

                }

                ?>
                <form class="form" method="post">

                    <input type="hidden" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter note title." name="title"
                            value="<?php echo $row['title']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" id="desc" rows="3" placeholder="Enter note description."
                            name="desc"><?php echo $row['ndesc']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="duedate" class="form-label">Due date</label>
                        <input type="date" class="form-control" id="dudate" name="dudate"
                            value="<?php echo $row['due']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-md" name="submit">Edit Task</button>
                    <button type="cancel" class="btn btn-outline-primary btn-md" name="cancel"><a
                            class="navbar-brand btn  " href="index.php">Cancel</a></button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>


</body>

</html>