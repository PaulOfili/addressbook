
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Client Address Book</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
    <body >
        <nav class='navbar navbar-inverse navbar-fixed-top'>
        <div class='container-fluid'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href=''>CLIENT<strong>MANAGER</strong></a>
            </div>
            
            
            <div class='collapse navbar-collapse' id='navbar-collapse'>
                
                <?php 
                if ($_SESSION['logged_name']){ 
                ?>
                
                <ul class='nav navbar-nav'>
                    <li><a href = 'client.php'>My Clients</a></li>
                    <li><a href = 'add.php'>Add Clients</a></li>
                    
                </ul>
                <ul class='nav navbar-nav navbar-right'>
                    <li class='active'><a href = ''>Aloha <?php echo $_SESSION['logged_name']?></a></li>
                    <li><a href = 'logout.php'>Log out</a></li>
                    
                </ul>
            
            <?php  
                } else { 
            ?>
                <ul class='nav navbar-nav navbar-right'>
                    <li class = 'active'><a href = 'index.php'>Log in</a></li>
            
                </ul>
                
             <?php
                        } 
             ?>
                
            </div>                   
        </div>
      </nav>
	  
	  <div id ="main" class = "container">