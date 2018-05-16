<?php 
session_start();

if ( !$_SESSION['logged_name']){
    
    header('Location: index.php');
}

include("includes/connection.php");

include("includes/function.php");

//get id for particular client
$client_id = $_GET['id'];

//set query for that id/client
$query = "SELECT * FROM clients WHERE id = '$client_id'";

//Store it in result
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0 ){
    
    while($rows = mysqli_fetch_assoc($result)){
        $client_name = $rows['username'];
        $client_email = $rows['email'];
        $client_phone = $rows['phone'];
        $client_address = $rows['address'];
        $client_company = $rows['company'];
        $client_notes = $rows['notes'];
    }
}else {
    $err = "<div class = 'alert alert-warning'>Nothing to see here. <a href = 'client.php'>Head back</a></div>";
}

if (isset ($_POST['update'])){
      $client_name = validate($_POST['client_name']);
      $client_email = validate($_POST['client_email']);
      $client_phone = validate($_POST['client_phone']);
      $client_address = validate($_POST['client_address']);
      $client_company = validate($_POST['client_company']);
      $client_notes = validate($_POST['client_notes']);
    
    
    
    // set new query and new result
    $query = "UPDATE clients
            SET username = '$client_name',
                email = '$client_email',
                phone = '$client_phone',
                address = '$client_address',
                company = '$client_company',
                notes = '$client_notes'
            WHERE id='$client_id'";
    
    $result = mysqli_query($conn, $query);
        
     if($result)  {
         //if result is successful
          $_SESSION['alert'] = "<div class = 'alert alert-success'> Update confirmed <a class = 'close' data-dismiss = 'alert'> &times; </a> </div>";
         
         header("Location:client.php");
        
     } else  {
         echo "Error updatng record : ". mysqli_error($conn);
     }
}

if ( isset ($_POST['delete'])){
    
    $alert="<div class = 'alert alert-danger'>
                <p>Are you sure you wanna delete? </p><br>
                <form action = '". htmlspecialchars($_SERVER['PHP_SELF']) . " ?id=" .$client_id . "' method = 'post'>
                    <button type = 'submit' class = 'btn btn-danger btn-sm' name = 'confirm_delete' >Yes, delete</button>
                    <button type='button' class='btn btn-default btn-sm' data-dismiss='alert' >No, cancel</button>
                
                </form>
            </div>";
 

 }
if (isset ($_POST['confirm_delete'])){
    
    $query = "DELETE FROM clients WHERE id = '$client_id'";
    
    $result = mysqli_query($conn,$query);
    
    if ($result){
         $_SESSION['alert'] = "<div class = 'alert alert-success'> Delete confirmed <a class = 'close' data-dismiss = 'alert'> &times; </a> </div>";
        
        header("Location: client.php");
    } else  {
         echo "Error updatng record : ". mysqli_error($conn);
     }  
   }


mysqli_close($conn);

include("includes/navbar.php");
    
?>

    
    <h1>Edit Clients</h1>
    <?php echo $alert; ?>
    <form class = "row" method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $client_id ?>">
       
        <div class = "form-group col-sm-6">
            <label for = "name">Name</label> 
            <input type = "text" id = "name" class = "form-control input-lg" name = "client_name" value="<?php echo $client_name; ?>">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "email">Email</label>
            <input type = "text" id = "email" class = "form-control input-lg" name = "client_email" value= "<?php echo $client_email; ?>">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "phone">Phone</label>
            <input type = "text" id = "phone" class = "form-control input-lg" name = "client_phone" value="<?php echo $client_phone; ?>">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "address">Address</label>
            <input type = "tel" id = "address" class = "form-control input-lg" name = "client_address" value="<?php echo $client_address; ?>">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "company">Company</label>
            <input type = "text" id = "company" class = "form-control input-lg" name = "client_company" value = "<?php echo $client_company; ?>">            
        </div>
        <div class = "form-group col-sm-6">
            <label for = "notes">Notes</label>
            <textarea type = "text" id = "notes" class = "form-control input-lg" name = "client_notes"> <?php echo $client_notes; ?> </textarea>
        </div>
       
            
        <div class = "form-group col-sm-12">
            <hr>
            
            <button type = "submit" class = "btn btn-lg btn-danger" name = "delete">Delete</button>
            
            <div class = "pull-right">
                <a class = "btn btn-lg btn-default" href = "client.php">Cancel</a>
                <button class = "btn btn-success btn-lg" type = "submit" name = "update">Update</button>
            </div>
            
        </div>
        
    </form>

</div>

<?php 
include("includes/footer.php");
?>