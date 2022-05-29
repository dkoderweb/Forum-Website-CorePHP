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
    $id = $_GET['threadid'];
    $sql ="SELECT * FROM `threads` WHERE `thread_id`=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['thread_title'];
        $catdesc = $row['thread_desc'];
        $cat_user = $row['thread_user_id']; 
        $sql2 = "SELECT `user_email` FROM `users` WHERE `sno`='$cat_user'";
        $result3 = mysqli_query($conn, $sql2);
        $row3 = mysqli_fetch_assoc($result3); 
        $name = $row3['user_email'];

      
    } 
    ?>
    <div class="container">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"><?php echo $catname ?></h1>
                <p class="col-md-8 fs-4"><?php echo $catdesc ?></p>
                <p>Posted by :<?php echo   $name ?> </p>
            </div>
        </div>




        <div class="container">
            <?php
            if(isset($_POST['postcom'])){
                $comment =$_POST['comment'];
                $sno = $_POST['sno']; 
                $comment = str_replace("'", "\'" , "$comment");
                // $postsql = "INSERT INTO `comment` (`comment_id`, `comment_content	`, `thread_id`, `comment_by`, `comment_time`) VALUES (NULL, '1', '1', '1', current_timestamp());"
                $postsql="INSERT INTO `comment` ( `comment_content`, `thread_id`, `comment_by` ) VALUES ( '$comment', '$id', '$sno' )";
                $result = mysqli_query($conn, $postsql);
            }

            ?>
            <div class="container">
                <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
                    echo '<h1 class="text-center">Post a comment</h1>
                <div class="container">
                    <form method="post">

                        <label for="desc" class="my-2">Type your comment</label>
                        <div class="form-floating">
                            <textarea placeholder="Write your problem description" class="form-control"
                                style="height: 100px" name="comment" id="comment" cols="30" rows="10"></textarea>
                                <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">

                        </div>


                        <button type="submit" name="postcom" class="btn my-3 btn-success">Post Comment </button>
                    </form>';
                }
                else{
                    echo '
        <div class="container">
        <h1 class="py-2 text-center">Post a comment</h1> 
           <p class="lead text-center">You are not logged in. Please login to be able to post a comment</p>
        </div>
        ';
                }
                    ?>

                <h1 class="text-center">Discussions</h1>

                <?php
              $id = $_GET['threadid'];
              $sql = "SELECT * FROM `comment` WHERE thread_id=$id"; 
              $result = mysqli_query($conn, $sql);
              $noResult = true;
              while($row = mysqli_fetch_assoc($result)){
                  $noResult = false;
                  $id = $row['comment_id'];
                  $Content = $row['comment_content'];
                   $comment_time = $row['comment_time']; 
                   $thread_user_id = $row['comment_by']; 
                   $sql2 = "SELECT `user_email` FROM `users` WHERE `sno`='$thread_user_id'";
                   $result2 = mysqli_query($conn, $sql2);
                   $row2 = mysqli_fetch_assoc($result2); 
                   $email = $row2['user_email'];
                   
                  
                echo '<div class="media my-3">
                <div class="media-body">
                <div class="d-flex justify-content-start"> <img src="4.jpg" width="54px" class="mr-3  me-3" alt="...">
                
                <p class="fw-bold my-0 " >'.$email.'</p>  </div>
                <p class="font-weight-bold my-0"></p> '. $Content . '
                <p class="fw-bold text-end" >Post at ' .$comment_time.'</p>
                <hr>
                   
                </div>
            </div>';
          
                  }
                  if($noResult){
                    echo '<div class="container-fluid bg-secondary bg-gradient
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
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
            </script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>