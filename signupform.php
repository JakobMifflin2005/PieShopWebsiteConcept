<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Form</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    </head>
    <body class="w3-blue">
        <div class="w3-container w3-card w3-sand w3-padding-32 w3-border w3-border-brown w3-round-large" style="max-width: 500px; margin: auto; margin-top: 50px;">
        <h2 class="w3-center">Sign Up!</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>";?>
        <form class="w3-container" action="signup.php" method="post">
            <label for="name">Username*</label>
            <input type="text" class="w3-input w3-border w3-round w3-light-grey w3-margin-bottom" id ="name" name="name" required>
            <label for="password">Password*</label>
            <input type ="password" class="w3-input w3-password w3-border w3-round w3-light-grey w3-margin-bottom"  id ="password" name="password" required>

            <label for="confirm">Confirm Password</label>
            <input class="w3-input w3-border w3-round w3-light-grey w3-margin-bottom" type="password" id="confirm" name="confirm">
            <br>
            <p class="w3-margin-bottom">Already a user? Login <a href="loginform.php" target="_blank">here</a></p>
            <input class="w3-button w3-green w3-round w3-block w3-hover-brown w3-margin-top" type="submit" value="Sign Up">
        </form>

    </body>