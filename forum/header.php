<?php
$conn = mysqli_connect("localhost", "root", "", "forum");
if(!$conn){
die(mysqli_connect_error($conn));
}

 ?>

<?php

echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php
  ">D-Forum</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Top Categories
        </a><ul class="dropdown-menu" aria-labelledby="navbarDropdown">';


        $sql = "SELECT category_name, category_id FROM `forum`  ";
        $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
      echo
        '
           <a class="dropdown-item"  href="threads.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a> ';}
           
        echo '</ul>
      </li>
      <li class="nav-item">
      <a class="nav-link" diseble href=#">Contact</a>
    </li>
    </ul>
    <form class="d-flex">';

     session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
      echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
           <p class="text-light my-0 mx-2">Welcome&#160:&#160' .$_SESSION['user_email']. ' </p>
          <a href="logout.php" class="btn btn-danger ml-2">Logout</a>
          </form>';
    }
    else{ 
      echo '
      <form class="form-inline my-2 my-lg-0">
         <button type="button" class="btn btn-success  mx-1" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
        <button type="button" class="btn btn-success  " data-bs-toggle="modal" data-bs-target="#signupmodal">Signup</button>
        </form>';
      }
      
      
      
      echo '</div>
      </div>
      </nav>
      ';
     
      include 'login.php';
      include 'signup.php';
 


?>