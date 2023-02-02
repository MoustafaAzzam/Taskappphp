<?php include "./navbar.php";
require_once('task.php'); ?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">

    <title>Notes app</title>
</head>

<body>


    </br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card my-3">
                    <h5 class="card-header">My Tasks</h5>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <?php




                            if (isset($_GET["page"])) {
                                $page = $_GET["page"];
                            } else {
                                $page = 1;
                            }

                            $start_from = ($page - 1) * 6;
                            $pagination_pages = 6;
                            $taskobj = new task();

                            $result = $taskobj->GetCompletedTasksPaginatedData($start_from,$pagination_pages);

                            foreach ($result as $row) {

                                ?>

                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $row['id']; ?>
                                        </th>
                                        <td>
                                            <?php echo $row['title']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['ndesc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['due']; ?>
                                        </td>
                                        <td>

                                            <a href="incomplete.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-outline-danger btn-sm">Not Completed</a>
                                        </td>
                                    </tr>

                                    <?php
                            }


                            ?>

                            </tbody>
                        </table>


                    </div>

                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php


                        $taskobj = new task();
                        $row_numbers = sizeof($taskobj->GetCompletedTasksData());
                        $total_pages = ceil($row_numbers / 6);
                        
                        for ($i = 1; $i <= $total_pages; $i++) {

                            echo "<li class='page-item'><a class='page-link' href='completed.php?page=" . $i . "'>" . $i . "</a></li>";
                        } ?>
                    </ul>
                </nav>

            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    </br>


</body>

</html>