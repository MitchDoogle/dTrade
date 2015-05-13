<?php
    
    // configuration
    require("../includes/config.php");
    
    // show table to verify selling
    if (isset($_POST["ask"]))
    {
        $stock = $_POST;
        render("sell_form.php", ["title" => "Sell", "stock" => $stock]);
    }   
    
    // complete sale after verification
    if (isset($_POST["sell"]))
    {
        // check if share number is whole integer
        if (preg_match("/^\d+$/", $_POST["shares"]) != true)
        {
            apologize("You must enter a non-negative whole number of shares.");
        }
        
        $row = query("SELECT shares FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST['symbol']);
        $cshares = $row[0]['shares'];
        $rev = $_POST['shares']*$_POST['price'];
        
        // check the number of current shares(cshares) against shares selected to sell 
        // and return an apology if too many shares were selected. Else, update the 
        // database to reflect sale.
        
        if ($cshares < $_POST['shares'])
        {
            apologize("You do not have the number of shares specified. Please enter a number less than ".$cshares.".");
        }
        else if ($cshares == $_POST['shares'])
        {
            query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        }
        else if ($cshares > $_POST['shares'])
        {
            query("UPDATE portfolio SET shares = shares - ? WHERE id =? AND symbol =?", $_POST['shares'], $_SESSION['id'], $_POST['symbol']);
        }
        
        query("UPDATE users SET cash = cash + ? WHERE id =?", $rev, $_SESSION["id"]);
        
        // insert new entry to history
        query("INSERT history (id,buysell,symbol,shares,price) VALUES(?,'SELL',?,?,?)", $_SESSION['id'],$_POST['symbol'],$_POST['shares'],$_POST['price']);
        redirect("index.php");
    }
    else if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        apologize("Please select a stock to sell from your portfolio");
    }
    
    
?>
