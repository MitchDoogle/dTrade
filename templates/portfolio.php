<?php

    // find any stock the user has in the SQL database
    $rows = query("SELECT * FROM portfolio WHERE id = ". $_SESSION["id"]);
    $user = query("SELECT * FROM `users` WHERE id = ". $_SESSION["id"]);
    $username = $user[0]["username"];
    $cash = $user[0]["cash"];

    require("ptable_header.php");
    
    // assign variables to each stock for symbol, shares, and purchase price
    $total = number_format(0.00,2,'.','');
    foreach ($rows as $row)
    {
        $symbol = $row["symbol"];
        $shares = $row["shares"];
        
    // lookup current stock information
    
        $stock = lookup($symbol);
    
    // assign variables for company name, current price, and profit
    
        $company = $stock["name"];
        $cprice = number_format($stock["price"], 2,'.','');
        $value = number_format($cprice * $shares,2,'.','');
        
    // print a table showing the variables for each stock
        require("portfolio_table.php");
        
        $total += ($shares*$cprice);
    }
    
    // print cash on hand and total value of all holdings
    require("ptable_footer.php");
?>
