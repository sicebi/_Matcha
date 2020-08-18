<?php require 'header.php'; require 'required/functions.php'; iConnected(); ?>

<div class="login">
    <div class="container">
        <center><h1 style="font-size: 4vw;">Reset Password</h1></center>
        <form action="action/reset_user.php" method="POST">
            <div class="form-group">
                <label for="username" style="font-size: 2vw;">Username :</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Please enter Username ..." required>
            </div>
            <div class="form-group">
				<center><button class="btn btn-primary" type="submit">Reset</button></center>
            </div>
        </form>
    </div>
</div>