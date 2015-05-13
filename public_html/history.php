<?php
    // configuration
    require("../includes/config.php"); 
    $title="History";
    require("../templates/header.php");
    
    // get history information from database
    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION['id']);
    
    if ($rows == null)
    {
        print("You have no history to display.");
        exit;
    }
    // start table
    require("../templates/history_table_header.php");
    
    // display each row of history
    foreach($rows as $row)
    {
        $time = $row['time'];
        $buysell = $row['buysell'];
        $symbol = $row['symbol'];
        $shares = $row['shares'];
        $price = number_format($row['price'],2,'.',',');
        $total = number_format($price*$shares,2,'.',',');
    
        require("../templates/history_table.php");
    }
    
    require("../templates/history_table_footer.php");
    require("../templates/footer.php");
?>
