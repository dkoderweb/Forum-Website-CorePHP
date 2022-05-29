 <!-- Modal -->
<?php
include 'connect.php';
$showalert = false ; 
$showerror = false; 
if(isset($_POST['submit'])){
    $user_email=$_POST['signupemail'];
    $password =$_POST['signuppassword'];
    $cpassword = $_POST['signupcpassword'];

    $existSql = "select * from `users` where user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $row = mysqli_num_rows($result);
     if($row > 0){
      $showerror = "User Emailid  already exist.";
     }
     else{
         if($password == $cpassword){
            //  $sql = "INSERT INTO `users`(`Sr.no`, `user_email`, `user_password`, `user_date_time`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')"
            $has = password_hash($password , PASSWORD_DEFAULT);
             $loginsql = "INSERT INTO `users`(  `user_email`, `user_password` ) VALUES ( '$user_email','$has' )";
             $result = mysqli_query($conn, $loginsql);
             if($result){
                 $showalert = true; 
                 
             }
            }
            else{
               $showerror = "Password do not match";
            }

     }
    }
?>
<?php  if($showerror){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Alert!</strong> '.$showerror.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success!</strong>You can now login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
?>

 <div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="signupmodalLabel">Signup for D-Forum</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="post">
                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">Username</label>
                         <input type="text" class="form-control" autocomplete="off" id="signupemail" name="signupemail" aria-describedby="emailHelp">
                     </div>
                     <div class="mb-3">
                         <label for="exampleInputPassword1" class="form-label">Password</label>
                         <input type="password" class="form-control" id="signuppassword" name="signuppassword">
                     </div>
                     <div class="mb-3">
                         <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                         <input type="password" class="form-control" id="signupcpassword" name="signupcpassword">
                         <div id="emailHelp" class="form-text">Make sure you enter same password.</div>

                     </div>
                      
                     </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Signup</button>
                    </form>
             </div>
         </div>
     </div>
 </div>