<?php
	require("../includes/config.php");
	
	if ($_SERVER['REQUEST_METHOD']=='GET')
	{
		// Check Hash to see if it is correct
		if (empty($_GET['reset']))
		{
			apologize("You must reset your password using the forgot password form.");
		}
		
		$resetcode = $_GET['reset'];
		$query = query("SELECT username, reset FROM users WHERE reset = ?", $resetcode);
		
		if (empty($query))
		{
			apologize("An error occurred. Please make sure you entered the address correctly.");
		}
		
		$username = $query[0]['username'];
		render("reset_form.php",["title" => "Reset Your Password", "username" => $username]);
	}	
	
	else if ($_SERVER['REQUEST_METHOD']=='POST')
	{
		if (empty($_POST["password"]))
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
		
		query("UPDATE users SET hash = ?, reset = '' WHERE username = ?", crypt($_POST["password"],'asd8&33jf?$$fskcx'), $_POST['username']);
		$rows = query("SELECT id FROM users WHERE username = ?", $_POST['username']);
		$id = $rows[0]["id"];
		
		// log in and congratulate user
        $_SESSION["id"] = $id;
		
		render("reset_done.php", ["title" => "Success!"]);
	}



?>