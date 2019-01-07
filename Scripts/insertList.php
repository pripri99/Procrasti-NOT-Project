<?php
include("session.php");

$listTitle = $_POST['listTitle'];
$listDescription = $_POST['listDescription'];
$Visibility = $_POST['Visibility'];
$userID = $_SESSION['userID'];

if(!empty($listTitle)){
    $host = "localhost"; 
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "procrastination";

    //create connection

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {

        $SELECT = "SELECT listTitle, userID FROM createlist WHERE userID = $userID AND listTitle = ? LIMIT 1";
        $INSERT = "INSERT Into createlist (userID, listTitle, listDescription, Visibility) values(?, ?, ?, ?)";
        //Prepare statement
        $a = 0;
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$listTitle);
        $stmt->execute();
        $stmt->bind_result($userID, $listTitle);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("isss", $userID, $listTitle, $listDescription, $Visibility);
            $stmt->execute();

            header("location: list.php");
        } else {
            echo " <link rel='stylesheet' type='text/css' href='../Styles/mainStyle.css'>
            <script>
                alert('This list, " .$listTitle.  " , already exist in the system');
                window.location.href='../createList.htm';
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