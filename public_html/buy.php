<?php
    
    // configuration
    require("../includes/config.php");
    
    // check for stock symbol
    if (isset($_POST["ask"]))
    {
        $stock = $_POST;
        render("buy_form.php", ["title" => "Buy Stock", "stock" => $stock]);
    }   

    
    if (isset($_POST["buy"]))
    {
        if (preg_match("/^\d+$/", $_POST["shares"]) != true)
        {
            apologize("You must enter a non-negative whole number of shares.");
        }
        $row = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash = $row[0]['cash'];
        $cost = $_POST['shares']*$_POST['price'];
        
        if ($cash < $cost)
        {
            apologize("You do not have enough money to complete this transaction.");
        }
        query("UPDATE users SET cash = cash - ? WHERE id =?", $cost, $_SESSION['id']);
        query("INSERT INTO portfolio (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION['id'], $_POST['symbol'], $_POST['shares']);
        
        // insert new row into history database
        query("INSERT history (id,buysell,symbol,shares,price) VALUES(?,'BUY',?,?,?)", $_SESSION['id'],$_POST['symbol'],$_POST['shares'],$_POST['price']);
        
        redirect("index.php");
    }
    
    
    else if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        apologize("Please enter a stock to buy from the look up page.");
    }
    
    
?>
