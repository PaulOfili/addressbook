<?php 
session_start();

include("includes/connection.php");

include("includes/function.php");



if( isset ($_POST['add'] ) ){
   
    // set variables to null if any
    $user_name = $user_email = $user_password = $confirm_password = "";
    
    if (!$_POST['user_name']){
        $name_err = "<div class = 'alert alert-danger'>Please enter a username</div>";
    } else {
        $user_name = validate($_POST['user_name']);
    }
    
    if (!$_POST['user_email']){
        $email_err = "<div class = 'alert alert-danger'>Please enter an email</div>";
    } else {
        $user_email = validate($_POST['user_email']);
    }
    
    if (!$_POST['user_password']){
        $password_err = "<div class = 'alert alert-danger'>Please enter a password, advisable a strong one with alphanumeric characters </div>";
    } else {
    $user_password = validate($_POST['user_password']);   
    }
    
    if (!$_POST['confirm_password']){
        $confirm_err = "<div class = 'alert alert-danger'>Please confirm password, advisably a strong one with alphanumeric characters</div>";
    } else {
    $confirm_password = validate($_POST['confirm_password']); 
    }
   
   //if all required fields are filled
    if ($user_name && $user_email && $user_password) {
         
    // if password is confirmed
    if ($confirm_password == $user_password){
         $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        //start the query
        $query = "INSERT INTO users (id, username, email, password, date_added)  VALUES (NULL, '$user_name', '$user_email', '$user_password',  CURRENT_TIMESTAMP)";
        
        $result = mysqli_query($conn, $query);
        
        //check if successful
        if ($result){
            
            //head to index page
            header('Location: index.php');
            
            $_SESSION['new_user'] = "<div class = 'alert alert-success'> New User confirmed. Enter email address and password to login <a class = 'close' data-dismiss = 'alert'> &times; </a> </div>";
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conn);      
        }
     
    }  else {
        $error = "<div class = 'alert alert-danger'> Password mismatch. Try again. <a class = 'close' data-dismiss = 'alert'> &times; </a></div>";
    } 
        
   } else {
        $error = "<div class = 'alert alert-danger'> Fill in all fields please. <a class = 'close' data-dismiss = 'alert'> &times; </a></div>";
}
}
// close connection
mysqli_close($conn);

include("includes/navbar.php");
    
?>
    
    <h1>Add Clients</h1>
    <?php  echo $error; ?>
    <form class = "form" method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class = "form-group"><?php echo $name_err ?>
            <label for = "user_name">Username </label> 
            <input type = "text" id = "user_name" class = "form-control input-lg" name = "user_name" value = "<?php echo $user_name ;?>">
        </div>
        <div class = "form-group"><?php echo $email_err ?>
            <label for = "user_email">Email </label>
            <input type = "text" id = "user_email" class = "form-control input-lg" name = "user_email" value = "<?php echo $user_email; ?>">
        </div>
        <div class = "form-group"><?php echo $password_err ?>
            <label for = "user_password">Password</label>
            <input type = "password" id = "user_password" class = "form-control input-lg" name = "user_password" value = "<?php echo $user_password ;?>">
        </div>
        <div class = "form-group "><?php echo $confirm_err ?>
            <label for = "confirm_password">Confirm Password</label>
            <input type = "password" id = "confirm_password" class = "form-control input-lg" name = "confirm_password">
        </div>
        <div class = "form-group col-sm-12">
            <hr>
            
        <a class = "btn btn-lg btn-default" href = "index.php">Cancel</a>
        <button class = "btn btn-success btn-lg pull-right" type = "submit" name = "add">Add User</button>
            
        </div>
        
    </form>

</div>

<?php 
include("includes/footer.php");
?>