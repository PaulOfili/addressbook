<?php 
    session_start();
 
   
        // check if logged in or not
    if(!$_SESSION['logged_name']){
        //if not, send back to homepage
        header("Location:index.php");
    }
    
    //connect to database
    include('includes/connection.php');

    //set query
    $query = "SELECT * FROM clients WHERE user_id = {$_SESSION['logged_id']} ";
   

    //get the result
    $result = mysqli_query($conn, $query);

    //close connection
    mysqli_close($conn);

    include('includes/navbar.php'); 

   
?>
       
        <h1>Client Address Book</h1>
        
            <?php echo $_SESSION['alert']; ?>
            
        
            <table class = "table table-striped table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Company</th>
                    <th>Notes</th>
                    <th>Edit</th>
                </tr>
                
                <?php 
                //check for data
                 if(mysqli_num_rows($result) > 0){
                    // input data into variables
                    while ($rows = mysqli_fetch_assoc($result)) {
                      echo 
                "<tr>
                    <td>".$rows['username']."</td>
                    <td>".$rows['email']."</td>
                    <td>".$rows['phone']."</td>
                    <td>".$rows['address']."</td>
                    <td>".$rows['company']."</td>
                    <td>".$rows['notes']."</td>
                    <td><a href = 'edit.php?id=".$rows['id']."'  type = 'button' class = 'btn btn-primary btn-sm'><span class = 'glyphicon glyphicon-edit'></span></a></td>
                                  
                </tr>";                       
                    }
                     
                
                     
                    } else {
                     echo "<div class = 'alert alert-warning'>You have no clients, fool.</div>";
                 }  ?>
                
                
                <tr>
                   <td colspan="7" class = "text-center"><a href = 'add.php' type = 'button' class = 'btn btn-success btn-sm'><span class = 'glyphicon glyphicon-plus'></span> Add Client </a></td>         
                </tr>
                
             </table>
        </div>
        
        <?php  include ('includes/footer.php'); ?>
      
      