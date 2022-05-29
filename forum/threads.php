<?php

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title> D-forum </title>
</head>

<body>
    <?php require 'header.php'; 
    
    $id = $_GET['catid'];
    $sql ="SELECT * FROM `forum` WHERE `category_id`=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_desc'];
    } 
    ?>
    <?php
    $showalert= false;
    if(isset($_POST['post'])){
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
         $sno = $_POST['sno'];
         $th_title = str_replace("'", "\'" , "$th_title");
         $th_desc = str_replace("'", "\'" , "$th_desc");



        
        $sql ="INSERT INTO `threads` (  `thread_title`, `thread_desc`, `thread_cat_id` , `thread_user_id`) VALUES (  '$th_title', '$th_desc', '$id' , '$sno')";
        // $sql = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";

        $result = mysqli_query($conn, $sql);
        $showalert= true;
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success!</strong> your thread has been added! Please wait for comunity to responds.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }


    ?>


    <div class="container">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"><?php echo $catname ?></h1>
                <p class="col-md-8 fs-4"><?php echo $catdesc ?></p>
                <p> </p>
             </div>
        </div>

        <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
        echo '<div class="container">
        <h1 class="text-center">Start a  Discussion</h1>
        <div class="container">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Write your problem here" >
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible.</div>
            </div>
            <div class="form-floating">
                    <textarea placeholder="Write your problem description"class="form-control" style="height: 100px" name="desc" id="desc" cols="30" rows="10"></textarea>
                    <input type="hidden" name="sno" id="sno" value=" ' .$_SESSION["sno"].' ">

             </div>
             

            <button type="submit" name="post" class="btn my-3 btn-success">Submit</button>
        </form>
    </div>';
    }
    else{
        echo '
        <div class="container">
        <h1 class="py-2 text-center">Start a Discussion</h1> 
           <p class="lead text-center">You are not logged in. Please login to be able to start a Discussion</p>
        </div>
        ';
    }
    ?>
        <h1 class="text-center">Browse Question</h1>


        <?php
              $id = $_GET['catid'];
              $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
              $result = mysqli_query($conn, $sql);
              $noResult = true;
              while($row = mysqli_fetch_assoc($result)){
                  $noResult = false;
                  $id = $row['thread_id'];
                  $title = $row['thread_title'];
                  $desc = $row['thread_desc']; 
                  $thread_time = $row['dt']; 
                  $thread_user_id = $row['thread_user_id']; 
                  $sql2 = "SELECT `user_email` FROM `users` WHERE `sno`='$thread_user_id'";
                  $result2 = mysqli_query($conn, $sql2);
                  $row2 = mysqli_fetch_assoc($result2); 
                  $email = $row2['user_email'];

                  
                  
                  echo '<div class="media my-3">
                  <img src="4.jpg" width="54px" class="mr-3" alt="...">
                  <div class="media-body">'.
                   '<h5 class="mt-0"> <a class="text-dark" href="threadquetion.php?threadid=' . $id. '">'. $title . ' </a></h5>
                      '. $desc . ' </div>'.'<div class="font-weight-bold d-flex justify-content-start my-0"> Asked by:<p class="fw-bold">'.$email.'</p> &#160
                     At: '. $thread_time. '</div>
                     <hr>'.
                     
              '</div>';
                  }
                  if($noResult){
                      echo '<div class="container-fluid bg-light
                      text-center py-5">
                      <h1 class="display-5 fw-bold">No threads found</h1>
                      <p class="  text-center fs-4">Be the first persone to ask question.</p>
                     </div>';
                  }
            ?>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>