<?php 
session_start();

if ( !$_SESSION['logged_name']){
    header('Location: index.php');
}

include("includes/connection.php");

include("includes/function.php");



if( isset ($_POST['add'] ) ){
   
    // set variables to null if any
    $client_name = $client_email= $client_phone = $client_address = $client_company = $client_notes = "";
    
    if (!$_POST['client_name']){
        $name_err = "Please enter a name <br>";
    } else {
        $client_name = validate($_POST['client_name']);
    }
    
    if (!$_POST['client_email']){
        $email_err = "Please enter an email  <br>";
    } else {
        $client_email = validate($_POST['client_email']);
    }
    
    $client_user = $_SESSION['logged_id'];
    $client_phone = validate($_POST['client_phone']);
    $client_address = validate($_POST['client_address']);
    $client_company = validate($_POST['client_company']);
    $client_notes = validate($_POST['client_notes']);
    
    //if both required fields are filled
    if ($client_name && $client_email){
        //start the query
        $query = "INSERT INTO clients (id, user_id, username, email, phone,address, company, notes, date_added)  VALUES (NULL, '$client_user', '$client_name', '$client_email', '$client_phone', '$client_address', '$client_company', '$client_notes', CURRENT_TIMESTAMP)";
        
        $result = mysqli_query($conn, $query);
        
        //check if successful
        if ($result){
            
            //head to client page
            header('Location: client.php');
            
            $_SESSION['alert'] = "<div class = 'alert alert-success'> New entry confirmed <a class = 'close' data-dismiss = 'alert'> &times; </a> </div>";
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conn);      
        }
    }
}

// close connection
mysqli_close($conn);

include("includes/navbar.php");
    
?>
    
    <h1>Add Clients</h1>
    <form class = "row" method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class = "form-group col-sm-6">
            <label for = "name">Name *</label> 
            <input type = "text" id = "name" class = "form-control input-lg" name = "client_name">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "email">Email *</label>
            <input type = "text" id = "email" class = "form-control input-lg" name = "client_email">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "phone">Phone</label>
            <input type = "text" id = "phone" class = "form-control input-lg" name = "client_phone">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "address">Address</label>
            <input type = "tel" id = "address" class = "form-control input-lg" name = "client_address">
        </div>
        <div class = "form-group col-sm-6">
            <label for = "company">Company</label>
            <input type = "text" id = "company" class = "form-control input-lg" name = "client_company">            
        </div>
        <div class = "form-group col-sm-6">
            <label for = "notes">Notes</label>
            <textarea id = "notes" class = "form-control" name = "client_notes"></textarea>
        </div>
        
        <div class = "form-group col-sm-12">
            <hr>
            
            <a class = "btn btn-lg btn-default" href = "client.php">Cancel</a>
            <button class = "btn btn-success btn-lg pull-right" type = "submit" name = "add">Add Client</button>
            
        </div>
        
    </form>

</div>

<?php 
include("includes/footer.php");
?>