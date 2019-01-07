<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="Styles/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="myScript.js"></script> 

    <title>insert</title>
  </head>
  <body>
<?php
include("session.php");

$taskTitle = $_POST['taskTitle'];
$taskDescription = $_POST['taskDescription'];
$listTitle = $_POST['listTitle'];
$Visibility = $_POST['Visibility'];
//$Frequency = $_POST['Frequency'];
$dueDate = $_POST['dueDate'];
$priorityLVL =$_POST['priorityLVL'];
$userID = $_SESSION['userID'];

if(!empty($taskTitle)){
    $host = "localhost"; 
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "procrastination";

    //create connection

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
        $SELECT = "SELECT taskTitle, userID From createtask WHERE userID = $userID AND taskTitle = ? Limit 1";
        $INSERT = "INSERT Into createtask (userID, taskTitle, taskDescription, listTitle, Visibility, 
            dueDate, priorityLVL) values(?, ?, ?, ?, ?, ?, ?)";

        //Prepare statement
        $Id = 0;
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $taskTitle);
        $stmt->execute();
        $stmt->bind_result($taskTitle, $Id);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("issssss", $userID, $taskTitle, $taskDescription, $listTitle, $Visibility, $dueDate, $priorityLVL);
            $stmt->execute();

            header("location: list.php");


        } else {
            echo " <link rel='stylesheet' type='text/css' href='../Styles/mainStyle.css'>
                <script>
                    alert('This task, " .$taskTitle.  " , already exist in the system');
                    window.location.href='task.php';
                </script>";
        }

        $stmt->close();
        $conn->close();

    }

} else {
    echo "Title is required";
    die();
}
?>
  </body>
</html>