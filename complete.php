<?php

require_once('task.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $taskobj = new task();
    if($taskobj->SetCompleted($id)){

		header("location: index.php");
            exit;
	}else{
				echo "Complete Not Done";
	}

   
} 
 else {
    header("location: completed.php");
        exit;

}

?>