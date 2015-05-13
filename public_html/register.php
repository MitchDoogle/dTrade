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
        $rows = query("INSERT INTO users (username, email, hash, cash) VALUES(?, ?, ?, 10000.00)", $_POST["username"], $_POST["email"], crypt($_POST["password"],'dfji8d7df3$sf0'));
        
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
            $headers[] = "From: dTrade <no-reply@nanidoko.com>";

            mail($email, $subject, $message, implode("\r\n", $headers));
        }
        // from https://manual.cs50.net/mail/
        // TODO switch this to a function-
       /* require_once("libphp-phpmailer/class.phpmailer.php");
        
            $email     = $_POST["email"];
            $user      = $_POST['username'];
            $subject   = "*dTrade* registration";
            $message   = "You have been registered to *dTrade* with the username " . $user;
            
            // instantiate mailer
            $mail = new PHPMailer();

            // use your ISP's SMTP server (e.g., smtp.fas.harvard.edu if on campus or smtp.comcast.net if off campus and your ISP is Comcast)
            $mail->IsSMTP();
            $mail->Host = "smtp.spmode.ne.jp"; // docomo smtp.spmode.ne.jp home mail.asahi-net.or.jp

            // set From:
            $mail->SetFrom("no-reply@dtrade.com");

            // set To:
            $mail->AddAddress($email);

            // set Subject:
            $mail->Subject = $subject;

            // set body
            $mail->Body = $message;

            // send mail
            if ($mail->Send() === false)
                die($mail->ErrorInfo . "\n");*/
                    
        // log in and redirect to index.php
        $_SESSION["id"] = $id;
        
        redirect("/");
        
    }
    
?>
