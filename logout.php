<?php 
    

    if( isset ( $_COOKIE[ session_name()])){
        
        setcookie( session_name(), '', time()-86400, '/' );
    }

    session_unset();

    // session_destroy();
    
    include('includes/navbar.php');
    
?>

            <h1>Logged out</h1>
            <p class="lead">You've been logged out. See you next time.</p>
        </div>
        
<?php 
    include('includes/footer.php');
?>
    
      