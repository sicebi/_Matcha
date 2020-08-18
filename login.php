<?php require 'header.php'; require 'required/functions.php'; iConnected(); ?>
<div class="login">
    <div class="container">
        <center><h1 style="font-family: Gabriola; font-style: italic; font-size: 4vw">Login</h1></center>
        <form action="action/login_user.php" method="POST">
            <div class="form-group">
                <label for="username" style="font-family: Gabriola; font-style: italic; font-size: 2vw">Username :</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Please enter Username ..." required>
            </div>
            <div class="form-group">
                <label for="psw" style="font-family: Gabriola; font-style: italic; font-size: 2vw">Password :</label>
                <input type="password" class="form-control" name="password" id="psw" placeholder="Please enter Password ..." required>
            </div>
            <div class="form-group">
                <center><input type="submit" class="btn btn-primary" name="btn" value="Login"> <a href="reset.php" style="color: blue">Forgot password ?</a></center>
            </div>
        </form>
    </div>
</div>