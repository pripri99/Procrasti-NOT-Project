<?php
    include("session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../Styles/main.css">
    <link rel="stylesheet" type="text/css" href="../Styles/mainStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="myScript.js"></script> 
	<link rel="stylesheet" type="text/css" href="../Styles/todos.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
    
    
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button type="button" class="btn btn-secondary mx-2" onclick="location.href='home-page.php';" > &#8592; Back to Home Page  </button>
    <button type="button" class="btn btn-primary mx-5" onclick="location.href='task.php';" > New task </button>
    <button type="button" class="btn btn-warning mx-1" onclick="location.href='createList.html';" > New List </button>
</nav>



<div class="grid-container">

    <?php
        $host = "localhost"; 
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "procrastination";
        $userID = $_SESSION['userID'];

        //create connection

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

        $RemoveOld = "DELETE FROM createtask WHERE createtask.dueDate < date('Y-m-d')";
        $conn->query($RemoveOld);
 
        $stack = array();
        

		$sql= "SELECT  createlist.listTitle, createtask.taskTitle, createtask.priorityLVL, createtask.taskID, createtask.dueDate 
		From createtask 
		INNER JOIN createlist 
		ON createtask.listTitle =createlist.listTitle
        AND createlist.userID = $userID
        AND createtask.userID = $userID
        ORDER BY createlist.listTitle";



        $result = $conn->query($sql);
        $Title = "";
        


		while($row = $result->fetch_assoc())

		{
            

            if ($Title != $row['listTitle'] ){

                // close list unless it is the first one
                if  ($Title != ""){
                    echo "</u1>";

                    echo "</div>";
                }

                $Title = $row['listTitle'];
                array_push($stack, $row['listTitle']);
                echo "<div id= 'grid-item' >";
                echo "<h1>" . $row['listTitle'] . " <i class='fa fa-plus' style='cursor: pointer;' data-toggle='tooltip' title='Add Task'></i> </h1>";
                echo "<u1 style='list-style: none;'>";
                
            }

            $string = str_replace(' ', '-', $row['taskTitle']);

            echo "<li > <span><i class='fa fa-trash task' id= " . $row['taskID'] . " value= ' $string ' ></i></span> " . $row['taskTitle'] ."</li>";

        }

        $sql2= "SELECT  listTitle From createlist Where userID = $userID ORDER BY listTitle";



        $result = $conn->query($sql2);
        


        while($row = $result->fetch_assoc())

		{

            if ($Title != $row['listTitle'] && !in_array($row['listTitle'], $stack) ){

                // close list unless it is the first one
                if  ($Title != ""){

                    echo "</div>";
                }

                $Title = $row['listTitle'];
                echo "<div id= 'grid-item' >";
                echo "<h1>" . $row['listTitle'] . " <i class='fa fa-plus' style='cursor: pointer;' data-toggle='tooltip' title='Add Task'></i> </h1>";
                
                
            }

        }

    ?>



	
</div>
<script >
    

    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    });

    $(".fa-plus").click(function(){
	    window.location = "task.php";
    });

    $(".task").click(function(event){
        var temp = $(this).attr('value');
        var title = temp.replace(/[-]/gi," ");
        var value = $(this).attr('id'); 
        var del = confirm("Are you sure you want to delete the task: "+ title + " ?");
            if (del == true) {
                $.ajax({
                    url: "deleteTask.php",
                    type: "post",
                    data: {task: value} ,
                    success: function (response) {
                        response = response + title + ", was sucessfully deleted.";
                        //$("#deleteTask").html(response);
                        alert(response);
                        //$("#warning").removeClass("d-none");
                        //$("#DeleteTask").html(response);
                        //document.getElementByClass("alert-info").style.display = "inline";
                        
                    // you will get response from your php page (what you echo or print)                 

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    }


                });
            
                $(this).parent().parent().fadeOut(function(){
                    $(this).remove();
                });
        }
        
        event.stopPropagation();
        $
    });

    function hideAlert(){
        ("#warning").addClass("d-none");
    }

    /*$(".fa-trash").click(function(){

	window.location = "list.php";
    });*/


</script>



</body>
</html>