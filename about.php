<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset ($_SESSION["user"]))
{
    header("Location: index.php");
}
?>
<head>
    <title>Drozdowsky Pie</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    
    <style>
    body {
        font-family: 'Poppins', sans-serif;

    }
    h3 {
        font-size: 24px; /* Adjust based on preference */
        font-weight: bold;
    }
    p {
        font-size: 18px;
        line-height: 1.6; /* Improves readability */
    }
    ol, ul {
        font-size: 18px;
        line-height: 1.6; /* Improves readability */
    }
    .jeremy {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        background-color: #795548; /* Brownish theme */
    }
    .jeremy li {
        padding: 10px 20px;
    }
    .jeremy a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }
    img {
        display: block;
        margin: auto;
        
    }
</style>

</head>
<header class="w3-container w3-amber w3-padding-8px w3-center">
        <h1  class="w3-xxlarge">Welcome to Drozdowsky's Pie Shop</h1>
        
    </header>
    <nav class ="w3-padding">
        <ul class = "jeremy">
  <li><a href="main.php">Home</a></li>
  <li><a href="shoppingcart.php">Order</a></li>
  <li><a href="news.php">News</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="editview.php">User Info</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
        </nav>
<body class="w3-blue">
    <main class ="w3-container w3-card w3-sand w3-padding-32 w3-border w3-border-brown w3-round-large" style="max-width: 1000px; margin: auto; margin-top: 10px;">
    <section>
        <img src ="img/memelang.jpg" alt="Group of friends gathered together" width="600" height="400">
        <h3 class="w3-xlarge w3-center">Who are we?</h3>
        <p class="w3-large">Drozdowsky's Pie Shop is a local business located in Longmont, Colorado ran by Twitch streamer, Drozdowsky
            and his loyal fans. Our goal is to make and deliver the best pies in Colorado as soon as possible to the
            consumer.
        </p>
    </section>
    <section>
        <h3 class="w3-xlarge w3-center">Store Hours and Location</h3>
        <p>840 Lashley St, Longmont, CO 80504</p><br>
        <p>Monday-Friday 9 A.M - 6 P.M</p><br>
        <p>Saturday & Sunday 10 A.M - 5 P.M</p><br>
        <p>We will be open on some holidays and closed on others. <strong>Christmas and Thanksgiving will be the only two days we will be 100% Closed. </strong>We will update our
    hours on our social media or on our news page!</p>
    </section>
    </main>
    <footer class="w3-container w3-center w3-padding-16 w3-brown">
        <div class="w3-row">
        <div class="w3-half w3-center">
        <h3>Contact</h3>
        <p>Email: jakobmifflin2005@gmail.com</p>
        <p>Phone Number: 618-618-6181</p>
        <p>@2024 Drozdowsky's Pie Shop</p>
        </div>
        <div class="w3-half w3-center">
        <h3>Follow Us!</h3>
        <p>
                <a href="https://www.twitch.tv/dowsky" class="w3-button w3-round w3-light-grey">Twitch</a>
                <a href="https://x.com/Dowsky64" class="w3-button w3-round w3-light-grey">Twitter</a>
                <a href="https://www.instagram.com/memelang769/" class="w3-button w3-round w3-light-grey">Instagram</a>
        </p>
    </footer>
</body>


</html>