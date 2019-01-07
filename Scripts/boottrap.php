<?php
   
    include 'comments.inc.php';
    date_default_timezone_set('Asia/Bangkok');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

      <style type = "text/css">
      body{
           padding-top: 110px;
           padding-bottom: 20px;
           width: 100%;
           height: 100%;
      }
      
       
     </style>
  </head>
  <body bgcolor = "#FFFFFF">
    
     <nav class="navbar navbar-default navbar-fixed-top">
         <div class="container">
             <button type="button" class="navbar-toggle" data-toggle="collapse"
               data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <h1 class="navbar-brand">You are welcomed to Log In below<h1>
         <div class="navbar-collapse collapse">
             <ul class="nav navbar-nav navbar-right">
                 <li class="active"><a href="register.php">Register</a></li>

             </ul>

         </div>
         </div>
     </nav>
     <!--This is the content area-->
     
     <div class="container-fluid">
         <div class="row">
             <div class="col-xs-12">
         <?php
          
         echo "<form role='form' class='col-xs-6'>
            
               <div class='form-group'>
                 <input type='hidden' class='form-control' id='firstname'  name='firstname' required>
                </div>
                <div class='form-group'>
                  <input type='hidden' class='form-control' id='".date('Y-m-d H:i:S')."' name='date' required>
                </div>
                <div class='form-group form-group-lg'>
                    <input type='text' class='form-control' id='comment' placeholder='Post Comment' name='comment'>
                </div>
                <div class='form-group'>
                   <input type='submit' class='btn btn-default' name='commentSubmit' value='Submit'>
                </div>
             
         </form>";
         ?>
         
                
                  
                
         </div>
        </div>
    </div>
     <!--This is the footer-->
     <div class="navbar navbar-inverse navbar-fixed-bottom">
        <div class="container">
            <div class="navbar-text pull-left">
            <p>Copyright@ Procrastination 2018</p>
            </div>
        </div>
     </div>
    
  </body>
</html>