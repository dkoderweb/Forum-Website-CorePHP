 <?php
 include 'connect.php';
 $showalert = false ; 
 $showerror = false; 
 if(isset($_POST['login'])){
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpassword'];

     $sql = "SELECT * FROM `users` WHERE `user_email` = '$email'";
     $result =mysqli_query($conn, $sql);
     $num = mysqli_num_rows($result);
     if($num == 1){
          $row = mysqli_fetch_assoc($result);
             if(password_verify($pass, $row['user_password'])){
                 $showalert = true;
                 session_start();
                 $_SESSION['loggedin'] = true;
                 $_SESSION['sno'] = $row['sno'];
               
                 $_SESSION['user_email'] = $email;
                 header('location:/projects/forum/?loggedin=true');
               }
             else{
                 $showerror = "Check your password and try again";
             
         }
         }
         else{
            $showerror = "your emailid not exist ";
        }
     }

 
 ?>
 <?php
 if($showerror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Alert!</strong> '.$showerror.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if($showalert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>success!</strong>You are loggged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
 ?>
 <!-- Modal -->
 <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="loginmodalLabel">Login to D-Forum</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="post">
                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">Username</label>
                         <input type="text" class="form-control" autocomplete="off" id="loginemail" name="loginemail"
                             aria-describedby="emailHelp">
                     </div>
                     <div class="mb-3">
                         <label for="exampleInputPassword1" class="form-label">Password</label>
                         <input type="password" class="form-control" id="loginpassword" name="loginpassword">

                     </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" name="login" class="btn btn-primary">Login</button>
                 </form>
             </div>
         </div>
     </div>
 </div>