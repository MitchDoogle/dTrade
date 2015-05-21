<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
        // check all fields are correct
        if (empty($_POST["username"]))
        {
            apologize("You must provide a username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide a password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("Please confirm your password.");
        }   
        else if ($_POST["password"] !== $_POST["confirmation"])
        {
            apologize("Your passwords do not match.");
        }
        else if (!empty($_POST["email"]))
        {
            if (strpos($_POST['email'],"@") === false)
            {
            apologize("You did not enter a valid e-mail address.");
            }
        }
        
        // insert new user into database
        if (!empty($_POST["email"]))
        {
            $rows = query("INSERT INTO users (username, email, hash, cash) VALUES(?, ?, ?, 10000.00)", $_POST["username"], $_POST["email"], crypt($_POST["password"],'dfji8d7df3$sf0'));
        }
        else
        {
            $rows = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"],'dfji8d7df3$sf0'));
        }

        if ($rows === false)
        {
            apologize("There is already an account associated with that username or e-mail.");
        }
        
        // check users id
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        // send an email confirming registration if one has been input
        if(!empty($_POST["email"]))
        {
            $email     = $_POST["email"];
            $user      = $_POST['username'];
            $subject   = "*dTrade* registration";
            $message   = "You have been registered to *dTrade* with the username " . $user;
            $headers   = array();
            $headers[] = "From: dTrade <no-reply@dtrade.douglasmitchell.net>";

            mail($email, $subject, $message, implode("\r\n", $headers));
        }
        
        $_SESSION["id"] = $id;
        
        redirect("/");
        
    }
    
?>
