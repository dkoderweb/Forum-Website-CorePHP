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
        if(isset($_GET['loggedout']) && $_GET['loggedout']==true){
            echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
            <strong>Alert!</strong> You are logged out.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
    <strong>success!</strong>You are loggged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
        }
    
     ?>
    
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container">
        <?php
         if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
           
        }
        else{
            echo '
            <div class="container my-3">
            <div class="p-5 mb-4 bg-light rounded-3">

            <h1 class="py-2 text-center">You are not logged in !</h1> 
               <p class="lead text-center">If you have already username please <a href="" data-bs-toggle="modal" data-bs-target="#loginmodal" >Login</a>
               </p>
               <p class="lead text-center">If you do not have username please <a href="" data-bs-toggle="modal" data-bs-target="#signupmodal" >Signup</a>
               </p>
               <p class="lead text-center"> </p>

               </div>

            </div>
            ';
        }
        ?>
        <a href="" data-bs-toggle="modal" data-bs-target="#loginmodal" ></a>

        <h1 class="text-center my-4">D-Forum Brows Categories</h1>
        <div class="row my-4">


        <?php 
        $sql ="SELECT * FROM `forum` ";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_desc'];
                
             echo '
             <div class="col-md-4  ">
                 <div class="card my" style="width: 18rem;">
                     <img src="https://media.istockphoto.com/photos/python-code-picture-id1183226281?b=1&k=20&m=1183226281&s=170667a&w=0&h=v5WB9EQzegvOkR58u75qjOSC-kiv6WWnK1cn1VXfJDg="
                         class="card-img-top" alt="...">
                     <div class="card-body">
                         <h5 class="card-title">  <a href="threads.php?catid='.$id.'">'.$cat.'</a></h5>
                         <p class="card-text">'. substr($desc,0,90).'.....</p>
                         <a href="threads.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                     </div>
                 </div>
             </div>';
                 
        }

        ?>
  </div> 

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