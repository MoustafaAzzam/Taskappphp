<?php

require_once('task.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $taskobj = new task();
    if($taskobj->SetInCompleted($id)){

		header("location: completed.php");
        exit;
	}else{
				echo "incomplete Not Done";
	}
    
    
} else {
    header("location: completed.php");
        exit;

}

?>