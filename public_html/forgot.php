<?php

	// configuration
	require("../includes/config.php");
	
	// if user has clicked the forgot link (GET)
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		render("forgot_form.php", ["title" => "Forgot Password"]);
	}
	
	// if user has submitted the forgot password form
	else if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (empty($_POST['email']))
		{
			apologize("Please enter an e-mail address.");
		}
		
		// query to check if email is in database
		$row = query("SELECT username, email FROM users WHERE email = ?", $_POST['email']);
		if(empty($row[0]['email']))
		{
					apologize("That e-mail is not registered to any account.");
		}
		
		$email = $row[0]['email'];
		$username = $row[0]['username'];
		
		// create unique hash
		$resethash = md5($username.time());
		
		// insert hash into SQL table users
		query("UPDATE users SET reset = ? WHERE email = ?", $resethash, $email);
		
		// generate e-mail with reset hash
		$reseturl = $_SERVER['HTTP_HOST']."/reset.php?reset=".$resethash;
		$message  = "Your username is  ".$username.".\n\r"."Please visit the following url to reset your dTrade password"."\n\r".$reseturl."\n\r";
		$subject  = "dTrade Password Reset";
		$header   = "From: no-reply@dtrade.douglasmitchell.net\n\r";
		mail($email, $subject, $message, $header);
		
		// Display message to check e-mail
		render("forgot_done.php");	
	}		
?>