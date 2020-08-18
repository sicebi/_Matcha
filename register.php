<?php require 'header.php'; require 'required/functions.php'; iConnected(); ?>

<div class="login">
    <div class="container">
        <center><h1 style="font-size: 4vw;">Register</h1></center>
        <form action="action/register_user.php" method="POST">
            <div class="form-group">
                <label for="username" style="font-size: 2vw;">Username :</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Please enter Username ..." required>
            </div>
            <div class="form-group">
                <label for="Email" style="font-size: 2vw;">Email :</label>
                <input type="email" class="form-control" name="email" id="Email" placeholder="Please enter Email ..." required>
            </div>
            <div class="form-group">
                <label for="psw" style="font-size: 2vw;">Password :</label>
                <input type="password" class="form-control" name="password" id="psw" placeholder="Please enter Password ..." required>
            </div>
            <div class="form-group">
                <label for="pswr" style="font-size: 2vw;">Confirm Password :</label>
                <input type="password" class="form-control" name="passwordr" id="pswr" placeholder="Please confirm Password ..." required>
            </div>
            <div class="form-group">
                <center><input type="submit" class="btn btn-primary" name="btn" value="Register"></center>
            </div>
        </form>
    </div>
</div>