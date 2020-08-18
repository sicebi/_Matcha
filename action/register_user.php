<?php
	
	if (session_status() == PHP_SESSION_NONE) { session_start(); }
	require '../required/functions.php';
	iConnected();

	if (empty($_POST) || isset($_SESSION['auth']))
		put_flash('danger', "Error : You cannot acces this page.", '../index.php');

	$username = $_POST['username'];
	$email = $_POST['email'];
	$psw = $_POST['password'];
	$pswr = $_POST['passwordr'];
	$state = "NULL";

	//verif username
	if (empty($username) || !preg_match('/^[a-zA-Z0-9]+$/', $username) || strlen($username) > 20)
		put_flash('danger', "Error : Invalid username.", "../register.php");

	//verif passwords
	if ($psw !== $pswr || strlen($psw) > 20)
		put_flash('danger', "Error : Invalid password", "../register.php");

	//Is user or mail
	require_once '../required/database.php';
	$req = $pdo->prepare('SELECT username FROM users WHERE username = ?');
	$req->execute([$username]);
	$usernameExi = $req->fetch();

	if ($usernameExi)
		put_flash('danger', "Error : Username already taken.", "../register.php");

	$req = $pdo->prepare('SELECT mail FROM users WHERE mail = ?');
	$req->execute([$email]);
	$emailExi = $req->fetch();

	if ($emailExi)
		put_flash('danger', "Error : Email already taken.", "../register.php");

	//register the user
	$password = password_hash($psw, PASSWORD_BCRYPT);
	$hash = md5(rand(0, 1000));

	$req = $pdo->prepare('INSERT INTO users SET username = ?, mail = ?, password = ?, state = ?');
	
	if ($req->execute([$username, $email, $password, $hash]))
	{
		$to = $email;
 		$subject = 'Matcha | Register';
  		$message = "Your account has been created, you can login with the following login after activating your account.

  					------------------------
  					username: '$username'
  					------------------------

  					Click on the following link to activate your account
  					http://localhost:80/_Matcha/verify.php?mail=$email&hash=$hash";

  		$headers = 'From:antini@student'."\r\n";
  		mail($to, $subject, $message, $headers);
		put_flash('success', "Success : Account created, please Activate using Link sent on your mail and login.", "../login.php");
	}	
	else
		put_flash('danger', "Error : Can't register user.", "../register.php")
		


?>