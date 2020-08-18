<?php
  //require 'required/functions.php';

  try {
    $pdo = new PDO('mysql:host=localhost;dbname=matcha', 'root', '0780307349');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $pdo->prepare('SELECT COUNT(*) FROM users WHERE mail = :mail AND state = :hash');
    $sth->bindParam(':mail', $_GET[mail], PDO::PARAM_STR);
    $sth->bindParam(':hash', $_GET[hash], PDO::PARAM_STR);
    $sth->execute();
} catch (PDOException $e) {
    echo 'Error: '.$e->getMessage();
    exit;
}
if ($sth->fetchColumn()) {
    try {
      $sth = $pdo->prepare("UPDATE users SET state = 'active' WHERE mail = :mail AND state = :hash");
      $sth->bindParam(':mail', $_GET[mail], PDO::PARAM_STR);
      $sth->bindParam(':hash', $_GET[hash], PDO::PARAM_STR);
      $sth->execute();
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        exit;
    }
    header("Location: index.php?err=Your account is now activated. You can connect.\n");
    //put_flash('success', "Success : Account Activated login.", "login.php");
} else {
    header("Location: index.php?err=Error.\n");
    //put_flash('success', "Success :  login", "index.php");
}
