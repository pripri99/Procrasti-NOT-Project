<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../Styles/main.css">
    <link rel="stylesheet" type="text/css" href="../Styles/mainStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="myScript.js"></script> 

    <title>Create Task</title>
  </head>
  <body>

      <div class="container text-center mx-auto p-5 bg-white mt-5"  >
        <div class="container"> 
          <h1> Procrasti- NOT </h1>
          <blockquote class="blockquote mb-0">
            <p>"Never put off till tomorrow what may be done day after tomorrow just as well."</p>
            <footer class="blockquote-footer">Mark Twain </footer>
          </blockquote>
        </div>
      </div> 

        <div class="container mx-auto p-5 bg-white mb-5" >

            <form action="insert.php" method="POST" class="needs-validation" id="myForm" novalidate>
                <div class="form-group">
                  <label for="taskTitle">Title of the Task</label>
                  <input type="text" class="form-control" id="taskTitle" name="taskTitle" pattern="[A-Za-z0-9\s]+" maxlength="25" required>
                  <small id="passwordHelpBlock" class="form-text text-muted">
                      Your title must be less than 25 characters long and must not contain special characters, or emoji.
                    </small>
                  <div class="invalid-feedback">
                    Please choose a valid title for the task.
                  </div>

                </div>
                <div class="form-group">
                  <label for="taskDescription">Description of the Task</label>
                  <textarea class="form-control" id="taskDescription" rows="3" name="taskDescription"></textarea>
                </div>

                <div class="form-group">
                  <label for="listTitle">Choose a List</label>
                  <button type="submit" class="btn btn-outline-secondary btn-sm float-right" onclick= "window.location = 'createList.html'">create a List</button>
                  <select class="custom-select mr-sm-2" id="listTitle" name="listTitle" required>
                    <option selected hidden value="">Choose...</option>
                    <?php
                      include("session.php");
                      $userID = $_SESSION['userID'];

                      
                      $conn = mysqli_connect("localhost", "root", "", "procrastination");

                      // Check connection
                      if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                      } 
                      $sql = "SELECT userID, listTitle From createlist";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {

                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                          if ($row['userID'] == $userID){
                            echo('<option value="'.$row['listTitle'].' ">'.$row['listTitle'].'</option>');
                          }
                          //echo ("<option value= " '. $row['listTitle']. ' ">" . $row["listTitle"]. "</option>");
                          
                      }
                    }
                      //$result->close();
                      $conn->close();
                    ?>
                  </select>
                </div>

                <div class="form-group">
                    <label >Visibility: </label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="publicRadio" name="Visibility" value="pub" class="custom-control-input" required>
                        <label class="custom-control-label" for="publicRadio">Public</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="privateRadio" name="Visibility" value="pri" class="custom-control-input" required>
                      <label class="custom-control-label" for="privateRadio">Private</label>
                    </div>
                </div>

              

                <div class="form-group form-inline" id="dueDate">
                    <label for="inputDate" class="pr-2">Due Date:</label>
                      <input type="date" id="inputDate" class="form-control" aria-describedby="dueDateHelpInline" placeholder="Date" name="dueDate"  min=
                        <?php
                          echo date('Y-m-d');
                        ?>
                      required>
                </div>

                <div class="form-group">
                    <label for="priorityLevel">Priority</label>
                    <select class="custom-select mr-sm-2" id="priorityLevel" name="priorityLVL" required>
                      <option selected hidden value="">Choose...</option>
                      <option value="l">Low</option>
                      <option value="m">Medium</option>
                      <option value="h">High</option>
                    </select>
                </div>

                <button type="return" class="btn btn-secondary float-left" onclick="event.preventDefault(); resetForm();" > &#8592; Back to Home Page  </button>

                <button type="submit" class="btn btn-primary float-right">Submit</button>
                <br>
            </form>
        </div>
        <script>
          function resetForm() {
              document.getElementById("myForm").reset();
              location.href='home-page.php';
          }
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
              'use strict';
              window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                  form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                  }, false);
                });
              }, false);
            })();
          </script>

  </body>
</html>
