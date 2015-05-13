<?php

    // configuration file
    require("../includes/config.php");
    
    $title = "Stock Lookup";
    
    // render lookup form
    require("../templates/header.php");
    
    require("../templates/lookup_form.php");
      
    // check if symbol exists and display a table with the information
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["symbol"]))
        {
            echo("Please enter a symbol");
            exit;
        }
        
        // fetch stock and check for errors
        $stock = lookup($_POST["symbol"]);
        
        if($stock === false)
        {
            echo("An error has occurred. Try a different symbol.");
            exit;
        }
        
        // else show the table with stock information
        require("../templates/stock_table.php");
      
    }  
    
    require("../templates/footer.php");    
?>
