<?php
$host = "localhost"; 
$dbUsername = "root";
$dbPassword = "";
$dbname = "procrastination";

//create connection

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);


$taskID = $_POST['task'];
$taskTitle = '';


$SELECT = "SELECT taskID From createtask WHERE taskID = ? Limit 1";
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("i", $taskID);
$stmt->execute();
$stmt->bind_result($taskID);
$stmt->store_result();


$deleteTask = "DELETE FROM createtask WHERE taskID= ?";
$stmt = $conn->prepare($deleteTask);
$stmt->bind_param("i", $taskID);
$stmt->execute();
if ($stmt->execute()) {
    echo "The task, ";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();



?>