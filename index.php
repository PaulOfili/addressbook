<?php 
	session_start();
    
    if (isset ($_POST['login'])){
        //get the necessary variables and edit
       
        include('includes/function.php');
        
        $input_email = validate( $_POST['email']);
        $input_password = validate($_POST['password']);
        
        //connect to the database
        include("includes/connection.php");
        
        //get the query
        $query = "SELECT * FROM users WHERE email= '$input_email'";
        
        //set the result
        $result = mysqli_query($conn, $query);
        
        //check if empty and get the results and assign new variables
        if (mysqli_num_rows($result) > 0){
            
          while($rows= mysqli_fetch_assoc($result)){
                
                $data_id = $rows["id"];
                $data_email = $rows["email"];
                $data_password = $rows["password"];
                $data_name = $rows["username"];
            }
            
            //check if password matches
            if ( password_verify($input_password, $data_password))
            
            {
             $_SESSION['logged_id']=$data_id;
             $_SESSION['logged_name']=$data_name;
             $_SESSION['logged_email']=$data_email;
                
            header("Location: client.php");
                
            } 
            else {
                $error = "<div class='alert alert-danger'>Wrong Password. Try again. </div>";
            }
        } else {
           $error = "<div class = 'alert alert-danger'>No such user in this database. Try again. <a class = 'close' data-dismiss = 'alert'> &times; </a></div>";
        }
        
            
		mysqli_close($conn); 
	}
	include ('includes/navbar.php');
    
?>
      
   
    <h1>Client Address Book</h1>

    <p class= "lead">Log in to your account </p>
      <?php echo $_SESSION['new_user']; ?>
      <?php  echo $error; ?>
      <?php echo $_SESSION['alert']; ?>
      <form class = "form-inline" method = "post" action = "<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>" >
          
        <div class = "form-group">
          <label class = "sr-only">Yaa email Address</label>
          <input type = "text" class = "form-control" placeholder = "email" name = "email" value = "<?php echo $input_email;  ?>" >
        </div>

        <div class = "form-group">
          <label class = "sr-only">Your password</label>
          <input type = "password" class = "form-control" placeholder = "password" name = "password" >
        </div>
              
        <button type = "submit" name = 'login' class = "btn btn-primary">Login</button>
        <br><br>
        <span> Don't have an account with us? &nbsp;</span>
        <a type = "button" href = "add_user.php" class = "btn btn-success">Create Account</a>
    
      </form>
      
      <!--form ends-->
       
      </div>   
         
    
    <?php include('includes/footer.php'); ?>
          <!--footer ends-->
	
	

    